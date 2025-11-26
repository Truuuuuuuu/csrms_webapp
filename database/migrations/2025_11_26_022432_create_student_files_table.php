<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_record_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['academic', 'cert']);
            $table->string('filename');
            $table->string('uploaded_by');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_files');
    }
};
