<?php

namespace App\Http\Requests\Users;

use App\Rules\Users\CanDeleteUserRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DeleteRequest extends FormRequest
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
            'id' => Request::route('id')
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
            'id' => [
                'required',
                'exists:users,id',
                new CanDeleteUserRule()
            ]
        ];
    }
}
