<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('complaint_responses', function (Blueprint $table) {
            $table->boolean('is_public')->default(true)->after('images');
        });

        // Default behavior: OPD updates are public to warga.
        // Admin feedback is internal (only visible in Filament to OPD/admin).
        DB::table('complaint_responses')
            ->join('users', 'complaint_responses.user_id', '=', 'users.id')
            ->where('users.role', 'admin')
            ->update(['complaint_responses.is_public' => false]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaint_responses', function (Blueprint $table) {
            $table->dropColumn('is_public');
        });
    }
};
