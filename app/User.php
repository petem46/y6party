<?php

namespace App;

use App\Kid;
use App\Job;
use App\Comment;
use App\Announcement;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'usergroup_id', 'last_login_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function kids() {
        return $this->belongsToMany('App\Kid');
    }
    public function jobs() {
        return $this->belongsToMany('App\Job');
    }
    public function comments() {
        return $this->hasMany('App\Comment');
    }
    public function annoucements() {
        return $this->hasMany('App\Announcement');
    }
}
