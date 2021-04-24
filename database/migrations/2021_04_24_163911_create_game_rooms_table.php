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
            $table->integer("Square1")->default(0);
            $table->integer("Square2")->default(0);
            $table->integer("Square3")->default(0);
            $table->integer("Square4")->default(0);
            $table->integer("Square5")->default(0);
            $table->integer("Square6")->default(0);
            $table->integer("Square7")->default(0);
            $table->integer("Square8")->default(0);
            $table->integer("Square9")->default(0);
            $table->integer("victoriousPlayer")->default(0);
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
