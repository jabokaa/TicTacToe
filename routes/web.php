<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameRoomController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'game'], function()
{
    Route::get('/', [GameRoomController::class, 'createGame']);
    Route::get('/{gameId}', [GameRoomController::class, 'comeIntoPlay']);
});

Route::PUT('/jugar', [GameRoomController::class, 'jugar']);
