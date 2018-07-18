<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $user = User::find(2);

        return response()->json([
            'user' => $user,
            'projects' => $user->projects
        ], 200);
    }

    public function update(Request $request, $user){
        $user = User::find($user);

        $user ->update($request->all());

        return response()->json([
            'error'=>false
        ],200);
    }
}
