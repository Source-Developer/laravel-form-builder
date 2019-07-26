<?php

namespace IntoTheSource\LaravelFormBuilder\Support;

class Builder
{
    /**
     * @return \Illuminate\Foundation\Application|mixed
     */
    public function back()
    {
        return app('laravel-form-builder');
    }

    /**
     * Build form object into array
     *
     * @return mixed
     */
    public function toArray()
    {
        return $this->back()->form()->get()->toArray();
    }

    /**
     * Build form object into json
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }
}
