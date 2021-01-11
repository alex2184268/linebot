<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use App\District;
use App\Line;
use App\Jobs\LineUserRegisterJob;

class RegisterMemberController extends Controller
{
    public function index(Request $request) {
        $school   = School::all();
        $district = District::all();
        return view('register_member',[ 'school'   => $school,
                                        'district' => $district]);
    }

    public function register(Request $request) {
        $messages = array(
            'YourProfile.required' => 'You not have userID!', 
            'YourProfile.unique'   => '您的資料正在審核或已通過，勿重複註冊',
            'name.max'             => '使用者名稱過長',
            'required'             => '請填寫所有資料，請勿空白',
            'phone.regex'          => '請填寫正確手機號碼格式，ex:0912345678',

        );


        $validatedData = $request->validate([
            'YourProfile' => 'required|unique:line_user,user_id|max:100',
            'name'        => 'required|max:100',
            'phone'       => 'required|regex:/(09)[0-9]{8}/', //09開頭 0-9數字 還有8個數字
        ],$messages);//
        $UserData = [
            'userID'      => $request->YourProfile,
            'person_name' => $request->name,
            'created_at'  => now(),
            'school'      => $request->school_list,
            'phone'       => $request->phone,
        ];

        if(LineUserRegisterJob::dispatch($UserData)) 
        {
            return '<html><script>alert("已收到您的資料，請靜待審核");</script></html>';
        }else
        {
            return '<html><script>alert("傳送資料失敗!!");</script></html>';
        }
    }
}
