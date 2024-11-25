<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveLikesFromPosts extends Migration
{
    /**
     * Execute as migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('likes'); // Deleta a coluna 'likes'
        });
    }

    /**
     * Reversão da migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('likes'); // Adiciona a coluna 'likes' novamente caso precise reverter a migration
        });
    }
}
