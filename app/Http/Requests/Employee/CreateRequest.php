<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    protected $redirectRoute  = 'employees.create';

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
            'company_id' => ['required', 'exists:App\Models\Company,id'],
            'food_preference_id' => ['required', 'exists:App\Models\FoodPreference,id'],
            'email' => ['required', 'email', 'unique:App\Models\Employee,email'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone_numbers' => ['required', 'array'],
            'phone_numbers.*' => ['required', 'integer'],
        ];
    }
}
