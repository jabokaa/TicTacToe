<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameRoom;
use Illuminate\Support\Facades\DB;
use Cookie;
use Log;
use HTML;

class GameRoomController extends Controller
{

    private static $PATH_X = "x.png";
    private static $PATH_O = "o.png";

    public function restartGame(Request $request)
    {
        $idGameRoom = $request->idGameRoom;
        $gameRoom = GameRoom::find($idGameRoom);
        $gameRoom->Square1 = '';
        $gameRoom->Square2 = '';
        $gameRoom->Square3 = '';
        $gameRoom->Square4 = '';
        $gameRoom->Square5 = '';
        $gameRoom->Square6 = '';
        $gameRoom->Square7 = '';
        $gameRoom->Square8 = '';
        $gameRoom->Square9 = '';
        $gameRoom->gameState = "";
        $gameRoom->save();
        return view("game", compact('gameRoom'));
    }
    public function createGame()
    {
        if(Cookie::get("idGamer"))
        {
            $idGamer = Cookie::get("idGamer");
        }
        else
        {
            $idGamer = DB::table('Gamers')->insertGetId([]);
        }

        $idGame = DB::table('game_rooms')->insertGetId(
            ['gamer1Id' => $idGamer, "gamerTurn" => $idGamer]
        );

        $gameRoom = DB::table('game_rooms')
            ->where("id", $idGame)
            ->first();

        Cookie::queue("idGamer", $idGamer);
        return view("game", compact('gameRoom'));
    }

    public function comeIntoPlay($idGameRoom)
    {
        $gameRoom = GameRoom::find($idGameRoom);

        if($gameRoom->gamer2Id == 0)
        {
            if(Cookie::get("idGamer"))
            {
                if($gameRoom->gamer1Id != Cookie::get("idGamer"))
                {
                    $gameRoom->gamer2Id = Cookie::get("idGamer");
                    $gameRoom->save();
                }
            }
            else
            {
                $gameRoom->gamer2Id = DB::table('Gamers')->insertGetId([]);
                Cookie::queue("idGamer", $gameRoom->gamer2Id);
                $gameRoom->save();
            } 
        }
        return view("game", compact('gameRoom'));
    }

    private static $FIELD_SQUEARE = array(
        'Square1','Square2','Square3','Square4','Square5','Square6','Square7','Square8','Square9'
    );

    private function validatePlay($gameRoom, $idGamer, $square)
    {
        
        if($gameRoom->gamer2Id == 0)
        {
            return false;
        }
        if($gameRoom->gameState != '')
        {
            return false;
        }
        if($gameRoom->gamerTurn != $idGamer)
        {
            return false;
        }
        else if($gameRoom->$square != '')
        {
            return false;
        }
        return true;
    }

    public function jugar(Request $request)
    {
        $idGamer = Cookie::get("idGamer");
        $square = $request->square;
        $idGameRoom = $request->idGameRoom;
        $gameRoom = GameRoom::find($idGameRoom);

        $validateOk = $this->validatePlay($gameRoom, $idGamer, $square);
        if(!$validateOk)
        {
            return "jugada invalida";
        }
        $playerSymbol = $this->performMove($gameRoom, $square);

        if($this->isVictory($gameRoom, $playerSymbol))
        {
            $gameRoom->gameState = "Jugador $idGamer Gano";
            $gameRoom->save();
            return;
        }
        if($this->isEmpate($gameRoom))
        {
            $gameRoom->gameState = "Empate";
            $gameRoom->save();
            return;
        }

        return true;
    }

    private function isVictory($gameRoom, $playerSymbol)
    {
        $winningCondition1 = ($gameRoom->Square1 == $playerSymbol) && ($gameRoom->Square2 ==
            $playerSymbol) && ($gameRoom->Square3 == $playerSymbol);
        $winningCondition2 = ($gameRoom->Square4 == $playerSymbol) && ($gameRoom->Square5 ==
           $playerSymbol) && ($gameRoom->Square6 == $playerSymbol);
        $winningCondition3 = ($gameRoom->Square7 == $playerSymbol) && ($gameRoom->Square8 ==
           $playerSymbol) && ($gameRoom->Square9 == $playerSymbol);
        $winningCondition4 = ($gameRoom->Square1 == $playerSymbol) && ($gameRoom->Square4 == 
           $playerSymbol) && ($gameRoom->Square7 == $playerSymbol);
        $winningCondition5 = ($gameRoom->Square2 == $playerSymbol) && ($gameRoom->Square5 ==
           $playerSymbol) && ($gameRoom->Square8 == $playerSymbol);
        $winningCondition6 = ($gameRoom->Square3 == $playerSymbol) && ($gameRoom->Square6 ==
           $playerSymbol) && ($gameRoom->Square9 == $playerSymbol);
        $winningCondition7 = ($gameRoom->Square1 == $playerSymbol) && ($gameRoom->Square5 == 
           $playerSymbol) && ($gameRoom->Square9 == $playerSymbol);
        $winningCondition8 = ($gameRoom->Square3 == $playerSymbol) && ($gameRoom->Square5 == 
           $playerSymbol) && ($gameRoom->Square7 == $playerSymbol);

        if($winningCondition1 || $winningCondition2 || $winningCondition3 || $winningCondition4
            || $winningCondition5 || $winningCondition6 || $winningCondition7 || $winningCondition8)
        {
            return true;
        }
        return false;
    }

    private function isEmpate($gameRoom)
    {
        foreach(self::$FIELD_SQUEARE as $squeare)
        {
            if($gameRoom->$squeare == '')
            {
                return false;
            }
        }
        $gameRoom->gameState = "El juego empato";
        $gameRoom->save();
        return true;
    }

    private function performMove($gameRoom, $square)
    {

        $gamerTurn = $gameRoom->gamer2Id;
        $playerSymbol = self::$PATH_X;
        if($gameRoom->gamerTurn == $gameRoom->gamer2Id)
        {
            $gamerTurn = $gameRoom->gamer1Id;
            $playerSymbol = self::$PATH_O;
        }

        $gameRoom->gamerTurn = $gamerTurn;
        $gameRoom->$square = $playerSymbol;
        $gameRoom->save();
        return $playerSymbol;
    }
}
