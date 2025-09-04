<?php

namespace LaravelThemeDetector\Middleware;

use Closure;
use Illuminate\Http\Request;

class DetectThemePreference
{
    public function handle(Request $request, Closure $next)
    {
        if (!config('theme-detector.auto_detect', true)) {
            return $next($request);
        }

        $prefersDark = $request->cookie('system_dark_mode') === 'true' ||
                      ($request->header('Sec-CH-Prefers-Color-Scheme') === 'dark');

        session(['system_dark_mode' => $prefersDark]);

        $userTheme = $request->cookie('user_theme', config('theme-detector.default_theme', 'auto'));
        session(['user_theme' => $userTheme]);

        $darkMode = $this->calculateDarkMode($userTheme, $prefersDark);
        session(['dark_mode' => $darkMode]);

        return $next($request);
    }

    protected function calculateDarkMode($userTheme, $systemDark)
    {
        if ($userTheme === 'light') return false;
        if ($userTheme === 'dark') return true;
        return $systemDark;
    }
}
