<?php

namespace App\Jobs\ToUser;

use App\Mail\toUser\CompletedVisaMail;
use App\Models\VisaRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class CompletedVisaJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected int $visaId,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $visa = VisaRequest::where('id', $this->visaId)
            ->with('service')
            ->first();
        if (!empty($visa)) {
            Mail::to($visa->email)->send(new CompletedVisaMail($visa));
        }
    }
}
