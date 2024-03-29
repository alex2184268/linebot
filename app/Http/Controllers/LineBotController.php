<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;
/*use Ycs77\LaravelLineBot\Contracts\Response;
use Ycs77\LaravelLineBot\LineBotService;*/

use LINE\LINEBot\Constant\HTTPHeader;




class LineBotController extends Controller
{
    use LineBotService;

    /**
     * The LineBot webhook.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Ycs77\LaravelLineBot\Contracts\Response  $response
     * @return \Illuminate\Http\JsonResponse
     */
    public function webhook(Request $request, Response $response)
    {
        $input = $request->all();//api all 
        $text = array_get($input, 'events.0.message.text'); //object text
        $user_id = array_get($input, 'events.0.source.userId');//object userID  
        $a = $this->bot()->base()->getProfile("$user_id");//獲取user_id 
        $profile = $a->getJSONDecodedBody();//Json decode 

        $sql = new Log;
        $sql->user_id = $user_id; //user id
        $sql->user_name = $profile['displayName']; //名稱
        $sql->message = $text;
        $sql->created_at = now();
        $sql->save();


        return $this->lineBotReply($request, $response);
    }

    
}
