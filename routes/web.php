<?php
use App\School;
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


Route::post('webhook', 'LineBotController@webhook');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function(){
    return view('welcome');
});

Route::middleware(['auth'])->group(function () 
{

    Route::get('apporve', 'ApporveController@index')->name('apporve'); //顯示未審核人員

    Route::get('users.approve/{user_id}', 'ApporveController@apporve')->name('users.approve'); //審核

    Route::post('delete', 'ApporveController@delete')->name('delete');  //取消審核

    Route::get('group.manage','GroupController@index')->name('group'); //群組管理

    Route::get('school.group','GroupController@school_manage')->name('school.group'); //學校管理

    Route::post('edit.school','EditController@school')->name('edit.school'); //編輯學校

    Route::post('delete.school',function(Request $request){
        $sql = School::find($request->data)->delete();
        return redirect()->back();
    })->name('delete.school');

});


Route::post('test', 'LineWebhookController@webhook')->name('line.webhook');



