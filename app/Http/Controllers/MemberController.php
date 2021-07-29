<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Mail;
use App\Member;
use App\Member_records;
use Illuminate\Support\Facades\Auth;


class MemberController extends Controller
{
    public function create(Request $request)
    {
                $data['full_name'] = $request['full_name'];
                $data['region'] = $request['region'];
                $data['whatsapp_number'] = $request['whatsapp_number'];
                $data['email'] = $request['email'];
            
                
            if (Member::where('email', $request['email'])->exists()) {
                
                $data['error']='email_registered';
                 
                return view('register',['data'=>$data]);
            }
            else{
                $member = new Member;
            
                $secret_code = 1014;
                $idx = 2*Member::count()+$secret_code;
    
                $member_code = 'DJS'.date("Y").'-'.$idx;
                
                $member->member_code = $member_code;
                $member->full_name = $request['full_name'];
                $member->region = $request['region'];
                $member->whatsapp_number = $request['whatsapp_number'];
                $member->email = $request['email'];
                $member->password =  Hash::make($request['password']);
                $member->points = 5;
    
                $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
                $email_activation_code = array(); //remember to declare $pass as an array
                $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                for ($i = 0; $i < 8; $i++) {
                    $n = rand(0, $alphaLength);
                    $email_activation_code[] = $alphabet[$n];
                }
                $email_activation_code = implode("",$email_activation_code);
    
                $member->email_activation_code = $email_activation_code;
                $member->active_account= 0;
                $member->save();

                $member_records= new Member_records;
                $member_records->member_id = $member->id;
                $member_records->points = 5;
                $member_records->remark = '新會員加入';
                $member_records->save();

                //save to mailchimp

                $postData = array(
                    "email_address" => $member->email,
                    "status" => "subscribed",
                    "merge_fields" => array(
                    "FNAME"=> $member->full_name,
                    "PHONE"=> $member->whatsapp_number
                    )
                );

                $list_id = 'ea3e69d725';
                $authToken = 'f06c656ac3d0450d4fdf8e634d06100f-us18';
                
                // Setup cURL
                $ch = curl_init('https://us18.api.mailchimp.com/3.0/lists/'.$list_id.'/members/');

                curl_setopt_array($ch, array(
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_RETURNTRANSFER => TRUE,
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: apikey '.$authToken,
                        'Content-Type: application/json'
                    ),
                    CURLOPT_POSTFIELDS => json_encode($postData)
                ));
                // Send the request
                $response = curl_exec($ch);
                // print_r($response);
                // #######################################################################



    
                
                $data['error']='no_error';
                $data['email_activation_code']=$email_activation_code;
                

                $data['mail_content']="Hello ".$member->full_name."~<br/><br/>歡迎加入DJS FANS，<br/>請點擊以下連結進行驗証。<br/>".url('/sms-check?ec=').$email_activation_code;
                
                Mail::send('mail', $data, function($message) use ($request) {
                $message->to($request['email'], $request['full_name'])->subject('歡迎加入DJS FANS(新會員驗證)');
                $message->from('djweb914@gmail.com','djsfans of djsshopping');
                
                });

                return view('register',['data'=>$data]);

                

            }
            
            

    }

    public function login(Request $request)
    {
        
        if($request['submit'])
        {
            $email=$request['email'];
            $password=$request['password'];
          
            $m=Member::where('email',$email)->first();
            $db_pw=$m['password'];
            
            if(Hash::check($password, $db_pw))
            {
             if(Auth::attempt(['email' => $email, 'password' => $password]))
                {
                    return view('/login')->with('login_status','success'); 
                }
            }
            else
            {   
                return view('/login')->with('login_status','fail');
            }
  
          

        }
        else
        {
            return view('login');
        }
        
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    public function forgot_pw(Request $request)
    {
        if($request['submit'])
        {
            $email=$request['email'];
            $m=Member::where('email',$email)->first();
            if($m)
            {


                $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
                $password_reset_code = array(); //remember to declare $pass as an array
                $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                for ($i = 0; $i < 8; $i++) {
                    $n = rand(0, $alphaLength);
                    $password_reset_code[] = $alphabet[$n];
                }
                $password_reset_code = implode("",$password_reset_code);
    


                $m->update(['update_password_timestamp'=>now(),'password_reset_code'=>$password_reset_code]);
                
                $url = url('/').'/reset-pw?mid='.$m['member_code'].'&pw-rc='.$password_reset_code;
                $body ="Hello ~ 請按以下連結重新設定你的登入密碼。(10分鐘時效)<br/><br/>".$url."<br/><br/>有任何問題歡迎聯絡 wtsapp Joey 94444920.";
    
                $data['mail_content']=$body;
                Mail::send('mail', $data, function($message) use ($m) {

                $message->to($m['email'], $m['full_name'])->subject('重新設定 DJS FANS 密碼');
                $message->from('djweb914@gmail.com','djsfans of djsshopping <djsweb914@gmail.com>');
                });
                
                return view('/forgot-pw')->with('member',$m);           
            }
            else
            {
                return view('/forgot-pw')->with('member','not_exist');            

            }            
        }
        else
        {
            return view('/forgot-pw');            
        }
    

    }

    function reset_pw(Request $request)
    {

      if($request['submit'])
      {
        // echo $request['whatsapp_number'];
        // echo $request['member_code'];
        // echo $request['password_reset_code'];
          


            $m = Member::where('whatsapp_number',$request['whatsapp_number'])
                   ->where('member_code',$request['member_code'])
                   ->where('password_reset_code',$request['password_reset_code'])->first();
            if($m)
            {
                if($request['password']!=$request['password_again'])
                {
                    return view('/reset-pw')->with('member_code',$request['member_code'])->with('password_not_same',1);
                }
                
                $m->update(['password'=>Hash::make($request['password'])]);
                return view('/reset-pw')->with('member_code',$request['member_code'])->with('success',1)->with('return',1);
            }
            else
            {
                return view('/reset-pw')->with('member_code',$request['member_code'])->with('whatsapp_number_error',1);
            }
      }
      else
      {
        $member_code = $request['mid'];
        $password_reset_code = $request['pw-rc'];
        
        $m = Member::where('member_code',$member_code)->where('password_reset_code',$password_reset_code)->first();

        if($m)
        {
            $db_timestamp = $m['update_password_timestamp'];
            $now_timestamp =  now();
            
            if (strtotime($now_timestamp)-strtotime($db_timestamp)>=36000)
            {
                return view('/reset-pw')->with('member_code',$member_code)->with('expired',1)->with('return',1);
            }
            else
            {
                return view('/reset-pw')->with('member_code',$member_code);
            }

        }
        else
        {
            // return view('/reset-pw')->with('member_code',$member_code)->with('expired',1);
            return view('/reset-pw')->with('member_code',$member_code)->with('wrong_url',1)->with('return',1);
        }
      }
    }

    public function update_points(Request $request)
    {
        if($request['submit'])
        {
            $input_pw = $request['input_pw'];
            $member_code = $request['member_code'];

            $m=Member::where('member_code',$member_code)->first();
            if($m)
            {


                if($request['from_point'])
                {
                        // echo $member_code;
                        $member_records= new Member_records;
                        $member_records->member_id = $m->id;
                        $member_records->points = $request['to_point'];
                        $member_records->remark = $request['remark'];
                        $member_records->save();

                        $m->points=$request['to_point'];
                        $m->save();
                        return view('update-points')->with('pass',1)->with('member',$m)->with('update_msg','成功更新');
                }
                else
                {
                    if($input_pw=='20150517')
                    {
                                    // dd(3434);

                                    
                        return view('update-points')->with('pass',1)->with('member',$m);
                    } 
                    else
                    {
                        return view('update-points')->with('error','ADMIN密碼不正確');
                    }    
                }
                
           

            }
            // if($input_pw=='20150517')
                       
            // return view('update-points');

        }
        else
        {
            return view('update-points');

        }
    }

    public function scanner(Request $request)
    {
        // $member_code = $request['member_code'];
        $member_code = $request['i'];
        //  ?? $request['member_code'];
        //  echo $member_code;


        if($request['submit'])
        {
            $m=Member::where('member_code',$member_code)->first();
            if($m)
            {

                    if($request['scanner_pw'] =='20150517')
                    {
                        return view('update-points')->with('pass',1)->with('member',$m);
                    }
                    else
                    {
                        return view('scanner')->with('member_code',$member_code)->with('error','Wrong admin password');
                    }
                    
            }
            else
            {
                // echo 333;
                return redirect('/');
            }  

            
        }
        else
        {
            return view('scanner')->with('member_code',$member_code);

        }
      


    }

    public function show_history(Request $request)
    {

            $member_code = Auth::user()->member_code;
 
            $member = Member::where('member_code',$member_code)->with('member_records')->get()->first();
            $member_records = $member->member_records->sortByDesc('created_at')->values()->all();
        
            // dump($member_records[0]->created_at);
            // dd($member_records);
            return view('history')->with('member_records',$member_records);
   
   
    }

    

}