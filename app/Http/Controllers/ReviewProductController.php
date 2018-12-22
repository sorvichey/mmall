<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Intervention\Image\ImageManagerStatic as Image;

class ReviewProductController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function save(Request $r)
    {
        
        if($r->buyer_id!="" || $r->buyer_id !=NULL){
            $data = [
                'rate' => $r->rate_number,
                'description' => $r->comment,
                'product_id' => $r->pro_id,
                'buyer_id' => $r->buyer_id
               
            ];
            $rate = DB::table('review_products')
                ->where('buyer_id', $r->buyer_id)
                ->where('product_id', $r->pro_id)
                ->count();

            if($rate <= 0 ) {
                $i = DB::table('review_products')->insert($data);
            }else{
                $r->session()->flash('sms1', "You've already reated!");
                return redirect('/product/detail/'.$r->pro_id);
            }
            
            if($i)
            {
               
                $r->session()->flash('sms', 'Thank you for rating us.');
                return redirect('/product/detail/'.$r->pro_id);
            }
            else{
                $r->session()->flash('sms1', 'Fail to rate product. Please check your input again!');
                return redirect('/product/detail/'.$r->pro_id);
            }
        }else{
            $r->session()->flash('sms1', 'Fail to rate product. Please login first!');
            return redirect('/product/detail/'.$r->pro_id);
        }
    }

}
