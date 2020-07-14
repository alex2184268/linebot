<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use App\Line;
use App\District;
use App\Group;

class EditController extends Controller
{
    public function school(Request $request)
    {
        $id = $request->data;
        $school = School::find($id);
        $district = District::all();
        $group = Group::all();

        return view('edit_school',[ 'school'=> $school,
                                    'district' => $district,
                                    'group' => $group ]);
    }

    public function group(Request $request)
    {
        $id = $request->data;
        $user = Line::find($id);
        $school = School::all();

        return view('edit_user', ['user' => $user, 'school'=>$school]);
        

    }

    public function update_user(Request $request)
    {
        $sql = Line::find($request->user_id);
        $sql->user_name = $request->user_name;
        $sql->person_name =  $request->person_name;
        $sql->school = $request->school;
        $sql->phone = $request->phone; 

        if($sql->save())
        {
            return  redirect()->route('group');
        }


    }
}
