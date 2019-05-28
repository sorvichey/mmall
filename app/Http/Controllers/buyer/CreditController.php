<?php

namespace App\Http\Controllers\buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use DB;
use Session;
use Auth;
class CreditController extends Controller
{
    // index
    public function index()
    {
        return view('fronts.buyers.carts.index');
    }
    // shipping info form
    public function create()
    {
        $buyer_id = Session::get("buyer")->id;
        return view('fronts.buyers.credits.create');
    }
    // save new shipping info
    public function save(Request $r){
        
        //buyer id
        $buyer_id = Session::get('buyer')->id;
        // validation
        $validatedData = $r->validate([
            'holder_name' => 'required',
            'card_number' => 'required',
            'expiry' => 'required',
            'cvv' => 'required'
        ]);
        
        $data = array(
            "buyer_id"=>$buyer_id,
            "holder_name"=>$r->holder_name,
            "card_number"=>$r->card_number,
            "expiry"=>$r->expiry,
            "cvv"=>$r->cvv
        );

        $res = DB::table('credit_cards')->insert($data);
        if($res){
            return redirect("/buyer/payment/create/");
        }
    }

    // edit credit info
    public function edit($id){
        //select credit card
        $data['credit'] = DB::table('credit_cards')->where('active',1)->where('id',$id)->first();
        return view('fronts.buyers.credits.edit', $data);
    }

    // do edit credit info
    public function update(Request $r){
        //buyer id
        $buyer_id = Session::get('buyer')->id;
        // validation
        $validatedData = $r->validate([
            'holder_name' => 'required',
            'card_number' => 'required',
            'expiry' => 'required',
            'cvv' => 'required'
        ]);
        $id = $r->id;
        
        $data = array(
            "buyer_id"=>$buyer_id,
            "holder_name"=>$r->holder_name,
            "card_number"=>$r->card_number,
            "expiry"=>$r->expiry,
            "cvv"=>$r->cvv
        );

        $res = DB::table('credit_cards')->where('id', $id)->update($data);
        // if($res){
            return redirect("/buyer/payment/create/");
        // }
    }
}
