<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function files()
    {
        return $this->hasMany(File::class, 'item_id');
    }

    public function remind()
    {
        return $this->belongsTo(Remind::class, 'item_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}