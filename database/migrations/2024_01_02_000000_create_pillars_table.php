<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pillars', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->text('summary')->nullable();
            $table->longText('body')->nullable();
            $table->string('image_path')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('published')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('pillars'); }
};
