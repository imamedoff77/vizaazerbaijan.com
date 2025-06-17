<?php

namespace App\Http\Requests\VisaRequests;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'page' => $this->page ?? 1,
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
            'searchQuery' => ['nullable', 'string', 'max:255'],
            'searchField' => ['nullable', 'in:application_number,given_name,email'],
            'status' => ['nullable', 'in:pending,approved,rejected'],
            'page' => ['nullable', 'integer', 'min:1'],
        ];
    }
}
