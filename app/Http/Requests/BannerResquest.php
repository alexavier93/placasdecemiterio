<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerResquest extends FormRequest
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
            'name'          => 'required',
            'email'         => 'required|email:rfc',
            'password'      => 'required|min:8',
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
            'required'  => 'O campo :attribute é obrigatório',
            'email'     => 'Esse e-mail não é válido',
            'min'       => 'O campo deve ter no mínimo :min caracteres',
        ];
    }
}
