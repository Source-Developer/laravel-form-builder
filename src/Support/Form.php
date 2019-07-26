<?php

namespace IntoTheSource\LaravelFormBuilder\Support;

use Illuminate\Support\Facades\Validator;
use IntoTheSource\LaravelFormBuilder\Exceptions\FailedValidationException;
use IntoTheSource\LaravelFormBuilder\Exceptions\NullArgumentException;
use IntoTheSource\LaravelFormBuilder\Models\Form as mdlForm;
use IntoTheSource\LaravelFormBuilder\Validations\CreateFormValidation;

class Form
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
    public function element()
    {
        return $this->back()->element();
    }

    /**
     * @return \IntoTheSource\LaravelFormBuilder\Support\Element|null
     */
    public function builder()
    {
        return $this->back()->build();
    }

    /**
     * Create a from based on data
     *
     * @param null $options
     *
     * @return $this
     * @throws \IntoTheSource\LaravelFormBuilder\Exceptions\FailedValidationException
     * @throws \IntoTheSource\LaravelFormBuilder\Exceptions\NullArgumentException
     */
    public function create($options = null)
    {
        if ($options === null) {
            throw new NullArgumentException("Options argument is NULL");
        }

        $defaultOptions = [
            'name'                  => null,
            'active'                => false,
            'emails'                => null,
            'success_message'       => null,
            'redirect_url'          => null,
            'confirm_email'         => false,
            'send_email'            => false,
            'save_data'             => false,
            'recaptcha'             => false,
            'recaptcha_private_key' => null,
            'recaptcha_public_key'  => null
        ];

        $options = array_merge($defaultOptions, $options);

        $validator = Validator::make($options, (new CreateFormValidation)->rules());

        if ($validator->fails()) {
            throw new FailedValidationException($validator->errors());
        }

        Linker::$form = mdlForm::create($options);

        return $this;
    }

    /**
     * Update a from based on data
     *
     * @param null $options
     *
     * @return $this
     * @throws \IntoTheSource\LaravelFormBuilder\Exceptions\NullArgumentException
     */
    public function update($options = null)
    {
        if ($this->loaded() == false) {
            throw new NullArgumentException("Form is not loaded.");
        }

        if ($options === null) {
            throw new NullArgumentException("Options argument is NULL");
        }

        Linker::$form->update($options);

        return $this;
    }

    /**
     * Set form on formbuilder
     *
     * @param Integer $formId
     *
     * @return $this
     */
    public function load(int $formId)
    {
        Linker::$form = mdlForm::findOrFail($formId);

        return $this;
    }

    /**
     * Check if form is loaded in instance
     *
     * @return bool
     */
    public function loaded()
    {
        return Linker::$form !== null;
    }

    /**
     * @return null
     */
    public function get()
    {
        return Linker::$form;
    }

    /**
     * Remove form with elements and values.
     *
     * If ID is present, it will remove the selected form in that way
     * otherwise the global selected form is being deleted.
     *
     * @param null $id
     *
     * @return $this
     */
    public function delete($id = null)
    {
        if ($id !== null) {
            $value = mdlForm::find($id);
        } else {
            $value = Linker::$form;
        }

        foreach ($value->elements as $element) {
            foreach ($element->values as $value) {
                $value->delete();
            }
            $element->delete();
        }
        $value->delete();

        if ($id === null) {
            Linker::$form = null;
        }

        return $this;
    }
}
