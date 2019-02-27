<?php

namespace App;

use App\User;
use App\Jobtype;
use App\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Job extends Model
{
    protected $fillable = [
        'name', 'jobtype_id', 'details', 'users_required', 'completed'
    ];

    public function users() {
        return $this->belongsToMany('App\User');
    }
    public function jobtype() {
        return $this->belongsTo('App\Jobtype');
    }
    public function comments() {
        return $this->hasMany('App\Comment');
    }
    public function addComment($comment) {
        Comment::create([
            'comment' => $comment,
            'job_id' => $this->id,
            'user_id' => Auth::id(),
        ]);
        Job::where('id', $this->id)->update(array('updated_at' => now()));
    }
}
