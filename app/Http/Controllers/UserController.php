<?php

namespace App\Http\Controllers;

use App\Libraries\JDF;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::find(2);

        return response()->json([
            'user' => $user,
            'projects' => $user->projects
        ], 200);
    }

    public function update(Request $request, $user)
    {
        $user = User::find($user);

        $user->update($request->all());

        return response()->json([
            'error' => false
        ], 200);
    }

    public function store(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $password = $request->get('password');

        $user = new User();
        $jdf = new JDF();

        $user->name = $name;
        $user->phone = $phone;
        $user->email = $email;
        $user->password = $password;
        $user->create_date = $jdf->getTimestamp();
        $user->save();

        if ($user)
            return response()->json([
                'error' => false
            ], 200);
        else
            return response()->json([
                'error ' => true,
                'error_msg' => 'مشکلی بوجود آمده است!!'
            ], 200);
    }


    public function destroy($user)
    {
        $user = User::find($user);
        $user->delete();

        return response()->json([
            'error' => false
        ], 200);
    }


}
