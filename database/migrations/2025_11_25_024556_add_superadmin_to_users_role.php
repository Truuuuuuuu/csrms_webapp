<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // MySQL enum modification
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['viewer', 'editor', 'admin', 'superadmin'])->default('viewer')->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert to original enum values
            $table->enum('role', ['viewer', 'editor', 'admin'])->default('viewer')->change();
        });
    }
};
