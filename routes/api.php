<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::middleware('auth:api')->group(function () {
//    Route::get('users','UserController@index'); // ukazat len adminovi
//});




Route::post('login', 'AuthController@login');/*->name('login'); // pre hosta*/

Route::post('register', 'AuthController@register'); //pre hosta
Route::middleware('auth:api')->post('/logout','AuthController@logout');  // pre lognutych




//list Tournaments
Route::get('tournaments','TournamentController@index'); // pre lognutych
//list single tournament
Route::get('tournament/{id}' , 'TournamentController@show'); // pre lognutych

//Create new Tournament
Route::post('tournament' , 'TournamentController@store'); // pre lognutych

//update Tournament
Route::put('tournament' , 'TournamentController@store'); // pre lognutych

//delete torutnament
Route::delete('tournament/{id}' , 'TournamentController@destroy'); // pre lognutych

Route::put('endTournament/{id}','TournamentController@update');



Route::get('rankings','RankingController@index');  // pre lognutych





Route::get('users','UserController@index'); // ukazat len adminovi
Route::put('user' , 'UserController@store'); // update usera tiez le npre admina
Route::delete('user/{id}' , 'UserController@destroy'); // len pre admina vymazanie usera

Route::get('user/{email}' , 'UserController@show'); // toto da daneho usera podla emailu  asi tiez len admin

Route::put('addPoints', 'UserController@update');

Route::get('assigned/{tournament_id}','TournamentUsersController@showUsers');  // pre lognutych ukaze vsetkych ludi co su na danom turnaji

Route::get('userAssignedTournaments/{user_id}','TournamentUsersController@showTournaments');  // pre lognutych ukaze vsetky tyrnaje pre daneho cloveka

Route::delete('userAssignedTournament/{tournament_id}/{user_id}','TournamentUsersController@destroy');

Route::post('assign','TournamentUsersController@store'); // pre lognutych





