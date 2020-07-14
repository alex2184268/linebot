<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'line_school';

    protected $fillable = [
        'id','district_id','SCHOOL_NAME','create_time','school_type'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id';

    public function group()
    {
        return $this->belongsTo('App\Group','id');
    }

    public function district()
    {
        return $this->belongsTo('App\District');
    }

    
}
