<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'min:11', 'max:255'],
            'birthday' => ['required', 'date'],
            'age' => ['required', 'integer'],
            'province' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'barangay' => ['required', 'string', 'max:255'],
            'street' => ['max:255'],
            'status' => ['required', 'max:255'],
            'email' => [
                'sometimes',
                'string',
                'lowercase',
                'email',
                'max:255',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($this->route('patient')->id, 'id') // Ignore the current provider's email
                ]
            ],
        ];
    }
}
