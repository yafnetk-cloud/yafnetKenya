<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pillar_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->boolean('is_flagship')->default(false);
            $table->text('summary')->nullable();
            $table->longText('body')->nullable();
            $table->json('components')->nullable(); // e.g. sub-components list for flagship programs
            $table->string('image_path')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('published')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('programs'); }
};
