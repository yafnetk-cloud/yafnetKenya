<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['contact', 'volunteer', 'partner_inquiry', 'donation', 'newsletter']);
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('subject')->nullable();
            $table->longText('message')->nullable();
            $table->json('meta')->nullable(); // extra fields per form type
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('form_submissions'); }
};
