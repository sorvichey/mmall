<?php

namespace App\Http\Controllers\buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use DB;
use Session;
use Auth;
class ShippingController extends Controller
{
    // index
    public function index()
    {
        
        return view('fronts.buyers.carts.index', $data);
    }
    // shipping info form
    public function create()
    {

        $buyer_id = Session::get("buyer")->id;

        return view('fronts.buyers.shipping.create');
        
    }
    // save new shipping info
    public function save(Request $r){
        //buyer id
        $buyer_id = Session::get('buyer')->id;
        // validation
        $validatedData = $r->validate([
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'contry' => 'required',
            'postcode' => 'required|numeric',
            'phone' => 'required|numeric'
        ]);

        $data = array(
            "buyer_id"=>Session::get('buyer')->id,
            "address"=>$r->address,
            "city"=>$r->city,
            "state"=>$r->state,
            "contry"=>$r->contry,
            "postcode"=>$r->postcode,
            "phone"=>$r->phone
        );

        $res = DB::table('shipping_address')->insert($data);
        if($res){
            return redirect("/buyer/payment/edit/");
        }
    }

    // edit shipping info
    public function edit($id){
        var_dump($_SESSION[]);
        //select shipping address
        $data['shipping'] = DB::table('shipping_address')->where('active',1)->where('id',$id)->first();
        // return view('fronts.buyers.shipping.edit', $data);
    }

    // do edit shipping info
    public function update(Request $r){
        //buyer id
        $buyer_id = Session::get('buyer')->id;
        // validation
        $validatedData = $r->validate([
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'contry' => 'required',
            'postcode' => 'required|numeric',
            'phone' => 'required|numeric'
        ]);
        $id = $r->id;

        $data = array(
            "buyer_id"=>Session::get('buyer')->id,
            "address"=>$r->address,
            "city"=>$r->city,
            "state"=>$r->state,
            "contry"=>$r->contry,
            "postcode"=>$r->postcode,
            "phone"=>$r->phone
        );

        $res = DB::table('shipping_address')->where('id', $id)->update($data);
        // if($res){
            return redirect("/buyer/payment/create");
           
        // }
    }
}
