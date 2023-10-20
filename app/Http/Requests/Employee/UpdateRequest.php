<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class UpdateRequest extends FormRequest
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
            'company_id' => ['required', 'exists:App\Models\Company,id'],
            'food_preference_id' => ['required', 'exists:App\Models\Employee,id'],
            'email' => ['required', 'email', 'unique:App\Models\Employee,email,' . $this->employee->id],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone_numbers' => ['required', 'array'],
            'phone_numbers.*' => ['required'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo(route('employees.edit', $this->employee->id));
    }
}
