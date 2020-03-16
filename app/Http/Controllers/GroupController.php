<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use App\District;
use App\Group;
use App\Line;

class GroupController extends Controller
{
    public function index()
    {
        $user = Line::all();
        return view('group',[
            'user' => $user,
        ]);
    }

    public function school_manage()
    {
        $school = School::all();
        return view('school',[ 'school' => $school ]);
    }
}
