<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Crypt;

class ProductOrderController extends Controller
{
  public function __construct()
  {
      // $this->middleware('auth');
    date_default_timezone_set('Asia/Phnom_Penh');
  }

  private function getToken($length, $seed){    
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "0123456789";

    mt_srand($seed);      // Call once. Good since $product_id is unique.

    for($i=0;$i<$length;$i++){
        $token .= $codeAlphabet[mt_rand(0,strlen($codeAlphabet)-1)];
    }
    return $token;
  }
  // Random string 
  private function order_code($id) { 
      $token = $this->getToken(6, $id);
      $code = 'PO'. $token . strtotime("now");
      return $code;
  }

  public function index() {
    $buyers = DB::table('buyers')->where('activated', 1)->orderBy('id', 'DESC')->get();    
    return view('fronts.shops.order.index', compact('buyers'));
  }

  public function detail($id){
    // $data['subscription'] = DB::table('subscription')->where('id', $id)->first();
    //  return view('subscriptions.detail', $data);
  }

  public function create(Request $r){
    // validation form
    $validatedData = $r->validate([
      'cart' => 'required'
    ]);
    
    // count item to be insert multiple 
    $items = count($r->cart);
    $total = 0;
    $this->order_code();
    for($i=0; $i< $items; $i++){
      // Decrypt the cart id string
      $cart_id_encrypted = $r->cart[$i];
      $cart_id_decrypted = Crypt::decryptString($cart_id_encrypted);

      // get product form cart to be order
      $to_order = DB::table('add_to_carts')
            ->join('products', 'products.id', 'add_to_carts.product_id')
            ->leftJoin('promotions',function ($join) {
              $join->on('promotions.product_id', '=' , 'products.id') ;
              $join->where('promotions.active','=',1) ;
            })
            ->select('add_to_carts.id',
                    'add_to_carts.buyer_id', 
                    'add_to_carts.product_id', 
                    'add_to_carts.color_id', 
                    'add_to_carts.size_id', 
                    'add_to_carts.pro_qty',
                    'promotions.discount',
                    'products.price',
                    DB::raw('products.price*add_to_carts.pro_qty AS total_sales'))
            ->where('add_to_carts.id', $cart_id_decrypted)
            ->where('add_to_carts.active', 1)
            ->first();

        // check product is discouted or not
        if($to_order->discount > 0){
          $total += number_format($to_order->total_sales - ($to_order->total_sales / 100 * $to_order->discount),2 );
        }else{
          $total +=  number_format($to_order->total_sales , 2);
        }

        // prepared data to be insert
        $data = array(
          "order_number" => $order_code,
          "buyer_id" => $to_order->buyer_id,
          "pro_id" => $to_order->product_id,
          "color_id" => $to_order->color_id,
          "size_id" => $to_order->size_id,
          "pro_qty" => $to_order->pro_qty,
          "pro_discount" => $to_order->discount,
          "order_date" => date('Y-m-d H:i:s'),
          "total" => $total
        );

        // insert
        DB::table('orders')->insert($data);
        //Update Cart
        DB::table('add_to_carts')->where("id", $to_order->id)->update(array( "status" => 0));
    }
    return redirect("/product/order/payment");
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
