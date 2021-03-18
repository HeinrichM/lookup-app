<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CellNumberRequest extends FormRequest
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
            'number' => ['required', 'digits:11', 'starts_with:27']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'number.required' => 'A cell number is required.',
            'number.digits' => 'The cell number can only contain numeric characters and must be 11 characters long.',
            'number.starts_with' => 'The cell number must be in international format starting with 27.',
        ];
    }
}
