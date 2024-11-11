<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('denuncia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Usuário que fez a denúncia
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade'); // ID do post denunciado
            $table->text('motivo'); // Motivo da denúncia
            $table->enum('status', ['pendente', 'analisado', 'rejeitado'])->default('pendente'); // Status da denúncia
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('denuncia');
    }
};
