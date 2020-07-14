<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    protected $table = 'line_user';

    protected $fillable = [
        'id','user_id', 'created_at', 'apporved', 'person_name', 'school', 'phone',
    ];

    protected $primaryKey = 'id'; //主鍵

    public $timestamps = false;

    protected $keyType = 'string';

    //public $incrementing = false;
}
