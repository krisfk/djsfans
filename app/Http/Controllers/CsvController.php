<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Page;
use Illuminate\Support\Facades\Hash;


class CsvController extends Controller{

  public function index(){
    return view('csv');
  }

  public function uploadFile(Request $request){

    ini_set('max_execution_time', -1);

    if ($request->input('submit') != null ){

      $file = $request->file('file');

      // File Details 
      $filename = $file->getClientOriginalName();
      $extension = $file->getClientOriginalExtension();
      $tempPath = $file->getRealPath();
      $fileSize = $file->getSize();
      $mimeType = $file->getMimeType();

      // Valid File Extensions
      $valid_extension = array("csv");

      // 2MB in Bytes
      $maxFileSize = 2097152; 

      // Check file extension
      if(in_array(strtolower($extension),$valid_extension)){

        // Check file size
        if($fileSize <= $maxFileSize){

          // File upload location
          $location = 'uploads';

          // Upload file
          $file->move($location,$filename);

          // Import CSV to Database
          $filepath = public_path($location."/".$filename);

          // Reading file
          $file = fopen($filepath,"r");

          $importData_arr = array();
          $i = 0;

          while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
             $num = count($filedata );
             
             // Skip first row (Remove below comment if you want to skip the first row)
             /*if($i == 0){
                $i++;
                continue; 
             }*/
             for ($c=0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata [$c];
             }
             $i++;
          }
          fclose($file);

          // Insert to MySQL database
          foreach($importData_arr as $importData){

            // $insertData = array(
            //    "username"=>$importData[1],
            //    "name"=>$importData[2],
            //    "gender"=>$importData[3],
            //    "email"=>$importData[4]);
            // Page::insertData($insertData);

                $whatsapp_number = $importData[3];

                if (!$whatsapp_number) 
                {
                    $whatsapp_number=0;
                }

            $insertData = array(
               "member_code"=>$importData[0],
               "full_name"=>$importData[1],
               "region"=>$importData[2],
               "whatsapp_number"=>$whatsapp_number,
               "email"=>$importData[4],
               "password"=>Hash::make($importData[5]),
               "points"=>$importData[6],
               "email_activation_code"=>1,
               "sms_activation_code"=>1,
               "password_reset_code"=>1,
               "active_account"=>$importData[7]);
            Page::insertData($insertData);


          }

          Session::flash('message','Import Successful.');
        }else{
          Session::flash('message','File too large. File must be less than 2MB.');
        }

      }else{
         Session::flash('message','Invalid File Extension.');
      }

    }

    // Redirect to index
    return redirect()->action('CsvController@index');
  }
}