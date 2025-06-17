<?php

namespace App\Http\Requests\Users;

use App\Rules\Users\CanChangeStatusRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_create' => !isset($this->id),
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
            'id' => 'sometimes|nullable|exists:users,id',
            'name' => 'required',
            'surname' => 'required',
            'email' => [
                'required',
                'email',
                $this->is_create ? 'unique:users,email' : Rule::unique('users', 'email')->ignore($this->id),
            ],
            'new_password' => [
                $this->is_create ? 'required' : 'nullable',
                'min:5'
            ],
            'status' => 'required|in:simple,super',
            'is_create' => [
                'required',
                !$this->is_create ? new CanChangeStatusRule() : ''
            ]
        ];
    }
}
