<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Page extends Model {

   public static function insertData($data){

      $value=DB::table('member')->where('member_code', $data['member_code'])->get();
      if($value->count() == 0){
         DB::table('member')->insert($data);
      }
   }

}