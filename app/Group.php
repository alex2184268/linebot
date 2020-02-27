<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'group';

    protected $fillable = [
        'id','school_type',
    ];

    protected $primaryKey = 'id';

    public function school()
    {
        return $this->hasMany('App\School');
    }
}
