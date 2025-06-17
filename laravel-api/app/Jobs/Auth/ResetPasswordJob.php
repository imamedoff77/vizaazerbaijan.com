<?php

namespace App\Jobs\Auth;

use App\Mail\Auth\ResetPasswordMail;
use http\Client\Curl\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class ResetPasswordJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected array $data
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (isset($this->data['user']) && !empty($this->data['user']) && isset($this->data['token'])) {
            Mail::to($this->data['user']->email)->send(new ResetPasswordMail($this->data));
        }
    }
}
