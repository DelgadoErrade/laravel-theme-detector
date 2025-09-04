# Laravel Theme Detector 🌓

Automatic dark/light theme and browser detection for Laravel applications.

## Installation

```bash
composer require laravel-theme-detector

#Quick Usage

use LaravelThemeDetector\Concerns\DetectsBrowser;

class MyComponent extends Component
{
    use DetectsBrowser;
    
    public function mount()
    {
        $this->initializeDetectsBrowser();
    }
}

 Instalación en cualquier proyecto:

 # ¡Así de simple!
composer require laravel-theme-detector

# Publicar configuración (opcional)
php artisan vendor:publish --provider="LaravelThemeDetector\\ThemeServiceProvider" --tag="theme-detector-config"

Uso genérico en cualquier componente:

use LaravelThemeDetector\Concerns\DetectsBrowser;

class AnyComponent extends Component
{
    use DetectsBrowser;
    
    public function mount()
    {
        $this->initializeDetectsBrowser();
    }
    
    public function render()
    {
        return view('any-view', [
            'isDarkMode' => $this->isDarkMode,
            'browserInfo' => $this->browserInfo
        ]);
    }
}

7. Beneficios de la estructura genérica:
✅ 100% reusable - Para cualquier proyecto Laravel

✅ Fácil de instalar - Un comando composer

✅ Namespace profesional - LaravelThemeDetector\

✅ Sin vendor locking - No depende de "curso" o "livewire"

✅ Fácil de mantener - Estructura clara

Configuration
Publish config file:

php artisan vendor:publish --provider="LaravelThemeDetector\\ThemeServiceProvider" --tag=theme-detector-config

php artisan vendor:publish --provider="LaravelThemeDetector\\ThemeServiceProvider" --tag=theme-detector-config


## 10. **`.gitignore`**

```gitignore
/vendor/
/composer.lock
.phpunit.result.cache

GitHub: https://github.com/DelgadoErrade/laravel-theme-detector
