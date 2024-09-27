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

                Schema::create('comentarios', function (Blueprint $table) {
                    $table->id();
                    $table->text('texto');
                    $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relacionamento com User
                    $table->foreignId('post_id')->constrained()->onDelete('cascade'); // Relacionamento com Post
                    $table->integer('status')->default(0); // Status padrão
                    $table->timestamps();
                });
            }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
        //
    }
};
