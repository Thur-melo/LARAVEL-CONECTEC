<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferenciasListaTable extends Migration
{
    public function up()
    {
        Schema::create('preferenciasLista', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // nome
            $table->string('curso'); //curso
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('preferenciasLista');
    }
}