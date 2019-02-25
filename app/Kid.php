<?php

namespace App;

use App\User;
use App\Song;
use Illuminate\Database\Eloquent\Model;

class Kid extends Model
{
    protected $fillable = [
        'kidname', 'hoodiename'
    ];

    //
    public function users() {
        return $this->belongsToMany('App\User');
    }
    public function songs() {
        return $this->hasMany('App\Song');
    }
}
