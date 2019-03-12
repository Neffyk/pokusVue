<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\Http\Requests;

class RankingController extends Controller
{
    public function index() {
        $users = User::all();

        return UserResource::collection($users);
    }
}
