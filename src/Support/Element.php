<?php

namespace IntoTheSource\LaravelFormBuilder\Support;

use Illuminate\Support\Facades\Validator;
use IntoTheSource\LaravelFormBuilder\Exceptions\FailedValidationException;
use IntoTheSource\LaravelFormBuilder\Exceptions\NullArgumentException;
use IntoTheSource\LaravelFormBuilder\Models\FormElement;
use IntoTheSource\LaravelFormBuilder\Validations\CreateFormElementValidation;

class Element
{
    /**
     * @return \Illuminate\Foundation\Application|mixed
     */
    public function back()
    {
        return app('laravel-form-builder');
    }

    /**
     * @return \IntoTheSource\LaravelFormBuilder\Support\Element|null
     */
    public function value()
    {
        return $this->back()->value();
    }

    /**
     * Add element to form object
     *
     * @param $options
     *
     * @return $this
     * @throws \Exception
     * @throws \IntoTheSource\LaravelFormBuilder\Exceptions\FailedValidationException
     * @throws \IntoTheSource\LaravelFormBuilder\Exceptions\NullArgumentException
     */
    public function create($options)
    {
        if ($options === null) {
            throw new NullArgumentException("Options argument is NULL");
        }

        if (!$this->back()->form()->loaded()) {
            throw new \Exception('Form is load loaded');
        }

        $defaultOptions = [
            'formbuilder_form_id' => Linker::$form->id,
            'active'              => false,
            'order'               => null,
            'required'            => false,
            'name'                => null,
            'placeholder'         => null,
            'help_block'          => null,
            'type'                => null,
        ];

        $options = array_merge($defaultOptions, $options);

        $validator = Validator::make($options, (new CreateFormElementValidation)->rules());

        if ($validator->fails()) {
            throw new FailedValidationException($validator->errors());
        }

        Linker::$element = Linker::$form->elements()->create($options);

        return $this;
    }

    /**
     * Update a from element based on data
     *
     * @param null $options
     *
     * @return $this
     * @throws \IntoTheSource\LaravelFormBuilder\Exceptions\NullArgumentException
     */
    public function update($options = null)
    {
        if ($this->loaded() == false) {
            throw new NullArgumentException("Form element is not loaded.");
        }

        if ($options === null) {
            throw new NullArgumentException("Options argument is NULL");
        }

        Linker::$element->update($options);

        return $this;
    }

    /**
     * Set element on formbuilder
     *
     * @param Integer $elementId
     *
     * @return $this
     */
    public function load(int $elementId)
    {
        Linker::$element = FormElement::findOrFail($elementId);

        return $this;
    }

    /**
     * Check if form is loaded in instance
     *
     * @return bool
     */
    public function loaded()
    {
        return Linker::$element !== null;
    }

    /**
     * @return null
     */
    public function get()
    {
        return Linker::$element;
    }

    /**
     * Remove form element with values.
     * If ID is present, the selected form element will be removed
     * otherwise the global selected element will be removed.
     *
     * @param null $id
     *
     * @return $this
     */
    public function delete($id = null)
    {
        if ($id !== null) {
            $value = Linker::$element;
        } else {
            $value = FormElement::find($id);
        }

        foreach ($value->values as $value) {
            $value->delete();
        }
        $value->delete();

        if ($id === null) {
            Linker::$element = null;
        }

        return $this;
    }
}
