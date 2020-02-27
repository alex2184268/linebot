<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'line_district';

    protected $fillable = [
        'id','DISTRICT',
    ];

    protected $primaryKey = 'id';

    public function school()
    {
        return $this->hasMany('App\School');
    }
}
