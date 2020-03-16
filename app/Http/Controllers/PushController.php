<?php

namespace App\Http\Controllers;


use App\Line;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use App\School;
use App\District;

class PushController extends Controller
{
    public function index()
    {
        $school = School::all();
        $district = District::all();
        return view('push_message',['school' => $school, 'district' => $district]);

    }

    public function push()
    {
        try {

            $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('gBQKRzMBMThDW7dhQhwfyHad3jp27SMGi/YiB0hsCM+veDAhuMYd3awSh/9dUyOys6F0wT+3wbl3dpnC5DONrlH3zk5mnrz7a5igamK3SArSkYwBh6WTGt3xvhAZWQUe0/L4y+RHbpS188I9LjOjJgdB04t89/1O/w1cDnyilFU=');
            $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '582dabf4363f6b9783f5de5d2247b194']);

            //$httpClient = channel access token  $bot = channel secret

            $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('12345');

            $userIds = ['U51cbf7fcc05c0be743af13086dec11f1']; //userID
            $bot->multicast($userIds, $textMessageBuilder); //$textMessageBuilder文字訊息物件

        } catch (\Throwable $th) { //throw error message
            return $th->getMessage(); //get error message
        }

    }
}
