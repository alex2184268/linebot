<?php

namespace App\Http\Controllers;

use App\Line;
use Illuminate\Http\Request;

class ApporveController extends Controller
{
    public function index()
    {
        $data = Line::whereNull('apporved')->get();
        return view('apporve', ['users' => $data]);
    }

    public function apporve($user_id)
    {
        $user = Line::findOrFail($user_id);
        $user->apporved = now();

        if ($user->save()) {
            return redirect()->route('home')->withMessage('審核成功'); //審核成功
        }

    }

    public function delete(Request $request)
    {
        $delete = $request->delete;
        Line::where('user_id', $delete)->delete();

        try {
            $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('gBQKRzMBMThDW7dhQhwfyHad3jp27SMGi/YiB0hsCM+veDAhuMYd3awSh/9dUyOys6F0wT+3wbl3dpnC5DONrlH3zk5mnrz7a5igamK3SArSkYwBh6WTGt3xvhAZWQUe0/L4y+RHbpS188I9LjOjJgdB04t89/1O/w1cDnyilFU=');
            $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '582dabf4363f6b9783f5de5d2247b194']);

            /** $httpClient = channel access token  $bot = channel secret */
            $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('您好! 您的審核未通過');

            $bot->pushMessage("{$delete}",$textMessageBuilder);

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('home');
    }
}
