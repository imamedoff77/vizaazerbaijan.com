<?php

namespace App\Http\Requests\VisaRequests;

use Illuminate\Foundation\Http\FormRequest;

class CheckStatusRequest extends FormRequest
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
            'application_number' => 'required',
            'email' => 'required|email',
            'g-recaptcha-response' => 'required|captcha'
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'application_number.required' => 'The application number field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'g-recaptcha-response.required' => 'reCAPTCHA verification is required.',
            'g-recaptcha-response.captcha' => 'reCAPTCHA verification failed. Please try again.',
        ];
    }
}
