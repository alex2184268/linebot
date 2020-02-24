<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ycs77\LaravelLineBot\Contracts\Response;
use Ycs77\LaravelLineBot\LineBotService;

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
        return $this->lineBotReply($request, $response);
    }
}
