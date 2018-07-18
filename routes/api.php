<?php

use Illuminate\Http\Request;

Route::resources([
    'users'=> 'UserController',
    'projects'=>'ProjectController',
    'items'=>'ItemController',
    'files'=>'FileController',
    'reminds'=>'RemindController'
]);