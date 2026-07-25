<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('impact_stats', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->unsignedInteger('value');
            $table->string('suffix')->nullable(); // e.g. "+"
            $table->string('icon')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('impact_stats'); }
};
