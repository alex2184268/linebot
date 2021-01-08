<?php

namespace App\Http\Controllers;


use App\Line;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use App\School;
use App\District;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



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

    public function push()//測試區controller
    {
        try {

            $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('gBQKRzMBMThDW7dhQhwfyHad3jp27SMGi/YiB0hsCM+veDAhuMYd3awSh/9dUyOys6F0wT+3wbl3dpnC5DONrlH3zk5mnrz7a5igamK3SArSkYwBh6WTGt3xvhAZWQUe0/L4y+RHbpS188I9LjOjJgdB04t89/1O/w1cDnyilFU=');
            $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '582dabf4363f6b9783f5de5d2247b194']);

            //$httpClient = channel access token  $bot = channel secret

            $code = '100078';
            $bin = hex2bin(str_repeat('0', 8 - strlen($code)) . $code);
            $emoticon = mb_convert_encoding($bin, 'UTF-8', 'UTF-32BE');


            $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("唉呦,是不是又在亂花錢？\x{1F480}");//放最多5個參數

            //$imageMessageBuilder = new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder('https://line.tyc.edu.tw/images/helloworld.jpeg','https://line.tyc.edu.tw/images/helloworld.jpeg');

            $msg = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();//多個訊息 object


            $msg->add($textMessageBuilder);
            //$msg->add($imageMessageBuilder);

            
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
            $bot->multicast($userds, $error); //$textMessageBuilder文字訊息物件


        }

    }

    public function check(Request $request)
    {
        $a = $request->input('SchoolCode');
        
        

        return view('push_message',[
            'school' => $a]);
    }

    public function value(Request $request)/**發送訊息 function */
    {    
        $school = $request->input('school'); //選取的學校
        $users = array(); //最多150人

        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('8nJlQRLvT+UhK0OeNm+e7DBtPpI2U5BQw44n22mZ7jkrYknKd0E4kOcc6fseFluiBByDxp7iNKPiCN+i1ywq5lMBrw4kX77KNDjErg2+5tzbmyqCbvkHqzhnuQuprAdlb7ej5VZa61hUzW5GQMer5wdB04t89/1O/w1cDnyilFU=');
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '803d36e8fe03804672351bce451b4ca7']);
        $msg = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder(); //群發object


        for( $t=0; $t<5; $t++){
            $type = gettype($request->input("$t"));
            switch ($type) {
                case 'string':
                    $textarea = $request->input("$t");//文字訊息
                    //$textarea = str_replace('\r\n', '<br>', $textarea);
                    //$textMessageBuilder文字訊息物件
                    if (isset($textarea)) {
                        $text = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("$textarea");
                        $msg->add($text);
                    }
                break;
                
                default:
                    if ($request->hasfile("$t")) {
                        $image = $request->file("$t");
                        $name = $image->getClientOriginalName();
                        $Extension = $image->getClientOriginalExtension();
                        
                        $image_file = array ('jpeg','jpg','png');
                        if(in_array($Extension,$image_file)){
                            $image->move(public_path('images'), $name);
                            $imageMessageBuilder = new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder("https://line.tyc.edu.tw/images/$name", "https://line.tyc.edu.tw/images/$name");
                            $msg->add($imageMessageBuilder);
                        }elseif ($Extension =='mp4') {
                            $image->move(public_path('images'), $name);
                            $VideoMessageBuilder = new \LINE\LINEBot\MessageBuilder\VideoMessageBuilder("https://line.tyc.edu.tw/images/$name", "https://line.tyc.edu.tw/images/$name");
                            $msg->add($VideoMessageBuilder);
                        }
                }
                    break;
            }
        }

/**Store mulitple image
 * isValid()  用於判斷檔案是否上傳成功
 * getClientOriginalName()
 * getClientOriginalExtension()
 * 獲取副檔名
 *
 * move(string directory,stringdirectory, string name = null)
 * 將檔案移動到指定目錄
 * getClientSize()
 * 獲取檔案大小
 * */

            $sql = Line::select()->whereIn('school', $school)->whereNotNull('apporved')->get()->toArray();
            foreach ($sql as $item) {
                $users[] = $item['user_id'];
                }
/*
            foreach ($school as $value) {
                $sql = Line::select('user_id')->where('school', $value, 'AND')->whereNotNull('apporved')->get()->toArray(); //找出相符學校的帳號
                foreach ($sql as $item) {
                    $users[] = $item['user_id'];
                }
            }*/

            /**人數檢查 如果超過150就分開存入total_user*/
            $total_user = array();
            $array_element = array();
            $index = 0;
            for($i=0; $i<count($users);$i++){
                $array_element[] = $users[$i];
                if( count($array_element) == 150){
                    $total_user[$index] = $array_element;
                    $index++;
                    unset($array_element);
                }else{
                    $total_user[$index] = $array_element;
                }
            }
            

            /**分開發送 一次最多150個user  []*/
            $count = count($users) ; //總計人數   
            foreach ($total_user as  $value) {
                $bot->multicast($value, $msg); //發送訊息
            }

            return redirect()->route('home')->with('message', "已發送訊息!!共計".$count."位使用者");
            
    }
}


