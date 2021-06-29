<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use Eloquent; 


class Member 
extends Authenticatable
// extends Model
// extends Eloquent
{
  use Notifiable;
  use SoftDeletes;
  use HasApiTokens, Notifiable;
  
        protected $table = 'member';
        public $primaryKey = 'id';
        
        protected $fillable = [
          'id',
          'member_code',
          'full_name',
          'region',
          'whatsapp_number',
          'email',
          'password',
          'points',
          'email_activation_code',
          'sms_activation_code',
          'active_account',
          'update_password_timestamp',
          'password_reset_code'
        ];

        protected $hidden = [
            'password'
        ];

        public function member_records()
        {
          return $this->hasMany(Member_records::class, 'member_id');
        }



        
        
        
        // public function career(){
        //   return $this->belongsTo('App\Careers', 'career_id');
        // }


}