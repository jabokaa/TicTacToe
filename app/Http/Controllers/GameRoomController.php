<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameRoom;
use Illuminate\Support\Facades\DB;

class GameRoomController extends Controller
{
    private $gamer1Id;
    private $gamer2Id;
    private static $ARRAYS_VICTORY = array(
        array(
            true,true,true,
            false,false,false,
            false,false,false
        ),
        array(
            false,false,false,
            true,true,true,
            false,false,false
        ),
        array(
            false,false,false,
            false,false,false,
            true,true,true
        ),
        array(
            true,false,false,
            true,false,false,
            true,false,false
        ),
        array(
            false,true,false,
            false,true,false,
            false,true,false
        ),
        array(
            false,false,true,
            false,false,true,
            false,false,true
        ),
        array(
            true,false,false,
            false,true,false,
            false,false,true
        ),
        array(
            false,false,true,
            false,true,false,
            true,false,false
        )
    );

    public function createGame()
    {
        $idGamer = DB::table('Gamers')->insertGetId([]);

        $idGame = DB::table('game_rooms')->insertGetId(
            ['gamer1Id' => $idGamer, "gamerTurn" => $idGamer]
        );

        $gameRoom = DB::table('game_rooms')
            ->where("id", $idGame)
            ->first();

        return view("game", compact('gameRoom'));
    }

    public function comeIntoPlay($idGameRoom)
    {
        $gameRoom = GameRoom::find($idGameRoom);

        $idGamer = DB::table('Gamers')->insertGetId([]);
        $gameRoom->gamer2Id = $idGamer;
        $gameRoom->save();
        return view("game", compact('gameRoom'));
    }

    private static $FIELD_SQUEARE = array(
        'Square1','Square2','Square3','Square4','Square5','Square6','Square7','Square8','Square9'
    );

    private function validatePlay($gameRoom, $idGamer, $square)
    {
        if(is_null($gameRoom->gamer2Id))
        {
            return false;
        }

        if($gameRoom->gamerTurn != $idGamer)
        {
            return false;
        }
        else if(!is_null($gameRoom->$square))
        {
            return false;
        }
        return true;
    }

    private function judagar($idGamer, $square, $idGameRoom)
    {
        $gameRoom = DB::table('GameRoom')
            ->where("id", $idGameRoom)
            ->first();

        $validateOk = $this->validatePlay($gameRoom, $idGamer, $square);
        if(!$validateOk)
        {
            return "jugada invalida";
        }

        $playerSymbol = $this->performMove($gameRoom);


        if($this->isVictory($gameRoom, $playerSymbol))
        {
            return "jugador $idGamer gano";
        }

        if($this->isEmpate($gameRoom))
        {
            return "Empate";
        }

        return true;
    }

    private function isVictory($gameRoom, $playerSymbol)
    {
        $boardArray = array();
        $boardArray[0] = $gameRoom->Square1 == $playerSymbol ? true : false ;
        $boardArray[1] = $gameRoom->Square2 == $playerSymbol ? true : false ;
        $boardArray[2] = $gameRoom->Square3 == $playerSymbol ? true : false ;
        $boardArray[3] = $gameRoom->Square4 == $playerSymbol ? true : false ;
        $boardArray[4] = $gameRoom->Square5 == $playerSymbol ? true : false ;
        $boardArray[5] = $gameRoom->Square6 == $playerSymbol ? true : false ;
        $boardArray[6] = $gameRoom->Square7 == $playerSymbol ? true : false ;
        $boardArray[7] = $gameRoom->Square8 == $playerSymbol ? true : false ;
        $boardArray[8] = $gameRoom->Square9 == $playerSymbol ? true : false ;

        foreach(self::$ARRAYS_VICTORY as $arrayVictory)
        {
            if($boardArray === $arrayVictory)
            {
                return true;
            }
        }
        return false;
    }

    private function isEmpate($gameRoom)
    {
        foreach(self::$FIELD_SQUEARE as $squeare)
        {
            if(is_null($gameRoom->$squeare))
            {
                return false;
            }
        }
        return true;
    }

    private function performMove($gameRoom)
    {
        $gameRoom->gamerTurn = $gameRoom->gamer2Id;
        $playerSymbol = 1;
        if($gameRoom->gamerTurn == $gameRoom->gamer2Id)
        {
            $gameRoom->gamerTurn = $gameRoom->gamer1Id;
            $playerSymbol = 2;
        }
        $gameRoom->$square = $playerSymbol;
        $gameRoom->save();
    }
}
