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
        Schema::create('Locales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('ubicacion');
            $table->string('estado');
            $table->string('categoria');
            $table->string('subcategoria');
            $table->string('imgurl');
            $table->bigInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Locales');
    }
};
