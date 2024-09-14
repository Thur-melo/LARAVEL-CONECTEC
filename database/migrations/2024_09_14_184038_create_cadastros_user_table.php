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
        Schema::create('cadastros_user', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('emailUser')->unique();
            $table->string('senha');
            $table->string('modulo');
            $table->string('perfil');
            $table->string('urlDaFoto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cadastros_user');
    }
};
