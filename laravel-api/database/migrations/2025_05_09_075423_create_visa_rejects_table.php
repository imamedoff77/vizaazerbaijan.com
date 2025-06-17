<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('visa_rejects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visa_id');
            $table->text('message')->nullable();
            $table->decimal('refundedAmount', 8, 2)->nullable();
            $table->boolean('isRefunded')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visa_rejects');
    }
};
