<?php

namespace App\Http\Controllers\owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Auth;
use DB;
use Session;
use App\Http\Controllers\Right;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
class OwnerOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
           app()->setLocale(Session::get("lang"));
            return $next($request);
        });

        date_default_timezone_set('Asia/Phnom_Penh');
    }
    // view list of order
    public function index() {
        $shop_id = @Session::get("shop")->id;
        $data['orders']=DB::table('invoices')
        ->join('orders','orders.id','invoices.order_id')
        ->join('order_items','order_items.order_id','orders.id')
        ->join('products','products.id','order_items.product_id')
        ->join('order_status','order_status.id','orders.order_status_id')
        ->join('buyers','buyers.id','orders.buyer_id')
        ->join('shipping_address','buyers.id','shipping_address.buyer_id')
        ->join('payments','payments.order_id','orders.id')
        ->join('payment_types','payment_types.id','payments.payment_type_id')
        ->where('orders.active',1)
        ->where('products.shop_id', $shop_id)
        ->groupBy('orders.id')
        ->orderBy('orders.id', 'DESC')
        ->select(
          'orders.id',
          'buyers.first_name',
          'buyers.last_name',
          'products.name',
          'orders.order_code',
          'orders.created_at as order_date',
          'order_status.status_name as order_status',
          'payment_types.name as payment_type'
        )
        ->paginate(20);
        return view('fronts.shops.order.index', $data);
    }

    //order detail
    public function detail($id){
        $shop_id = @Session::get("shop")->id;
        //invoice head
        $data['invoice']=DB::table('invoices')
        ->join('orders','orders.id','invoices.order_id')
        ->join('buyers','buyers.id','orders.buyer_id')
        ->join('shipping_address','shipping_address.id','orders.shipping_address_id')
        ->join('order_items','order_items.order_id','orders.id')
        ->join('products','products.id','order_items.product_id')
        ->select(
            'buyers.first_name',
            'buyers.last_name',
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
        ->where('orders.id', base64_decode($id))
        ->where('products.shop_id', $shop_id)
        ->first();
        //buyer 
        // $buyer_id = Session::get('buyer')->id;
        // $data['buyer']=DB::table('buyers')->where("id",$buyer_id)->where('active',1)->first();

        //invoice body
        $data['order_items']=DB::table('orders')
        ->join('order_items','order_items.order_id','orders.id')
        ->join('products','products.id','order_items.product_id')
        ->where('orders.id',$id)
        ->where('products.shop_id',$shop_id)
        ->select(
        'products.name', 
        'order_items.price', 
        'order_items.quantity',
        'order_items.discount',
        'order_items.amount'
        )->get();
        return view('fronts.shops.order.detail', $data);
    }

    //edit order
    public function edit($id){
        $shop_id = @Session::get("shop")->id;
        //invoice head
        $data['invoice']=DB::table('invoices')
        ->join('orders','orders.id','invoices.order_id')
        ->join('buyers','buyers.id','orders.buyer_id')
        ->join('shipping_address','shipping_address.id','orders.shipping_address_id')
        ->join('order_items','order_items.order_id','orders.id')
        ->join('products','products.id','order_items.product_id')
        ->select(
            'orders.id as order_id',
            'orders.order_status_id',
            'orders.active',
            'buyers.first_name',
            'buyers.last_name',
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
        ->where('orders.id', base64_decode($id))
        ->where('products.shop_id', $shop_id)
        ->first();
       
        //invoice body
        $data['order_items']=DB::table('orders')
        ->join('order_items','order_items.order_id','orders.id')
        ->join('products','products.id','order_items.product_id')
        ->where('orders.id',$id)
        ->where('products.shop_id',$shop_id)
        ->select(
        'products.name', 
        'order_items.price', 
        'order_items.quantity',
        'order_items.discount',
        'order_items.amount'
        )->get();

        //order status
        $data['status']=DB::table('order_status')->where('active',1)->get();
        return view('fronts.shops.order.edit', $data);
    }

    //do update order
    public function update(Request $r){
        $data = array(
            'order_status_id'=>$r->order_status,
            'active'=>$r->status,
        );
        $i = DB::table('orders')->where('id',$r->id)->update($data);

        if($i){
            return redirect('/owner/product/order/edit/'.$r->id);
        }else{
            return redirect('/owner/product/order/edit/'.$r->id);
        }
    }
}



