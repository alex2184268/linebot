<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use App\Line ;

class LineController extends Controller
{
    private $client;
    private $bot;
    private $channel_access_token;
    private $channel_secret;

    public function __construct()
    {
        $this->channel_access_token = "gBQKRzMBMThDW7dhQhwfyHad3jp27SMGi/YiB0hsCM+veDAhuMYd3awSh/9dUyOys6F0wT+3wbl3dpnC5DONrlH3zk5mnrz7a5igamK3SArSkYwBh6WTGt3xvhAZWQUe0/L4y+RHbpS188I9LjOjJgdB04t89/1O/w1cDnyilFU=";
        $this->channel_secret = "582dabf4363f6b9783f5de5d2247b194";//secret 

        $httpClient = new CurlHTTPClient($this->channel_access_token);
        $this->bot  = new LINEBot($httpClient, ['channelSecret' => $this->channel_secret]);
        $this->client = $httpClient;

    }

    public function webhook(Request $request)
    {
        $bot       = $this->bot;
        $signature = $request->header(\LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE);
        $body      = $request->getContent();

        try {
            $events = $bot->parseEventRequest($body, $signature);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        foreach ($events as $event) {
            $replyToken = $event->getReplyToken();
            if ($event instanceof MessageEvent) {
                $message_type = $event->getMessageType();
                $text = $event->getText();
                switch ($message_type) {
                    case 'text':
                        $bot->replyText($replyToken, "$text");
                        break;
                }
            }
        }
    }

        
    }


    public function index()
    {
        try {
            $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('gBQKRzMBMThDW7dhQhwfyHad3jp27SMGi/YiB0hsCM+veDAhuMYd3awSh/9dUyOys6F0wT+3wbl3dpnC5DONrlH3zk5mnrz7a5igamK3SArSkYwBh6WTGt3xvhAZWQUe0/L4y+RHbpS188I9LjOjJgdB04t89/1O/w1cDnyilFU=');
            $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '582dabf4363f6b9783f5de5d2247b194']);

             //$httpClient = channel access token  $bot = channel secret 

           // $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('');


            $userIds = ['Ue979a6faeb9d49860b128c6de4cba67d'];//userID
            $bot->multicast($userIds,$textMessageBuilder);//$textMessageBuilder文字訊息物件

        } catch (\Throwable $th) {//throw error message
            return $th->getMessage();
        }

    }
}
