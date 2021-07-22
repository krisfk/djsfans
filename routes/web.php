<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'web'], function () {

    Route::get('/', ['uses' => 'HomeController@index']);

Route::get('about-djsfans', function () {
    return view('about-djsfans');
});

Route::get('app', function () {
    return view('app');    
});
Route::get('how', function () {
    return view('how');    
});

Route::get('terms', function () {
    return view('terms');    
});

// Route::get('sms-check', function () {
//     return view('sms-check');    
// });

Route::get('register', function () {
    return view('register');    
});

Route::get('test', function () {
    return view('test');    
});

Route::post('member/create', ['uses' => 'MemberController@create']);
Route::get('member/create', function (){
    return redirect('register');
}) ;


// Route::post('test_email', ['uses' => 'PHPmailerController@send']);
Route::post('send-email',['uses' => 'PHPmailerController@send'] )->name('send-email');
Route::get('send-email2',['uses' => 'PHPmailerController@send2'] );//->name('send-email2');

Route::get('sms-check', ['uses' => 'SmsCheckController@index']);                            
Route::post('sms-check', ['uses' => 'SmsCheckController@index']);

Route::post('test2',['uses' => 'PHPmailerController@testing'] )->name('test2');
Route::get('test2',['uses' => 'PHPmailerController@get_token'] );

Route::get('test3', ['uses'=>'TestController@index']);
Route::get('test4', function () {return 999;    });
Route::get('test5', function () {return 999;    });


Route::get('qr-code-g', function () {
    // \QrCode::size(500)
    //           ->format('png')
    //           ->generate('ItSolutionStuff.com', public_path('images/qrcode.png'));
      
    return view('qrCode');
      
  });

Route::get('logout', ['uses'=>'MemberController@logout']);
Route::get('login', ['uses'=>'MemberController@login']);
Route::post('login', ['uses'=>'MemberController@login']);

Route::get('forgot-pw', ['uses'=>'MemberController@forgot_pw']);
Route::post('forgot-pw', ['uses'=>'MemberController@forgot_pw']);

Route::get('reset-pw', ['uses'=>'MemberController@reset_pw']);
Route::post('reset-pw', ['uses'=>'MemberController@reset_pw']);



// Route::post('login', ['uses'=>'MemberController@login']);

Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');

Route::get('input','MemberController@update_points');
Route::post('input','MemberController@update_points');

Route::get('history', 'MemberController@show_history');
Route::get('scanner','MemberController@scanner');
Route::post('scanner','MemberController@scanner');


Route::get('/csv_index', 'CsvController@index'); // localhost:8000/
Route::post('/uploadFile', 'CsvController@uploadFile');

});