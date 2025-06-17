<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\VisaStatusEnum;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $statuses = VisaStatusEnum::getStatuses();
        Schema::create('visa_requests', function (Blueprint $table) use ($statuses) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->string('application_number');
            $table->string('nationality');
            $table->string('travel_document');
            $table->string('purpose');
            $table->date('arrival_date');
            $table->string('surname');
            $table->string('given_name');
            $table->date('birthday');
            $table->string('country_of_birth');
            $table->string('place_of_birth');
            $table->enum('sex', ['male', 'female']);
            $table->string('occupation');
            $table->string('phone_number');
            $table->string('address');
            $table->string('email');
            $table->string('passport_file');
            $table->date('passport_issue_date');
            $table->date('passport_expire_date');
            $table->string('address_in_azerbaijan');
            $table->enum('status', $statuses)->default(VisaStatusEnum::PAYMENT_PENDING->value);
            $table->text('completed_message')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visa_requests');
    }
};
