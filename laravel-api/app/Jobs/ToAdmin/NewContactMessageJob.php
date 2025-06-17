<?php

namespace App\Jobs\ToAdmin;

use App\Mail\toAdmin\NewContactMessageMail;
use App\Models\ContactMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class NewContactMessageJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected ContactMessage $message,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to(config('env.ADMIN_MAIL'))->send(new NewContactMessageMail($this->message));
    }
}
