<?php

namespace App;

use App\User;
use App\Job;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment', 'job_id', 'user_id'
    ];

    protected $touches = ['jobs'];

    public function author() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function jobs() {
        return $this->belongsTo('App\Job');
    }

}
