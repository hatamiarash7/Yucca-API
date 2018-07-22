<?php

namespace App\Http\Controllers;

use App\Libraries\JDF;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{

    private $user_path;

    public function __construct()
    {
        $this->user_path = public_path('/images/user');
        $this->makeDirectories();
    }

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
        $name = $request->get('name');
        $phone = $request->get('phone');

        $user = User::find($user);

        $jdf = new JDF();

        $user->name = $name;
        $user->phone = $phone;
        $user->update_date = $jdf->getTimestamp();
        $user->save();

        if (Input::hasFile('image')) {
            $image = $request->file('image');
            $input['imagename'] = 'U_' . $user->id . '.' . $image->getClientOriginalExtension();
            $image->move($this->user_path, $input['imagename']);
            $user->picture = $input['imagename'];
            $user->save();
        }

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


    private function makeDirectories()
    {
        if (!is_dir($this->user_path))
            mkdir($this->user_path, 0777, true);
        chmod($this->user_path, 0777);
    }


}
