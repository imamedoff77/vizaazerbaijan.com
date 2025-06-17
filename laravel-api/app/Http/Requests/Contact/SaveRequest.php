<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class SaveRequest extends FormRequest
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
            'name' => 'required',
            'application_number' => 'sometimes|nullable',
            'email' => 'required|email',
            'message' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'application_number.*' => 'Invalid application number.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'message.required' => 'The message field is required.',
            'g-recaptcha-response.required' => 'reCAPTCHA verification is required.',
            'g-recaptcha-response.captcha' => 'reCAPTCHA verification failed. Please try again.',
        ];
    }

}
