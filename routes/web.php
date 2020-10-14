<?php
use App\School;
use App\Line;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});*/


//Route::post('webhook', 'LineBotController@webhook');

Route::any('webhook','LineWebhookController@webhook');//測試webhook

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function(){
    return view('welcome');
});

Route::middleware(['auth'])->group(function () 
{

    Route::get('apporve', 'ApporveController@index')->name('apporve'); //顯示未審核人員

    Route::post('users.approve', 'ApporveController@apporve')->name('users.approve'); //審核

    Route::post('delete', 'ApporveController@delete')->name('delete');  //取消審核

    Route::get('group.manage','GroupController@index')->name('group'); //群組管理

    Route::get('school.group','GroupController@school_manage')->name('school.group'); //學校管理

    Route::post('edit.school','EditController@school')->name('edit.school'); //編輯學校

    Route::post('edit.group','EditController@group')->name('edit.group'); //編輯群組

    Route::post('update.school', 'EditController@update_school')->name('update.school');//確定修改學校

    Route::post('update.user', 'EditController@update_user')->name('update.user'); //確定修改用戶

    Route::get('custom','PushController@custom')->name('custom');//自訂群組發送訊息

    Route::get('push.school', 'PushController@school')->name('push.school');//學校分群訊息

    /* Route::get('push.district','PushController@district')->name('push.district');//地區分群訊息

    Route::get('push.message','PushController@index')->name('push.message');//推送訊息

    Route::get('push.text','PushController@text')->name('push.text');*/

    Route::get('confirm','PushController@confirm')->name('confirm');

    Route::get('push','PushController@push')->name('push');

    Route::post('check','PushController@check')->name('check');

    Route::post('value', 'PushController@value')->name('value'); //測試request value

    Route::post('delete.school',function(Request $request){
        $sql = School::find($request->data)->delete();
        return redirect()->back();
    })->name('delete.school');

    Route::post('delete.user',function(Request $request){
        $sql = Line::find($request->delete)->delete();
        return redirect()->back();
    })->name('delete.user');

    Route::get('push_text','PushController@push_text')->name('push_text');

    Route::get('excel','ExcelController@index')->name('excel');
    
    Route::post('upload', 'ExcelController@upload')->name('upload');//上傳excel

    Route::get('upload_user', function(){
        return view('upload_user');
    })->name('upload_user'); //上傳使用者

    Route::post('import_user','ImportController@import')->name('import_user');//新增使用者的controller

});

Route::get('register.member', 'RegisterMemberController@index')->name('register_member');//LIFF註冊會員

Route::post('register_info', 'RegisterMemberController@register')->name('register_info');


//Route::post('test', 'LineWebhookController@webhook')->name('line.webhook');


