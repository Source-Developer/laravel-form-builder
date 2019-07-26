<?php

namespace IntoTheSource\LaravelFormBuilder\Support;

use Illuminate\Support\Facades\Validator;
use IntoTheSource\LaravelFormBuilder\Exceptions\FailedValidationException;
use IntoTheSource\LaravelFormBuilder\Exceptions\NullArgumentException;
use IntoTheSource\LaravelFormBuilder\Models\ElementValue;
use IntoTheSource\LaravelFormBuilder\Validations\CreateFormElementValueValidation;

class Value
{
    /**
     * @return \Illuminate\Foundation\Application|mixed
     */
    public function back()
    {
        return app('laravel-form-builder');
    }

    /**
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

        if (Linker::$element == null) {
            throw new \Exception('No form element is selected');
        }

        $defaultOptions = [
            'formbuilder_element_id' => Linker::$element->id,
            'active'                 => false,
            'order'                  => null,
            'name'                   => null,
        ];

        $options = array_merge($defaultOptions, $options);

        $validator = Validator::make($options, (new CreateFormElementValueValidation())->rules());

        if ($validator->fails()) {
            throw new FailedValidationException($validator->errors());
        }

        Linker::$value = Linker::$element->values()->create($options);

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
            throw new NullArgumentException("Form element value is not loaded.");
        }

        if ($options === null) {
            throw new NullArgumentException("Options argument is NULL");
        }

        Linker::$value->update($options);

        return $this;
    }

    /**
     * Set value on formbuilder
     *
     * @param Integer $formId
     *
     * @return $this
     */
    public function load(int $formId)
    {
        Linker::$value = ElementValue::findOrFail($formId);

        return $this;
    }

    /**
     * Check if form is loaded in instance
     *
     * @return bool
     */
    public function loaded()
    {
        return Linker::$value !== null;
    }

    /**
     * Remove a value from a element list.
     * If no ID is provided, it will remove all values avalible in Element
     *
     * @param null $id
     *
     * @return $this
     */
    public function delete($id = null)
    {
        if ($id !== null) {
            $value = [ElementValue::find($id)];
        } else {
            $value = Linker::$element->values;
        }

        foreach (Linker::$element->values as $value) {
            $value->delete();
        }

        return $this;
    }
}
