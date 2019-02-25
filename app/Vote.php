<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['song_id', 'kid_id', 'songkid'];

    public function song() {
        return $this->hasOne('App\Song');
    }

}
