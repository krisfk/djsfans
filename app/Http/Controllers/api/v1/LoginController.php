<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Member;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {

            $email=$request['email'];
            $password=$request['password'];
          
            $member=Member::where('email',$email)->first();
            $db_pw=$member['password'];
            
            if(Hash::check($password, $db_pw))
            {
                $success['token'] =  $member->createToken('authToken')->accessToken;
                // $success['member_code'] =  $member['member_code'];
               
            //    $request->session()->put('member_code',$member['member_code']);

               return response()->json(['success' => $success],200);
                //   $accessToken=  Auth::guard('member')->user()->createToken('authToken')->accessToken;
                //  return response(['member'=>Auth::guard('member')->user(),'access_token'=>$accessToken]);     
            }
            else
            {   
                return response()->json(['error'=>'Unauthorised','code'=>401]);
            }
    
      

    }
    //
}