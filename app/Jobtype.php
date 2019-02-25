<?php

namespace App;

use App\Job;
use Illuminate\Database\Eloquent\Model;

class Jobtype extends Model
{
    public function jobs() {
        return $this->hasMany('App\Job');
    }
}
