<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lobby_id');
            $table->string('title');
            $table->string('image');
            $table->integer('min_percent');
            $table->integer('max_percent');
            $table->integer('min_ratio');
            $table->integer('max_ratio');
            $table->timestamps();
            $table->foreign('lobby_id')->references('id')->on('lobbies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
