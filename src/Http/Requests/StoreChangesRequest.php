<?php

namespace AlexGh12\ChangeLog\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreChangesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

       /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'version'     => 'required|string|regex:/^v\.\d+$/',
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ];
    }

	/**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
	public function messages(): array
    {
        return [
            'version.required'     => 'El campo versión es requerido.',
            'version.regex'        => 'El campo versión debe tener el formato "v.X" donde X es un número.',
            'title.required'       => 'El campo título es requerido.',
            'description.required' => 'El campo descripción es requerido.',
        ];
    }
}
