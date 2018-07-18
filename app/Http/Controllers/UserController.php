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
}
