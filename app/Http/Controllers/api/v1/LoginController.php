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
                $data['login_email']=$email;
                $data['whatapps_number']=$password;
                $data['full_name']=$member['full_name'];

                
               return response()->json(['success' => $success,'data'=>$data],200);
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