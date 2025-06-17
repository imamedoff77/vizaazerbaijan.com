<?php

namespace App\Http\Requests\Services;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PageBySlugRequest extends FormRequest
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
            'slug' => Request::route('slug'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $services = [
            'standard-service',
            'fast-service',
            'emergency-service',
        ];
        return [
            'slug' => [
                'required',
                Rule::in($services),
            ]
        ];
    }
}
