<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Member;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('aaa', function () {
//     return response()->json(Member::all());
// });
// Route::group(['middleware' => ['web']], function () {


Route::group(['prefix' => 'user'],function(){

Route::post('/login',['as' => 'login', 'uses' => 'api\v1\LoginController@Login']);

Route::middleware('auth:api')->post('/test','TestController@test');

Route::middleware('auth:api')->post('/update_point','api\v1\ApiController@update_point');
Route::middleware('auth:api')->post('/get_info','api\v1\ApiController@get_info');
Route::middleware('auth:api')->post('/update_pts','api\v1\ApiController@update_pts');


});