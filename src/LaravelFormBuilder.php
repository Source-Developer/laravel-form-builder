<?php

namespace IntoTheSource\LaravelFormBuilder;

use IntoTheSource\LaravelFormBuilder\Support\Builder;
use IntoTheSource\LaravelFormBuilder\Support\Element;
use IntoTheSource\LaravelFormBuilder\Support\Form;
use IntoTheSource\LaravelFormBuilder\Support\Value;

class LaravelFormBuilder
{
    /**
     * @return \IntoTheSource\LaravelFormBuilder\Support\Form
     */
    public function form()
    {
        return new Form();
    }

    /**
     * @return \IntoTheSource\LaravelFormBuilder\Support\Element|null
     */
    public function element()
    {
        return new Element();
    }

    /**
     * @return \IntoTheSource\LaravelFormBuilder\Support\Element|null
     */
    public function value()
    {
        return new Value();
    }

    /**
     * @return \IntoTheSource\LaravelFormBuilder\Support\Builder
     */
    public function builder()
    {
        return new Builder();
    }
}
