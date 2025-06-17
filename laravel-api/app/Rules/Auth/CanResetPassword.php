<?php

namespace App\Rules\Auth;

use App\Models\ResetPassword;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\User;

class CanResetPassword implements DataAwareRule, ValidationRule
{
    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];

    // ...

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
        $intentTimeout = config('auth.reset_password_intent_timeout'); // Hour
        $user = User::find($this->data['id']);
        $intent = ResetPassword::where([
            'user_id' => $this->data['id'],
            'token' => $this->data['token']
        ])->first();

        if (empty($user)) {
            $fail('The user was not found.');
        } elseif (empty($intent)) {
            $fail('The token is invalid.');
        } elseif ($intent->created_at < now()->subHours($intentTimeout)) {
            $fail('Token has expired. Please request a password reset again.');
        }
    }
}
