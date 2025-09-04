<?php

namespace LaravelThemeDetector\Concerns;

use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Cookie;

trait DetectsBrowser
{
    public $browserInfo = [];
    public $isDarkMode = false;
    public $userTheme = 'auto';

    public function initializeDetectsBrowser()
    {
        $this->detectBrowser();
        $this->detectTheme();
    }

    public function detectBrowser()
    {
        $agent = new Agent();
        $this->browserInfo = [
            'browser' => $agent->browser(),
            'version' => $agent->version($agent->browser()),
            'platform' => $agent->platform(),
            'device' => $agent->device(),
            'is_mobile' => $agent->isMobile(),
            'is_tablet' => $agent->isTablet(),
            'is_desktop' => $agent->isDesktop(),
        ];
    }

    public function detectTheme()
    {
        $this->userTheme = session('user_theme', config('theme-detector.default_theme', 'auto'));
        $this->isDarkMode = $this->calculateDarkMode();
    }

    protected function calculateDarkMode()
    {
        if ($this->userTheme === 'light') return false;
        if ($this->userTheme === 'dark') return true;
        return session('system_dark_mode', false);
    }

    public function setTheme($theme)
    {
        $this->userTheme = $theme;
        $this->isDarkMode = $this->calculateDarkMode();
        
        session([
            'user_theme' => $theme,
            'dark_mode' => $this->isDarkMode
        ]);

        Cookie::queue('user_theme', $theme, 60 * 24 * 365);

        $this->dispatch('themeUpdated', $this->isDarkMode);
    }

    public function getBrowserIconProperty()
    {
        $browser = strtolower($this->browserInfo['browser'] ?? '');
        
        return match($browser) {
            'chrome' => 'fab fa-chrome',
            'firefox' => 'fab fa-firefox',
            'safari' => 'fab fa-safari',
            'edge' => 'fab fa-edge',
            'opera' => 'fab fa-opera',
            default => 'fas fa-globe'
        };
    }

    public function getDeviceIconProperty()
    {
        if ($this->browserInfo['is_mobile']) return 'fas fa-mobile-alt';
        if ($this->browserInfo['is_tablet']) return 'fas fa-tablet-alt';
        return 'fas fa-desktop';
    }
}
