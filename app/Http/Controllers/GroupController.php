<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use App\District;
use App\Group;

class GroupController extends Controller
{
    public function index()
    {
        
        return view('group');
    }

    public function school_manage()
    {
        $district = School::with('district')->get();
        return view('school',[ 'school' => $district ]);
    }
}
