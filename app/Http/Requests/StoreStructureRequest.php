<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStructureRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'unique:structures', 'email:filter'],
            'address' => ['required', 'string', 'min:3', 'max:255'],
            'tel' => ['required', 'string', 'min:3', 'max:255'],
            'logo' => ['required', 'image', 'max:5000'],
        ];
    }
}
