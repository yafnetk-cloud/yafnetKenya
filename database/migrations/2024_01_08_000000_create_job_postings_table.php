<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type'); // Full-time, Volunteer, Consultancy
            $table->string('location')->nullable();
            $table->longText('description');
            $table->date('closing_date')->nullable();
            $table->boolean('published')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('job_postings'); }
};
