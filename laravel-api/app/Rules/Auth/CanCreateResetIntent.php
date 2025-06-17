<?php

namespace App\Rules\Auth;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CanCreateResetIntent implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = User::where('email', $value)->first();
        if (empty($user)) {
            $fail('The user does not exist.');
        } else {
            $intentTimeout = config('auth.reset_password_intent_timeout'); // Hour
            $intent = $user->reset_passwords()
                ->where('created_at', '>=', now()->subHours($intentTimeout))
                ->exists();
            if ($intent) {
                $fail('A link to reset your password has been sent to your email address. The link is valid for 1 hour. Please use the link before submitting your request again.');
            }
        }
    }
}
