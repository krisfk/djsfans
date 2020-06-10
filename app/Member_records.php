<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Member_records extends Model
{
    use SoftDeletes;
    
        protected $table = 'member_records';
        public $primaryKey = 'id';
        
        protected $fillable = [
          'id',
          'member_id',
          'points',
          'remark'];


        public function member()
        {
            return $this->belongsTo(Member::class, 'member_id');
        }
        

 
}