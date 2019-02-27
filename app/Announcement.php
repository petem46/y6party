<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'details', 'user_id'
    ];

    public function author() {
        return $this->belongsTo(User::class,'user_id');
    }

}
