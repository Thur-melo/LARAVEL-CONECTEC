<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferenciasTable extends Migration
{
    public function up()
    {
        Schema::create('preferencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('preferencia_id'); // Alterado de 'interest_id' para 'preferencia_id'
            $table->timestamps();
        
            // Chaves estrangeiras
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('preferencia_id')->references('id')->on('preferencias'); // Certifique-se de que isso corresponda
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('preferencias');
    }
}
