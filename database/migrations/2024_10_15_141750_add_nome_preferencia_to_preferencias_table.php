<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNomePreferenciaToPreferenciasTable extends Migration
{
    public function up()
    {
        Schema::table('preferencias', function (Blueprint $table) {
            $table->string('nomePreferencia')->nullable(); // Adiciona o campo nomePreferencia
        });
    }

    public function down()
    {
        Schema::table('preferencias', function (Blueprint $table) {
            $table->dropColumn('nomePreferencia'); // Remove o campo na migração reversa
        });
    }
}
