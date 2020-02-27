<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'message_log';

    protected $fillable = [
      'user_id','user_name','message','created_at'
    ];

    public $timestamps = false;
}
