<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Intervention\Image\ImageManagerStatic as Image;

class ProductOrderController extends Controller
{
  public function __construct()
  {
      // $this->middleware('auth');
    date_default_timezone_set('Asia/Phnom_Penh');
  }


  public function index() {
    $data['subscriptions'] = DB::table('subscription')
      ->orderBy('id', 'desc')
      ->paginate(18);
    return view('fronts.shops.order.index', $data);
  }

  public function detail($id){
    // $data['subscription'] = DB::table('subscription')->where('id', $id)->first();
    //  return view('subscriptions.detail', $data);
  }

  public function create(Request $r){
    // validation form
    $validatedData = $r->validate([
      'quantity' => 'required'
    ]);
    $checkbox = $r->checkbox;
 
    if (is_null($checkbox)) {
      
    }else{
      $number_item = count($r->quantity);
      for($i=0; $i<$number_item; $i++){
        $order_number =    strtotime("now");
        // $quantity=$r->quantity[$i];
        // echo $number_item."<br>";
        // echo $r->quantity[$i].'--'.$r->checkbox[$i]."<br>";
        // exit();

        // check to update only checked box
        // if ($r->checkbox[$i]=="") {
          
          
        // }
        // else{
        //   $id = @$r->checkbox[$i]; 
        //   echo $quantity.'-'.$id;
        //   // exit();
        //   // $cart_quantity = array('pro_qty' => $quantity);
        //   // $update = DB::table('add_to_carts')->where(DB::raw('md5(add_to_carts.id)'), $id)->update($cart_quantity);
        //   // echo $quantity;
        //   // dd($update);
        // }
        
        

        // $data=DB::table('add_to_carts')
        //   ->join('products', 'products.id', 'add_to_carts.product_id')
        //   ->leftJoin('promotions',function ($join) {
        //       $join->on('promotions.product_id', '=' , 'products.id') ;
        //       $join->where('promotions.active','=',1);
        //     })      
        //   ->select('products.name','add_to_carts.product_id', 'add_to_carts.buyer_id')
        //   ->where(DB::raw('md5(add_to_carts.id)'), $r->checkbox[$i])->get();
        //   dd($data);
      }
    }
  }

  public function save(Request $r){
    $data = array(
        "name" => $r->name,
        "price" => $r->price,
        "posted_product" => $r->product_post,
        "duration" => $r->duration,
        "active" => $r->status,
        "description" => $r->description,
    );
    $i = DB::table('subscription')->insert($data);
    if($i)
    {
        $r->session()->flash("sms", "New subscription has been created successfully!");
        return redirect("/admin/subscription/create");
    }
    else{
        $r->session()->flash("sms1", "Fail to create new subscription!");
        return redirect("/admin/subscription/create")->withInput();
    }
  }

  public function edit($id){
    $data['subscription'] = DB::table('subscription')->where('id', $id)->first();
     return view('subscriptions.edit', $data);
  }

  public function update(Request $r){
    $data = array(
        "name" => $r->name,
        "price" => $r->price,
        "posted_product" => $r->product_post,
        "duration" => $r->duration,
        "active" => $r->status,
        "description" => $r->description,
    );

    $i = DB::table('subscription')->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/admin/subscription/edit/".$r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/admin/subscription/edit/".$r->id);
        }
  }
}
