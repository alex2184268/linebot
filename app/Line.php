<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    protected $table = 'line_user';

    protected $fillable = [
        'user_id', 'user_name', 'user_picture', 'created_at', 'apporved', 'person_name','school','phone'
    ];

    protected $primaryKey = 'user_id';//主鍵

    public function scopePopular($query)
    {
        return $query->where('votes', '>', 100);
    }

    public $timestamps = false;
    
    protected $keyType = 'string';
    
    //public $incrementing = false;
}
