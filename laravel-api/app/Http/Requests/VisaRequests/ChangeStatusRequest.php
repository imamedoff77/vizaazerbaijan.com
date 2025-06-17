<?php

namespace App\Http\Requests\VisaRequests;

use App\Enums\VisaStatusEnum;
use App\Rules\VisaRequests\CanChangeStatusRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ChangeStatusRequest extends FormRequest
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
            'id' => ['required', new CanChangeStatusRule()],
            'status' => [
                'required',
                Rule::in(VisaStatusEnum::getStatuses())
            ],
            'message' => 'sometimes|nullable'
        ];
    }
}
