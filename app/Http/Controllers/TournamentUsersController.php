<?php

namespace App\Http\Controllers;

use App\TournamentUser;
use Illuminate\Http\Request;
//use App\Http\Resources\TournamentUser as TournamentUserResource;
use App\Http\Requests;

use App\User;
use App\Tournament;


class TournamentUsersController extends Controller
{
    // Grab tournaments
    public function showUsers($tournament_id)
    {
        // Grab tournaments
//        $tournamentUser = TournamentUser::where('tournament_id', $tournament_id )->get();
//
//        return  TournamentUserResource::collection($tournamentUser);

        $users = Tournament::findOrFail($tournament_id)->users;
        return $users;


    }

    public function showTournaments($user_id)
    {
//        // Grab tournaments
//        $tournamentUser = TournamentUser::where('user_id', $user_id )->get();
//
//        return  TournamentUserResource::collection($tournamentUser);

        $tournaments = User::findOrFail($user_id)->tournaments;
        return $tournaments;
    }


    public function store(Request $request)
    {
//        $tournamentUser = $request->isMethod('put') ? TournamentUser::findOrFail
//        ($request->id) : new TournamentUser();
//
//        $tournamentUser->user_id = $request->input('user_id');
//        $tournamentUser->tournament_id = $request->input('tournament_id');
//
//        if($tournamentUser->save()) {
//            return new TournamentUserResource($tournamentUser);
//        }


        // najdem turnaj a tomu attachnem usera
//        $user = App\User::find(1);
//
//        $user->roles()->attach($roleId);

        $tournament = Tournament::findOrFail($request->tournament_id)->users()->attach($request->user_id);

        return $tournament;

    }

    public function destroy($tournament_id,$user_id)
    {
        //TournamentUser::where('tournament_id', $tournament_id)->where('user_id',$user_id)->delete();

        $user = User::findOrFail($user_id)->tournaments()->detach($tournament_id);

        return $user;






    }


}
