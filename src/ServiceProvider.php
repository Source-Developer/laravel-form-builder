<?php

namespace IntoTheSource\LaravelFormBuilder;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/../config/laravel-form-builder.php';
    const MIGRATIONS_PATH = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'database/migrations';

    /**
     * Boot the Laravel Form Builder
     */
    public function boot()
    {
        $this->app->bind('laravel-form-builder', function () {
            return new LaravelFormBuilder();
        });

        $this->publishes([
            self::CONFIG_PATH => config_path('laravel-form-builder.php'),
        ], 'config');
    }

    /**
     * Register the Laravel Form Builder
     */
    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'laravel-form-builder'
        );

        $this->loadMigrationsFrom(self::MIGRATIONS_PATH);

        $this->app->bind('laravel-form-builder', function () {
            return new LaravelFormBuilder();
        });
    }
}
