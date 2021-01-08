<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LINE\LINEBot\Constant\HTTPHeader;


class LineWebhookController extends Controller
{

    public function webhook(Request $request){
        $channel_access_token = "8nJlQRLvT+UhK0OeNm+e7DBtPpI2U5BQw44n22mZ7jkrYknKd0E4kOcc6fseFluiBByDxp7iNKPiCN+i1ywq5lMBrw4kX77KNDjErg2+5tzbmyqCbvkHqzhnuQuprAdlb7ej5VZa61hUzW5GQMer5wdB04t89/1O/w1cDnyilFU=";
        $channel_secret = "803d36e8fe03804672351bce451b4ca7";

        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($channel_access_token);
        $bot = new \LINE\LINEBot($httpClient,['channelSecret' => $channel_secret]);
        $signature = $request->header(HTTPHeader::LINE_SIGNATURE); //取得sign簽證 
        $body = $request->getContent();
        $events = $bot->parseEventRequest($body, $signature);
        foreach ($events as $event) {
            if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage) { //確認是否跟TextMessage同一個CLASS
                $reply_token = $event->getReplyToken();
                /*$text = "已收到您的訊息";
                $bot->replyText($reply_token, $text);*/
            }
        }

        /**儲存訊息 */
        $input = $request->all(); //api all
        $text = array_get($input, 'events.0.message.text'); //object text
        $user_id = array_get($input, 'events.0.source.userId'); //object userID
        $response = $bot->getProfile($user_id);
        if ($response->isSucceeded()) {
            $profile = $response->getJSONDecodedBody();
            $sql = new Log;
            $sql->user_id = $user_id; //user id
            $sql->user_name = $profile['displayName']; //名稱
            $sql->message = $text;
            $sql->created_at = now();
            $sql->save();

        }

    }
}
