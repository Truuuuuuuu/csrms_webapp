<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_records', function (Blueprint $table) {
            // Remove the old file columns
            $table->dropColumn(['academic_records', 'certification']);
        });
    }

    public function down(): void
    {
        Schema::table('student_records', function (Blueprint $table) {
            // Add them back if rolling back
            $table->string('academic_records')->nullable();
            $table->string('certification')->nullable();
        });
    }
};
