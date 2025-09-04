<?php

namespace LaravelThemeDetector;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class ThemeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publicar configuración
        $this->publishes([
            __DIR__.'/../config/theme-detector.php' => config_path('theme-detector.php'),
        ], 'theme-detector-config');

        // Publicar migración
        $this->publishes([
            __DIR__.'/../database/migrations/add_theme_preference_to_users_table.php.stub' => 
                database_path('migrations/'.date('Y_m_d_His').'_add_theme_preference_to_users_table.php'),
        ], 'theme-detector-migrations');

        // Publicar vistas
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/theme-detector'),
        ], 'theme-detector-views');

        // Registrar middleware
        $this->app['router']->pushMiddlewareToGroup('web', 
            \LaravelThemeDetector\Middleware\DetectThemePreference::class
        );

        // Registrar componente Livewire
        Livewire::component('theme-toggle', 
            \LaravelThemeDetector\Livewire\ThemeToggle::class
        );
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/theme-detector.php', 'theme-detector'
        );
    }
}
