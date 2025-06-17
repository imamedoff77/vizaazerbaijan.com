<?php

namespace App\Rules\Users;

use Closure;
use App\Models\User;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class CanChangeStatusRule implements ValidationRule, DataAwareRule
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
        $currentUser = auth()->user();
        if (isset($this->data['id']) && $currentUser->id == $this->data['id'] && $this->data['status'] == 'simple') {
            $fail('Öz statusunuzu dəyişdirə bilməzsiniz');
        }
    }
}
