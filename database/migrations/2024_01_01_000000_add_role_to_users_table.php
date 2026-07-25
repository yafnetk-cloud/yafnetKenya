<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('editor')->after('email'); // super_admin | editor
            $table->boolean('two_factor_enabled')->default(false)->after('role');
            $table->string('two_factor_secret')->nullable()->after('two_factor_enabled');
        });
    }
    public function down(): void {
        Schema::table('users', fn (Blueprint $table) => $table->dropColumn(['role', 'two_factor_enabled', 'two_factor_secret']));
    }
};
