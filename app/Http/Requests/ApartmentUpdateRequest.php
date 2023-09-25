<?php

namespace App\Http\Requests;

use App\Models\Apartment;
use Illuminate\Foundation\Http\FormRequest;

class ApartmentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function attributes()
    {
        return Apartment::labels();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|max:80',
            'description' => 'required',
            'thumbnail' => 'nullable|file|mimes:jpeg,jpg,png,webp',
            'address' => 'required',
            //?? lat && long
            'rooms' => 'nullable|numeric|min:0|max:255',
            'bedrooms' => 'nullable|numeric|min:0|max:255',
            'bathrooms' => 'nullable|numeric|min:0|max:255',
            'rooms' => 'nullable|numeric|min:0|max:255',
            'square_meters' => 'nullable|numeric|min:0|max:65535',
        ];
    }
}
