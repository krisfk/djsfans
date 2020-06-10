<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use Illuminate\Support\Facades\Http;
use Session;
use Illuminate\Support\Facades\Auth;



class SmsCheckController extends Controller
{
    public function index(Request $request)
    {
        //   $m = new Member;
        
        $m = Member::where('email_activation_code',$request['ec'])
                    ->where('active_account',1)
                    ->first();
        //already active
        if($m)
        {
           return view('sms-check')->with('activated',1);
        }
    
        if($request['submit'])
        {

            $m = Member::where('sms_activation_code',$request['sms_code'])
                        ->where('email_activation_code',$request['ec'])
                        ->first();
            
            if($m)
            {
                $m->update(['active_account' => 1]);
                 
                // $request->session()->put('member_code', $m['member_code']);
                    
                // if(Auth::login($m))
                    Auth::login($m);
                // {
                    return view('sms-check')->with('submitted_status','correct');
                // }

                
            }
            else{
                return view('sms-check')->with('submitted_status','incorrect');
            }
            
        }
        else
        {
            $m = Member::where('email_activation_code', $request['ec'])->first();
            
            if($m)
            {
               $region = $m->region;
               $whatsapp_number = $m->whatsapp_number;
                
               $sms_pass = self::send_sms($region.$whatsapp_number);
               $m->update(['sms_activation_code' => $sms_pass]);
               return view('sms-check')->with('email_activation_code',$request['ec']);
            }
            else
            {
                return view('sms-check');
            }
        }
         
        
         
    }


    public function send_sms($tel)
    {
 
        $sms_pass=  self::gen_sms_code();
        $response = Http::get('http://s.accessyou-api.com/sms/sendsms-utf8.php?accountno=11033444&pwd=39582987&phone='.$tel.'&msg=djsfans'.urlencode('驗證碼').'%0D'.$sms_pass);

        // 'http://s.accessyou-api.com/sms/sendsms-utf8.php?accountno=11033444&pwd=39582987&phone=85251936670&msg=testmsg';

        return $response ? $sms_pass : 0;
    }

    public function gen_sms_code()
    {
        $alphabet = "0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 6; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }

        $pass = implode("",$pass);
        $_SESSION['sms_pass']=$pass;
        return $pass;
    }
}