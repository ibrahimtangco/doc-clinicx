<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Auth\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoreProviderRequest extends FormRequest
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
            // 'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg'],
            'title' => ['string', 'max:255'],
            'first_name' => ['string', 'required', 'max:255'],
            'middle_name' => ['max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'specialization' => ['required', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'barangay' => ['required', 'string', 'max:255'],
            'street' => ['max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }
}
