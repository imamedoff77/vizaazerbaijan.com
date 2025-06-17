<?php

namespace App\Http\Requests\Pages;

use Illuminate\Foundation\Http\FormRequest;
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

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_create' => !isset($this->id),
            'keywords' => json_decode($this->keywords, true),
            'block1_points' => json_decode($this->block1_points, true),
            'block2_points' => json_decode($this->block2_points, true),
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
            'is_create' => 'required',
            'id' => 'sometimes|exists:pages,id',
            'list_title' => 'required',
            'page_title' => 'required',
            'description' => 'required',
            'slug' => [
                'required',
                $this->is_create ? 'unique:pages,slug' : Rule::unique('pages', 'slug')->ignore($this->id)
            ],
            'keywords' => 'required|array|min:1',
            'new_og_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'block1_title' => 'required',
            'block1_points' => 'required|array|min:1',
            'block1_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'block2_title' => 'required',
            'block2_points' => 'required|array|min:1',
            'block2_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ];
    }
}
