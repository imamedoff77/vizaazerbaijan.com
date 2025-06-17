<?php

namespace App\Rules\VisaRequests;

use App\Enums\VisaStatusEnum;
use App\Models\VisaRequest;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\DataAwareRule;

class CanChangeStatusRule implements DataAwareRule, ValidationRule
{
    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];

    /**
     * Set the data under validation.
     *
     * @param array<string, mixed> $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $visaRequest = VisaRequest::find($this->data['id']);
        if (empty($visaRequest)) {
            $fail('Visa istəyi tapılmadı');
        } elseif ($visaRequest->status == VisaStatusEnum::CANCELLED->value) {
            $fail('Visa istəyi ləğv edilib. Statusu dəyişdirilə bilməz');
        } elseif ($visaRequest->status == VisaStatusEnum::COMPLETED->value) {
            $fail('Visa istəyi tamamlanıb. Statusu dəyişdirilə bilməz');
        }
    }
}
