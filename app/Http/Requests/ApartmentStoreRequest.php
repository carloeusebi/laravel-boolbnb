<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ApartmentStoreRequest extends FormRequest
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
            'name' => 'required|unique:apartments,name|max:80',
            'description' => 'required',
            'thumbnail' => 'nullable|file|mimes:jpeg,jpg,png,webp',
            'address' => 'required',
            // 'lat' => 'required',
            // 'lon' => 'required',
            'rooms' => 'nullable|numeric|min:0|max:255',
            'bedrooms' => 'nullable|numeric|min:0|max:255',
            'bathrooms' => 'nullable|numeric|min:0|max:255',
            'square_meters' => 'nullable|numeric|min:0|max:65535',
        ];
    }
}
