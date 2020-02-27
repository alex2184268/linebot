<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;

class EditController extends Controller
{
    public function school(Request $request)
    {
        $id = $request->data;
        $school = School::find($id)->get();

        return view('edit_school',[ 'school'=>$school]);
    }
}
