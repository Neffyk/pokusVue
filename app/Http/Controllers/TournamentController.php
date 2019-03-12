<?php

namespace App\Http\Controllers;

use App\Tournament;
use Illuminate\Http\Request;
use App\Http\Resources\Tournament as TournamentResource;
use App\Http\Requests;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Grab tournaments
        $tournaments = Tournament::all();

        return TournamentResource::collection($tournaments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tournament = $request->isMethod('put') ? Tournament::findOrFail
        ($request->tournament_id) : new Tournament;

        $tournament->id = $request->input('tournament_id');
        $tournament->name = $request->input('name');
        $tournament->place = $request->input('place');
        $tournament->ended = false;
        $tournament->start_date = $request->input('start_date');

        if($tournament->save()) {
            return new TournamentResource($tournament);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get a single
        $tournament = Tournament::findOrFail($id);

        return new TournamentResource($tournament);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $tournament = Tournament::findOrFail($id);

        $tournament->ended = true;

        if($tournament->save()) {
            return new TournamentResource($tournament);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tournament = Tournament::findOrFail($id);

        if($tournament->delete()) {
            return new TournamentResource($tournament);
        }

    }
}
