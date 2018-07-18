<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $hidden = ['users'];

    public function items()
    {
        return $this->hasMany(Item::class, 'project_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
