<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{   
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function users(){
        return $this->belongsToMany('App\User','memberships');
    }

    public function chats()
    {
        return $this->hasMany('App\Chat');
    }
}
