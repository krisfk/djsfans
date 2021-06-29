<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use Session;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user())
        {
            $member = Auth::user();
             return view('home')->with('member',$member);
        }
        else
        {
            return view('home');
        }
        
    
    }

}