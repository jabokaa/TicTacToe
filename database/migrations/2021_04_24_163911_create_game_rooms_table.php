<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_rooms', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->string("Square1", 10)->default('');
            $table->string("Square2", 10)->default('');
            $table->string("Square3", 10)->default('');
            $table->string("Square4", 10)->default('');
            $table->string("Square5", 10)->default('');
            $table->string("Square6", 10)->default('');
            $table->string("Square7", 10)->default('');
            $table->string("Square8", 10)->default('');
            $table->string("Square9", 10)->default('');
=======
            $table->string("Square1", 1)->default('');
            $table->string("Square2", 1)->default('');
            $table->string("Square3", 1)->default('');
            $table->string("Square4", 1)->default('');
            $table->string("Square5", 1)->default('');
            $table->string("Square6", 1)->default('');
            $table->string("Square7", 1)->default('');
            $table->string("Square8", 1)->default('');
            $table->string("Square9", 1)->default('');
>>>>>>> b512f3681ddd173e2db94001268382ed138067fd
            $table->string("gameState", 30)->default('');
            $table->unsignedBigInteger('gamerTurn');
            $table->unsignedBigInteger('gamer1Id');
            $table->unsignedBigInteger('gamer2Id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_rooms');
    }
}
