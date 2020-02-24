<?php
use App\Line;
use Ycs77\LaravelLineBot\Facades\LineBot as LineBot_PK;

LineBot_PK::on()->text('嗨', function () {
    $profile = LineBot_PK::profile();

    LineBot_PK::text("你好啊~{$profile->name()}")->reply();
});

LineBot_PK::on()->text('管理員廣播！！！', function () {
    $profile = LineBot_PK::profile();

});

LineBot_PK::on()->text('查詢資料', function () {
    $profile = LineBot_PK::profile();
    $line_name = $profile->name(); //當前使用者姓名
    $line_id = $profile->id(); //當前使用者ID

    $sql = Line::find($line_id);

    if ($sql->user_id == $profile->id()) {
        LineBot_PK::text("{$line_name}您好~您的使用者資料已經登入囉!!")->reply();
    } else {
        LineBot_PK::text("{$line_name}您好~您的資料尚未登入在資料庫")->reply();

    }

    LineBot_PK::text("你好啊~{$profile->name()}")->reply();
});

LineBot_PK::on()->fallback(function () {
    LineBot_PK::text("您好，這裡是Tyc_edu_LINEBot~\n感謝您加入官方帳號\n剛加入者請先輸入'user'儲存您的使用者資料到後端資料庫，以下是指令列表:
1．user：建立資料至資料庫\n
2．profile：顯示您的使用者資訊\n
3．查詢資料：查詢您的資料是否已建立在資料庫")->reply();
});

LineBot_PK::on()->text('user', function () {
    $profile = LineBot_PK::profile();
    $sql = new Line;
    $sql->user_id = $profile->id();
    $sql->user_name = $profile->name();
    $sql->user_picture = $profile->picture();
    $sql->created_at = now();

    if ($sql->save()) {
        LineBot_PK::text("你好{$profile->name()}，已經將您的使用者資料儲存在資料庫! userID:{$profile->id()}")->reply();
    } else {
        LineBot_PK::text("很抱歉，儲存使用者資料失敗或者您已經存取過!可以試著回覆’查詢資料’來確認是否已有資料")->reply();
    }

});

LineBot_PK::on()->text('profile', function () {
    $profile = LineBot_PK::profile();
    LineBot_PK::text("名稱:{$profile->name()}、使用者ID:{$profile->id()}、大頭貼:{$profile->picture()}")->reply();

});

/*

LineBot_PK::on()->text('LINE', function () {
$this->channel_access_token = env('LINE_BOT_CHANNEL_ACCESS_TOKEN');
$this->channel_secret = env('LINE_BOT_CHANNEL_SECRET');

$httpClient = new CurlHTTPClient($this->channel_access_token);
$this->bot = new LINEBot($httpClient, ['channelSecret' => $this->channel_secret]);
$this->client = $httpClient;

$userIds = ['Ucecf9ffd4b96557b296995f206811fd6'];
$bot->multicast($userIds, '嗨譽中 <特定用戶訊息TEST>');
});
 */
//$ textMessageBuilder  =  new  \ LINE \ LINEBot \ MessageBuilder \ TextMessageBuilder（' hello '）;
