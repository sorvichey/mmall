<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
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

  //order list for shop owner
  public function index() {
    //shop session id
    $shop_id = Session::get('shop')->id;
    $data['orders'] = DB::table('orders')
                      ->join('buyers','buyers.id','orders.buyer_id')
                      ->join('shops','shops.id','orders.shop_id')
                      ->join('order_status','order_status.id','orders.order_status_id')
                      ->select(
                        'orders.order_number',
                        'orders.created_at',
                        'orders.payment_status',
                        'order_status.status_name',
                        'buyers.first_name',
                        'buyers.last_name',
                        'buyers.phone',
                        'orders.delivery_address'
                      )
                      ->where('shops.id',$shop_id)
                      ->where('orders.active',1)
                      ->get();
    return view('fronts.shops.order.index', $data);
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
    //buyer id
    $buyer_id = Session::get('buyer')->id;
    //create order 
    $order = array(
      "order_number" =>$this->order_code($buyer_id),
      "buyer_id" =>$buyer_id
    );
    // insert
    $order_id = DB::table('orders')->insertGetId($order);
    //count item
    $items = count($r->cart);
    $total = 0;
    //separate value to insert
    for($i =0; $i<$items; $i++){
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
                    'promotions.id as promotion_id',
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
          "order_id" => $order_id,
          "product_id" => $to_order->product_id,
          "color_id" => $to_order->color_id,
          "size_id" => $to_order->size_id,
          "quantity" => $to_order->pro_qty,
          "promotion_id" => $to_order->promotion_id,
          "price" => $to_order->price,
          "amount" => $total
        );
        // insert
        DB::table('order_items')->insert($data);
        //Update Cart
        DB::table('add_to_carts')->where("id", $to_order->id)->update(array( "status" => 0));
    }
    // calculate the amount
    $amount = DB::table('order_items')->sum('order_items.amount');
    // update order amount
    $result = DB::table('orders')->where('orders.id',$order_id)->update(array('amount'=>$amount));
    if($result){
      return redirect("/product/order/payment");
    }else{
      echo 'error';
    }
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

  // buyer orders
  public function my_order($id){
    // Decrypt the cart id string
    $cart_id_encrypted = $id;
    $cart_id_decrypted = Crypt::decryptString($cart_id_encrypted);
    //buyer session id
    $buyer_id = Session::get('buyer')->id;
    //select all order
    $data['my_orders'] = DB::table('orders')
    ->join('order_items','order_items.order_id', 'orders.id')
    ->join('products', 'products.id', 'order_items.product_id')
    ->join('product_photos', 'product_photos.product_id', 'products.id')
    ->join('order_status', 'order_status.id','orders.order_status_id')
    ->where('orders.buyer_id',$buyer_id)
    ->select(
      'orders.created_at as order_date',
      'orders.payment_status',
      'orders.order_number',
      'order_items.amount',
      'order_items.price',
      'products.name',
      'product_photos.photo',
      'order_status.status_name',
      'order_items.quantity'
    )
    ->groupBy('order_items.id')
    ->get();

    return view('fronts.buyers.orders.index', $data);
  }
}

