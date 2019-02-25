<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    public $timestamps = false;
    protected $fillable = ['sitename', 'partydate', 'starttime', 'endtime', 'venuename', 'venuelocation', 'venuemapurl'];
}
