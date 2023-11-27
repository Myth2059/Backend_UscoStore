<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('delete_log', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('admin_id');
            $table->integer('local_id');
            $table->integer('propietario_id');
            $table->string('nombre_local');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delete_log');
    }
};
