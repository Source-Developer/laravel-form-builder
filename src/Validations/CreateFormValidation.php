<?php

namespace IntoTheSource\LaravelFormBuilder\Validations;

use Illuminate\Foundation\Http\FormRequest;


class CreateFormValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                  => 'required|string',
            'active'                => 'required|boolean',
            'emails'                => 'nullable|string',
            'success_message'       => 'nullable|string',
            'redirect_url'          => 'nullable|string',
            'confirm_email'         => 'required|boolean',
            'send_email'            => 'required|boolean',
            'save_data'             => 'required|boolean',
            'recaptcha'             => 'required|boolean',
            'recaptcha_private_key' => 'nullable|string',
            'recaptcha_public_key'  => 'nullable|string'
        ];
    }
}
