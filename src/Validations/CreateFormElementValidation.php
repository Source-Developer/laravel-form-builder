<?php

namespace IntoTheSource\LaravelFormBuilder\Validations;

use Illuminate\Foundation\Http\FormRequest;


class CreateFormElementValidation extends FormRequest
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
            'formbuilder_form_id' => 'required|integer',
            'active'              => 'required|boolean',
            'order'               => 'integer|nullable',
            'required'            => 'required|boolean',
            'name'                => 'required|string',
            'placeholder'         => 'string|nullable',
            'help_block'          => 'string|nullable',
            'type'                => 'required|string',
        ];
    }
}
