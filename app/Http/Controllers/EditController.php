<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use App\Line;

class EditController extends Controller
{
    public function school(Request $request)
    {
        $id = $request->data;
        $school = School::find($id)->get();

        return view('edit_school',[ 'school'=>$school]);
    }

    public function group(Request $request)
    {
        $id = $request->data;
        $user = Line::where('user_id',$id)->get();
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
