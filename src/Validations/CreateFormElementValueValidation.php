<?php

namespace IntoTheSource\LaravelFormBuilder\Validations;

use Illuminate\Foundation\Http\FormRequest;


class CreateFormElementValueValidation extends FormRequest
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
            'formbuilder_element_id' => 'required|integer',
            'active'                 => 'required|boolean',
            'order'                  => 'integer|nullable',
            'name'                   => 'required|string',
        ];
    }
}
