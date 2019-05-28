<?php

namespace App\Http\Controllers\buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use DB;
use Session;
use Auth;
use App\Services\CodeRandom;
class PaymentController extends Controller
{
    function __construct() {
        $this->CodeRandom=new CodeRandom();
    }
    // index
    public function index()
    {
        //TODO
    }
    // shipping info form
    public function create()
    {
        $buyer_id = Session::get("buyer")->id;
        $data['payment_types'] = DB::table('payment_types')->where('active',1)->get();
        return view('fronts.buyers.payments.create', $data);
    }
    // save new shipping info
    public function save(Request $r){
        //save order
        $order = Session::get("order");
        //buyer id
        $buyer_id = Session::get('buyer')->id;
        // validation
        $validatedData = $r->validate([
            'payment_method' => 'required'
        ]);
        //last order id
        $order_last_row = DB::table('orders')->orderBy('id', 'DESC')->first();
        $order_last_id="";
        //check if null
        if($order_last_row===NULL){
            $order_last_id=1;
        }else{
            $order_last_id=$order_last_row->id+1;
        }
        //shipping address
        $shipping = DB::table('shipping_address')->where('active',1)->where('buyer_id',$buyer_id)->first();
        //call generate order code
        $code = $this->CodeRandom->code('ORD',$order_last_id);
        //data need to insert to table order
        $order_data=array(
            "order_code"=>$code,
            "buyer_id"=>$buyer_id,
            "shipping_address_id"=>$shipping->id,
        );
        //check payment type
        if($r->payment_method==1){
            //until aready paid, then create order 
            $inserted_order_id = DB::table('orders')->insertGetId($order_data);
            $count = count($order);
            $inv_amount=0;
            for($i=0; $i<$count; $i++){
                $cart_data = $order[$i];
                $cart_id = Crypt::decryptString($cart_data);
                $carts = DB::table('cart')
                ->select('promotions.id as promo_id', 'products.price','products.quantity','promotions.discount', 'cart.pro_qty', 'cart.size_id','cart.color_id','cart.product_id')
                ->join('products','products.id', 'cart.product_id')
                ->leftJoin('promotions',function ($join) {
                    $join->on('promotions.product_id', '=' , 'products.id') ;
                    $join->where('promotions.active','=',1) ;
                })
                ->where('cart.id',$cart_id)->first();
                //amount 
                $amount = $carts->pro_qty*$carts->price;
                $total_amount=number_format($amount - ($amount / 100 * $carts->discount),2 );
                $inv_amount +=$total_amount;
                //create order items
                $order_item = array( 
                    "order_id" =>$inserted_order_id,
                    "product_id" =>$carts->product_id,
                    "promotion_id" =>$carts->promo_id,
                    "color_id" =>$carts->color_id,
                    "size_id" =>$carts->size_id,
                    "price" =>$carts->price,
                    "quantity" =>$carts->pro_qty,
                    "discount" =>$carts->discount,
                    "amount" =>$total_amount
                );

                $inserted_item_id = DB::table('order_items')->insertGetId($order_item);

                //payment
                $data = array(
                    "order_id"=>$inserted_order_id,
                    "payment_type_id"=>$r->payment_method,
                );
                DB::table('payments')->insert($data);

                //clear cart
                DB::table('cart')->where('id',$cart_id)->update(array('active'=>0));

                //TODO:  stock ...

            }
            //create invoic
            //last order id
            $inv_last_row = DB::table('orders')->orderBy('id', 'DESC')->first();
            $inv_last_id="";
            //check if null
            if($inv_last_row===NULL){
                $inv_last_id=1;
            }else{
                $inv_last_id=$inv_last_row->id+1;
            }
            $invoice = array(
                "order_id"=>$inserted_order_id,
                "invoice_code"=>$this->CodeRandom->code('INV',$inv_last_id),
                "total_amount"=>$inv_amount
            );
            DB::table('invoices')->insert($invoice);
            
            return redirect("/buyer/order/success/".$inserted_order_id);
        }else{
            //select card info
            $card = DB::table('credit_cards')->where('active',1)->where('buyer_id',$buyer_id)->first();
            //check card info exist or not
            if (empty($card)) { 
                return redirect("/buyer/credit-card/create");
            }else{
                return redirect("/buyer/credit-card/edit/".$card->id);
            }
        }
    }

    // // edit credit info
    // public function edit($id){
    //     //select credit card
    //     $data['credit'] = DB::table('credit_cards')->where('active',1)->where('id',$id)->first();
    //     return view('fronts.buyers.credits.edit', $data);
    // }

    // // do edit credit info
    // public function update(Request $r){
    //     //buyer id
    //     $buyer_id = Session::get('buyer')->id;
    //     // validation
    //     $validatedData = $r->validate([
    //         'holder_name' => 'required',
    //         'card_number' => 'required',
    //         'expiry' => 'required',
    //         'cvv' => 'required'
    //     ]);
    //     $id = $r->id;
        
    //     $data = array(
    //         "buyer_id"=>$buyer_id,
    //         "holder_name"=>$r->holder_name,
    //         "card_number"=>$r->card_number,
    //         "expiry"=>$r->expiry,
    //         "cvv"=>$r->cvv
    //     );

    //     $res = DB::table('credit_cards')->where('id', $id)->update($data);
    //     if($res){
    //         return redirect("/buyer/payment/create/");
    //     }
    // }
}
