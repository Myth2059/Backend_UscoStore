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
        Schema::table('Locales', function (Blueprint $table) {
            $table->string('nombre');
            $table->integer('ubicacion');
            $table->string('estado');
            $table->string('categoria');
            $table->string('subcategoria');
            $table->string('imgurl');
            $table->foreignId('user_id')->constrained(); // Clave foránea a la tabla 'users'
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
