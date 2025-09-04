<?php

namespace LaravelThemeDetector\Livewire;

use Livewire\Component;
use LaravelThemeDetector\Concerns\DetectsBrowser;

class ThemeToggle extends Component
{
    use DetectsBrowser;

    protected $listeners = ['themeUpdated' => '$refresh'];

    public function mount()
    {
        $this->initializeDetectsBrowser();
    }

    public function render()
    {
        return view('theme-detector::theme-toggle', [
            'browserIcon' => $this->browserIcon,
            'deviceIcon' => $this->deviceIcon
        ]);
    }
}