<?php

namespace App;

use App\Kid;
use App\Vote;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = ['artist', 'songname', 'kid_id', 'artist_track'];

    public function kid() {
        return $this->belongsTo('App\Kid');
    }

    public function votes() {
        return $this->hasMany('App\Vote');
    }
}
