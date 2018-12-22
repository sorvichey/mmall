<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class FrontTrackingController extends Controller
{
    public function tracking(Request $r) {
        $data['query']= "";
        if(isset($_GET['q']))
        {
                $data['query'] = $_GET['q'];
                $data['tracking'] = DB::table('tracking')
                ->where('active', 1)
                    ->where(function($fn){
                        $fn->where('tracking.waybill', '=', $_GET['q']);
                    })
                    ->first();
                    if( $data['tracking'] == null) {
                    $r->session()->flash('sms1', 'Fail to tracking. Please check your waybill again!');
                }
            
        }  else {
            $data['tracking'] = null;
        }

        return view('fronts.tracking', $data);
    }
  
}
