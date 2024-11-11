<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('post_hashtags', function (Blueprint $table) {
            // Remover o 'id' auto-incrementável
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // Referência para a tabela 'posts'
            $table->foreignId('hashtag_id')->constrained()->onDelete('cascade'); // Referência para a tabela 'hashtags'
            
            // Definindo uma chave primária composta por 'post_id' e 'hashtag_id'
            $table->primary(['post_id', 'hashtag_id']);
            
            // Timestamps automáticos
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_hashtags');
    }
};
