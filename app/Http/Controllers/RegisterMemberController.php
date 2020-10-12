<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use App\District;
use App\Line;

class RegisterMemberController extends Controller
{
    public function index(Request $request) {
        $school   = School::all();
        $district = District::all();
        return view('register_member',[ 'school'   => $school,
                                        'district' => $district]);
    }

    public function register(Request $request) {
        $line = new Line;
        $line->user_id      = $request->YourProfile;
        $line->person_name  = $request->name;
        $line->created_at = now();
        $line->school       = $request->school_list;
        $line->phone        = $request->phone;

        if($line->save()) {
            return '<html><script>alert("已收到您的資料，請靜待審核");</script></html>';
        }
    }
}
