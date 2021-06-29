<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use GuzzleHttp\Client;
use App\Member;
use App\PHPmailerController;
use Session;
// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;


class TestController extends Controller
{
    public function index(Request $request)
    {

        // $p = new PHPmailerController();
        // $p->send2();
//            echo 11;
        // $m = Member::where('email','krisfk@gmail.com')->first();
     
        // $timestamp = now();
        // $db_timestamp = $m['update_password_timestamp'];
        // echo 'db:'.$db_timestamp.'<br/>';
        // echo 'now:'.$timestamp.'<br/>';

        // if ($db_timestamp >=$timestamp)
        // {
        //     // echo 'not meet';
        // }
        // else
        // {
        //     // echo 'past';
        // }

        // $ts1 = strtotime($timestamp);
        // $ts2 = strtotime($db_timestamp);     
        // $seconds_diff = $ts2 - $ts1;                               
        // $time = ($seconds_diff);

        // echo $time;

    }

    public function test()
    {
        // return auth()->user();

        echo 999;
    }
}