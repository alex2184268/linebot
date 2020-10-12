<?php

namespace App\Http\Controllers;

use App\Line;
use Illuminate\Http\Request;

class ApporveController extends Controller
{
    public function index()
    {
        $data = Line::whereNull('apporved')->orWhere('apporved','=','')->get();
        return view('apporve', ['users' => $data]);
    }

    public function apporve(Request $request)
    {
        $user_id = $request->user_id;
        $user = Line::findOrFail($user_id);
        $user->apporved = now();

        if ($user->save()) {
            $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('8nJlQRLvT+UhK0OeNm+e7DBtPpI2U5BQw44n22mZ7jkrYknKd0E4kOcc6fseFluiBByDxp7iNKPiCN+i1ywq5lMBrw4kX77KNDjErg2+5tzbmyqCbvkHqzhnuQuprAdlb7ej5VZa61hUzW5GQMer5wdB04t89/1O/w1cDnyilFU=');
            $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '803d36e8fe03804672351bce451b4ca7']);
            
            $time = now();

            $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("您好!! 您的帳號已被審核成功 審核時間:{$time}");
            $response = $bot->pushMessage("{$user_id}", $textMessageBuilder);

            return redirect()->route('apporve')->withMessage('審核成功'); //審核成功
        }

    }

    public function delete(Request $request)
    {
        $delete = $request->delete;
        Line::where('user_id', $delete)->delete();

        try {
            $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('8nJlQRLvT+UhK0OeNm+e7DBtPpI2U5BQw44n22mZ7jkrYknKd0E4kOcc6fseFluiBByDxp7iNKPiCN+i1ywq5lMBrw4kX77KNDjErg2+5tzbmyqCbvkHqzhnuQuprAdlb7ej5VZa61hUzW5GQMer5wdB04t89/1O/w1cDnyilFU=');
            $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '803d36e8fe03804672351bce451b4ca7']);

            /** $httpClient = channel access token  $bot = channel secret */
            $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('您好! 您的審核未通過');

            $bot->pushMessage("{$delete}", $textMessageBuilder);

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('home');
    }
}
