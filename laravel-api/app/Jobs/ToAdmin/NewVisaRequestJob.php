<?php

namespace App\Jobs\ToAdmin;

use App\Mail\toAdmin\NewVisaRequestMail;
use App\Models\VisaRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class NewVisaRequestJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected VisaRequest $visa
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->visa->load('service');
        Mail::to(config('env.ADMIN_MAIL'))->send(new NewVisaRequestMail($this->visa));
    }
}
