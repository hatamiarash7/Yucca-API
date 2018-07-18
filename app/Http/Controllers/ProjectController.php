<?php

namespace App\Http\Controllers;

use App\Libraries\JDF;
use App\Project;
use App\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $project = Project::find(2);

        return response()->json([
            'project' => $project,
            'users' => $project->users
        ], 200);
    }

    public function create(Request $request)
    {
        $jdf = new JDF();
        $name = $request->get('name');

        $project = new Project();
        $project->name = $name;
        $project->create_date = $jdf->getTimestamp();
        $project->save();

        $users = User::all();
        foreach ($users as $user)
        $project->users()->attach($user);
    }
}
