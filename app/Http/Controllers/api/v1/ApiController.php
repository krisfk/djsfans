<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;
use App\Member_records;

class ApiController extends Controller
{
    public function update_member_point(Request $request)
    {
        
    }
    
    public function get_info(Request $request)
    {
 
        return auth()->user();
    }

    public function update_pts(Request $request)
    {
        if($request)
        {
           $member = auth()->user();
           $points = $request['points'];
           $remark = $request['remark'];
           $member->points=$points;
           $member->save();
           $member->member_records()->create(["points" => $points,"remark"=>$remark]);
           return response()->json(['success' => 1],200);           
        }


    }
}