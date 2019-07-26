<?php

namespace IntoTheSource\LaravelFormBuilder\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelFormBuilder extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-form-builder';
    }
}
