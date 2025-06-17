<?php

use App\Enums\VisaStatusEnum;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\VisaRequest;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Schedule::call(function () {
    VisaRequest::where('status', VisaStatusEnum::PAYMENT_PENDING->value)
        ->where('created_at', '<=', Carbon::now()->subMinutes(30))
        ->delete();
})->daily();
