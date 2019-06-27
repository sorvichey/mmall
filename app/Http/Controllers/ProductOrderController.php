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
  // //order list for shop owner
  // public function index() {
  //   //shop session id
  //   $shop_id = Session::get('shop')->id;
  //   $data['orders'] = DB::table('orders')
  //                     ->join('buyers','buyers.id','orders.buyer_id')
  //                     ->join('shops','shops.id','orders.shop_id')
  //                     ->join('order_status','order_status.id','orders.order_status_id')
  //                     ->select(
  //                       'orders.order_number',
  //                       'orders.created_at',
  //                       'orders.payment_status',
  //                       'order_status.status_name',
  //                       'buyers.first_name',
  //                       'buyers.last_name',
  //                       'buyers.phone',
  //                       'orders.delivery_address'
  //                     )
  //                     ->where('shops.id',$shop_id)
  //                     ->where('orders.active',1)
  //                     ->get();
  //   return view('fronts.shops.order.index', $data);
  // }

  public function detail($id){
    // $data['subscription'] = DB::table('subscription')->where('id', $id)->first();
    //  return view('subscriptions.detail', $data);
  }

  public function create(Request $r){
    
    // validation form
    $validatedData = $r->validate([
      'selected_item' => 'required'
    ]);

    $item = $r->selected_item;
    //put order data into the session
    session()->put('order', $item);
    //buyer id
    $buyer_id = Session::get('buyer')->id;
    //select shipping adress
    $shipping_address = DB::table('shipping_address')->where('active',1)->where('buyer_id', $buyer_id)->first();
    if (empty($shipping_address)) { 
      return redirect("/buyer/shipping-info/create");
    }else{
      return redirect("/buyer/shipping-info/edit/".base64_encode($shipping_address->id));
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
  public function my_order(){
    //buyer session id
    $buyer_id = Session::get('buyer')->id;

        //product ordered
        $data['orders']=DB::table('invoices')
        ->join('orders','orders.id','invoices.order_id')
        ->join('order_items','order_items.order_id','orders.id')
        ->join('products','products.id','order_items.product_id')
        ->join('order_status','order_status.id','orders.order_status_id')
        ->leftJoin('product_sizes', 'product_sizes.product_id', 'products.id')
        ->leftJoin('product_colors', 'product_colors.product_id', 'products.id')
        ->where('orders.active',1)
        ->where('orders.buyer_id', $buyer_id)
        ->orderBy('orders.id')
        ->select(
          'products.name',
          'product_sizes.name as size',
          'product_colors.photo as color',
          'orders.order_code',
          'order_items.quantity',
          'order_items.price',
          'order_items.discount',
          'order_items.amount',
          'order_status.status_name as order_status'
        )
        ->get();
    return view('fronts.buyers.orders.index', $data);
  }
  //when order success
  public function success($id){
    //invoice head
    $data['invoice']=DB::table('invoices')
    ->join('orders','orders.id','invoices.order_id')
    ->join('shipping_address','shipping_address.id','orders.shipping_address_id')
    ->select(
      'orders.order_code',
      'invoices.invoice_code',
      'orders.created_at',
      'invoices.total_amount',
      'shipping_address.address',
      'shipping_address.city',
      'shipping_address.state',
      'shipping_address.contry',
      'shipping_address.postcode',
      'shipping_address.phone'
    )
    ->where('orders.id', $id)->first();
    //buyer 
    $buyer_id = Session::get('buyer')->id;
    $data['buyer']=DB::table('buyers')->where("id",$buyer_id)->where('active',1)->first();

    //invoice body
    $data['order_items']=DB::table('orders')
    ->join('order_items','order_items.order_id','orders.id')
    ->join('products','products.id','order_items.product_id')
    ->where('orders.id',$id)
    ->select(
      'products.name', 
      'order_items.price', 
      'order_items.quantity',
      'order_items.discount',
      'order_items.amount'
    )->get();
    return view('fronts.buyers.orders.success',$data);
  }
}

