<?php

namespace App\Http\Requests\Auth;

use App\Rules\Auth\CanResetPassword;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'id' => 'required',
            'password' => 'required|min:5|max:30',
            'confirmPassword' => 'required|same:password',
            'token' => [
                'required',
                new CanResetPassword()
            ],
        ];
    }
}
