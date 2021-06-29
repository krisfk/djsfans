<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use App\Mailer;


class PHPmailerController extends Controller
{
    public function send(Request $request)
    {
        
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->CharSet = 'utf-8';
            $mail->SMTPAuth =true;
            $mail->SMTPSecure = env('MAIL_ENCRYPTION');
            $mail->Host = 'smtp.gmail.com'; //gmail has host > smtp.gmail.com
            $mail->Port = 587; //gmail has port > 587 . without double quotes
            $mail->Username = 'djsweb914@gmail.com'; //your username. actually your email
            $mail->Password = 'Kk9148600'; // your password. your mail password
            $mail->setFrom($request['from_email'], $request['from_name']);
            $mail->Subject = $request['mail_title'];
            $mail->MsgHTML($request['body']);
            $mail->addAddress($request['to_email'],$request['to_name'] );
            $mail->send();
        } catch (Exception $e) {
            dd($e);
        }
        return  $mail ? 1 :0;
       
        

    }

    public function send2(Request $request)
    {
        echo 123;
    }

    public function testing(Request $request)
    {
        return 999;
    }

    public function get_token()
    {
        return csrf_token(); 
    }


    
}