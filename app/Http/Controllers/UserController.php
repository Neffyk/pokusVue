<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\Http\Requests;


class UserController extends Controller
{
    public function index () {

        $users = User::all();

        return UserResource::collection($users);
    }

    public function store(Request $request)
    {
        $user = $request->isMethod('put') ? User::findOrFail
        ($request->user_id) : new User;

        $user->id = $request->input('user_id');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->nickname = $request->input('nickname');
        $user->role = $request->input('role');
        $user->score = $request->input('score');

        if($user->save()) {
            return new UserResource($user);
        }


    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if($user->delete()) {
            return new UserResource($user);
        }

    }

    public function show($email)
    {
        //get a single
        $user = User::where('email', $email)->firstOrFail();

        return new UserResource($user);



    }

    public function update(Request $request)
    {
        $user = User::where('id' , $request->id)->firstOrFail();

        $user->score = $user->score +  $request->input('score');

        if($user->save()) {
            return new UserResource($user);
        }



    }

}
