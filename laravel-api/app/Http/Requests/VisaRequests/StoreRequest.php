<?php

namespace App\Http\Requests\VisaRequests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'phone_number' => '+' . $this->phone_number
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'service_id' => 'required|exists:services,id',
            'nationality' => 'required|string',
            'travel_document' => 'required|string',
            'purpose' => 'required|string',
            'arrival_date' => ['required', 'date', 'after_or_equal:' . Carbon::now()->addDays(20)->toDateString()],
            'surname' => 'required|string',
            'given_name' => 'required|string',
            'birthday' => 'required|date',
            'country_of_birth' => 'required|string',
            'place_of_birth' => 'required|string',
            'sex' => 'required|in:Male,Female',
            'occupation' => 'required|string',
            'phone_number' => 'required|string|regex:/^\+\d{7,15}$/',
            'address' => 'required|string',
            'email' => 'required|email',
            'passport_file' => 'required|file|mimes:jpeg,png,pdf|max:30720',
            'passport_issue_date' => 'required|date',
            'passport_expire_date' => 'required|date|after:passport_issue_date',
            'address_in_azerbaijan' => 'required|string',
            'g-recaptcha-response' => 'required|captcha'
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'nationality.required' => 'Nationality is required.',
            'travel_document.required' => 'Travel document is required.',
            'purpose.required' => 'Purpose of visit is required.',
            'arrival_date.required' => 'Arrival date is required.',
            'arrival_date.date' => 'Arrival date must be a valid date.',
            'arrival_date.after_or_equal' => 'Arrival date must be at least 20 days from today.',
            'surname.string' => 'Surname must be a string.',
            'given_name.required' => 'Given name is required.',
            'birthday.required' => 'Date of birth is required.',
            'birthday.date' => 'Birthday must be a valid date.',
            'country_of_birth.required' => 'Country of birth is required.',
            'place_of_birth.required' => 'Place of birth is required.',
            'sex.required' => 'Sex is required.',
            'sex.in' => 'Sex must be one of: male, female, other.',
            'occupation.required' => 'Occupation is required.',
            'phone_number.required' => 'Phone number is required.',
            'phone_number.regex' => 'Phone number must start with "+" and contain only digits (7–15 digits).',
            'address.required' => 'Address is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'passport_file.required' => 'Passport file is required.',
            'passport_file.file' => 'Passport file must be a valid file.',
            'passport_file.mimes' => 'Passport file must be a JPEG, PNG, or PDF.',
            'passport_file.max' => 'Passport file may not be greater than 5MB.',
            'passport_issue_date.required' => 'Passport issue date is required.',
            'passport_issue_date.date' => 'Passport issue date must be a valid date.',
            'passport_expire_date.required' => 'Passport expiration date is required.',
            'passport_expire_date.date' => 'Passport expiration date must be a valid date.',
            'passport_expire_date.after' => 'Passport expiration date must be after the issue date.',
            'address_in_azerbaijan.required' => 'Address in Azerbaijan is required.',
            'terms.accepted' => 'You must accept the terms and conditions.',
            'g-recaptcha-response.required' => 'reCAPTCHA verification is required.',
            'g-recaptcha-response.captcha' => 'reCAPTCHA verification failed. Please try again.',
        ];
    }
}
