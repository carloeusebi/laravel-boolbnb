<?php

namespace App\Http\Requests;

use App\Models\Apartment;
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
            'name' => 'required|max:80',
            'description' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lon' => 'required',
            'rooms' => 'required|numeric|min:0|max:255',
            'bedrooms' => 'required|numeric|min:0|max:255',
            'bathrooms' => 'required|numeric|min:0|max:255',
            'square_meters' => 'required|numeric|min:0|max:65535',
            'services' => 'nullable|exists:services,id'
        ];
    }
}
