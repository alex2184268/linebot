<?php

namespace App\Http\Controllers;


use App\Line;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use App\School;
use App\District;
use App\Group;
use Illuminate\Http\Request;


class PushController extends Controller
{
    public function index()
    {
        return view('push_message');
    }

    public function custom()
    {
        

    }

    public function school()
    {
        $school = School::all();
        $district = District::all();
        $group = Group::all();
        return view('push_school', ['school' => $school, 
                                    'district' => $district,
                                    'group'=> $group]);

    }

    public function district()
    {
        $school = School::all();
        $district = District::all();
        return view('push_district', ['school' => $school, 'district' => $district]);

        
    }

    public function text()
    {
        return view('push_text');
    }

    public function push()
    {
        try {

            $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('gBQKRzMBMThDW7dhQhwfyHad3jp27SMGi/YiB0hsCM+veDAhuMYd3awSh/9dUyOys6F0wT+3wbl3dpnC5DONrlH3zk5mnrz7a5igamK3SArSkYwBh6WTGt3xvhAZWQUe0/L4y+RHbpS188I9LjOjJgdB04t89/1O/w1cDnyilFU=');
            $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '582dabf4363f6b9783f5de5d2247b194']);

            //$httpClient = channel access token  $bot = channel secret

            

            $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('1','3');//放最多5個參數

            $imageMessageBuilder = new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder('https://reurl.cc/qdmkZR','https://reurl.cc/qdmkZR');

            $msg = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();

            $msg->add($textMessageBuilder);
            $msg->add($imageMessageBuilder);

            
            /**
             * 
             * 'type' => MessageType::IMAGE,
             * 'originalContentUrl' => $this->originalContentUrl,
             * 'previewImageUrl' => $this->previewImageUrl,
             */

            $userIds = ['U51cbf7fcc05c0be743af13086dec11f1']; //userID
            $bot->multicast($userIds, $msg); //$textMessageBuilder文字訊息物件
            //$bot->multicast($userIds, '<message>');


        } catch (\Throwable $th) { //throw error message
            $error = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($th->getMessage());
            $userIds = ['U51cbf7fcc05c0be743af13086dec11f1']; //userID
            $bot->multicast($userIds, $error); //$textMessageBuilder文字訊息物件


        }

    }

    public function check(Request $request)
    {
        $a = $request->input('SchoolCode');
        $school_id = array_values($a);
        $school_name = array_keys($a);
        
        foreach ($school_id as $value) {
            $user = User::where('school_id',$value)->get();
        }

        return view('push_message',[
            'school_name' => $school_name,
            'school_id' => $school_id,]);
    }

    public function value(Request $request)
    {
        return $request;
    }
}
