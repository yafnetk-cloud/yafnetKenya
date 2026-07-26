<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();

            // Donor information
            $table->string('name');
            $table->string('email');
            $table->string('phone');

            // Donation details
            $table->decimal('amount', 10, 2);

            // PalPluss transaction ID
            $table->string('transaction_id')->nullable()->unique();

            // Payment status
            $table->enum('status', [
                'pending',
                'paid',
                'failed',
                'cancelled'
            ])->default('pending');

            // Payment method
            $table->string('payment_method')->default('M-Pesa');

            // Optional reference
            $table->string('reference')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};