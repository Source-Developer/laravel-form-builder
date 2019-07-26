<?php

namespace IntoTheSource\LaravelFormBuilder\Support;

/**
 * Class Linker
 *
 * Global model holder
 *
 * @package IntoTheSource\LaravelFormBuilder\Support
 */
class Linker
{
    /**
     * @var \IntoTheSource\LaravelFormBuilder\Support\Form|null
     */
    public static $form = null;

    /**
     * @var \IntoTheSource\LaravelFormBuilder\Support\Element|null
     */
    public static $element = null;

    /**
     * @var \IntoTheSource\LaravelFormBuilder\Support\Value|null
     */
    public static $value = null;
}
