<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_records', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('academic_records')->nullable(); 
            $table->string('certification')->nullable(); 
            $table->string('uploaded_by')->nullable(); 
            $table->timestamps();

            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_records');
    }
};
