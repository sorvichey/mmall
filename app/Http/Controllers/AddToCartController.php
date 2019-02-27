<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class AddToCartController extends Controller
{
    // index
    public function index()
    {
        $data['carts'] = DB::table('add_to_carts')
            ->join('products', 'products.id', 'add_to_carts.product_id')
            ->join('buyers', 'buyers.id', 'add_to_carts.buyer_id')
            ->leftJoin('product_photos', 'products.id', 'product_photos.product_id')
            ->leftJoin('promotions',function ($join) {
                $join->on('promotions.product_id', '=' , 'products.id') ;
                $join->where('promotions.active','=',0) ;
            })
            ->select("products.name", "product_photos.photo", "products.price", 'promotions.discount', 'add_to_carts.pro_qty as pro_qty', DB::raw('products.price*add_to_carts.pro_qty AS total_sales'))
            ->where('add_to_carts.buyer_id', Session::get("buyer")->id)
            ->where('add_to_carts.active',1)
            ->where('add_to_carts.status',1)
            ->groupBy('products.id')
            ->paginate(20);
        return view('fronts.buyers.carts.index', $data);
    }
  
    // save new to cart
    public function save(Request $r)
    {

        $buyer_id = Session::get("buyer")->id;
        $qty = "";

        if($r->ajax()){
            $qty = 1;
        }else{
            
            $qty = $r->quantity;
        }

        $price = DB::table('products')->where('id', base64_decode($r->p_id))->select('products.price')->first();

        $exist_pro = DB::table('add_to_carts')->where(
            array(
                'product_id' => base64_decode($r->p_id),
                'buyer_id'=>$buyer_id,
                'status'=>1
            )
        )->first();

        if(@$exist_pro->pro_qty >= 1){

            $add_qty = DB::table('add_to_carts')->where(
                array(
                    'product_id' => base64_decode($r->p_id) ,
                    'buyer_id'=>$buyer_id,
                    'status'=>1
                )
            )->update(['pro_qty' => @$exist_pro->pro_qty+$qty]);

            if($add_qty){
                 $count_cart = DB::table('add_to_carts')
                ->where('buyer_id', $buyer_id)
                ->where('active', 1)
                ->where('status', 1)
                ->count();
                $updated = DB::table('wishes')->where(['product_id'=>base64_decode($r->p_id), 'buyer_id'=>$buyer_id])->update(['status'=>0]);
            }

            if($r->ajax()){
                return $count_cart;
            }else{
                $r->session()->flash("sms", "Your item has been added to cart successfully!");
                return redirect("/product/detail/".base64_decode($r->p_id));
            }

        }else{

            $data = array(
                'buyer_id' => $buyer_id,
                'product_id' => base64_decode($r->p_id),
                'pro_qty' => 1,
                'total_price' => $price->price,
                'net_total_price' =>  $price->price,
            );

            $saved = DB::table('add_to_carts')->insertGetId($data);

            if($saved){
                $count_cart = DB::table('add_to_carts')
                ->where('buyer_id', $buyer_id)
                ->where('active', 1)
                ->where('status', 1)
                ->count();
                $updated = DB::table('wishes')->where(['product_id'=>base64_decode($r->p_id), 'buyer_id'=>$buyer_id])->update(['status'=>0]);
            }

            if($r->ajax()){
                return $qty;
            }else{
                $r->session()->flash("sms", "Your item has been added to cart successfully!");
                return redirect("/product/detail/".base64_decode($r->p_id));
            }
        }
        
    }

   
     // delete
     public function delete($id)
     {
        DB::table('wishes')->where('id', $id)->update(['active'=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/buyer/wishlist?page='.$page);
        }

        return redirect('/buyer/wishlist');
     }

     // count wishlist by buyer
     public function cart_count()
     {
        $buyer_id = Session::get("buyer")->id;
        $resutl = DB::table('add_to_carts')->where('buyer_id', $buyer_id)->count();
        
        return response()->json($resutl);
     }
}
