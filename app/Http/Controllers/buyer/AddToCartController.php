<?php

namespace App\Http\Controllers\buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use DB;
use Session;
use Auth;
class AddToCartController extends Controller
{
    // index
    public function index()
    {
        $data['carts'] = DB::table('cart')
            ->join('products', 'products.id', 'cart.product_id')
            ->join('buyers', 'buyers.id', 'cart.buyer_id')
            ->leftJoin('product_photos', 'products.id', 'product_photos.product_id')
            ->leftJoin('product_sizes', 'product_sizes.id', 'cart.size_id')
            ->leftJoin('product_colors', 'product_colors.id', 'cart.color_id')
            ->leftJoin('promotions',function ($join) {
                $join->on('promotions.product_id', '=' , 'products.id') ;
                $join->where('promotions.active','=',1) ;
            })
            ->select("products.name", "product_photos.photo", "product_sizes.name as size", "product_colors.name as color", "products.price", 'promotions.discount', 'cart.id as cart_id', 'cart.pro_qty as pro_qty', DB::raw('products.price*cart.pro_qty AS total_sales'))
            ->where('cart.buyer_id', Session::get("buyer")->id)
            ->where('cart.active',1)
            ->where('cart.status',1)
            ->where('products.active',1)
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

        $exist_pro = DB::table('cart')->where(
            array(
                'product_id' => base64_decode($r->p_id),
                'buyer_id'=>$buyer_id,
                'status'=>1,
                'active'=>1
            )
        )->first();

        if(@$exist_pro->pro_qty >= 1){

            $add_qty = DB::table('cart')->where(
                array(
                    'product_id' => base64_decode($r->p_id) ,
                    'buyer_id'=>$buyer_id,
                    'status'=>1
                )
            )->update(['pro_qty' => @$exist_pro->pro_qty+$qty]);

            if($add_qty){
                 $count_cart = DB::table('cart')
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
                return redirect("/product/detail/".$r->p_id);
            }

        }else{

            $data = array(
                'buyer_id' => $buyer_id,
                'color_id' => $r->color,
                'size_id' => @$r->size,
                'product_id' => base64_decode($r->p_id),
                'pro_qty' => $qty,
            );

            $saved = DB::table('cart')->insertGetId($data);

            if($saved){
                $count_cart = DB::table('cart')
                ->where('buyer_id', $buyer_id)
                ->where('active', 1)
                ->where('status', 1)
                ->count();
                $updated = DB::table('wishes')->where(['product_id'=>base64_decode($r->p_id), 'buyer_id'=>$buyer_id])->update(['status'=>0]);
            }
            //cut stock
            $product_quantity = DB::table('products')->where('id',base64_decode($r->p_id))->first();
            $cut_stock = $product_quantity->quantity - $qty;
            DB::table('products')->where('id',base64_decode($r->p_id))->update(array('quantity'=>$cut_stock));

            if($r->ajax()){
                return $qty;
            }else{
                $r->session()->flash("sms", "Your item has been added to cart successfully!");
                return redirect("/product/detail/".$r->p_id);
            }
        }
        
    }

    //edit
    public function edit($id)
    {
        $encrypted_id = $id;
        $decrypted_id = Crypt::decryptString($encrypted_id);

        $data['cart'] = DB::table('cart')
                        ->join('products', 'products.id', 'cart.product_id')
                        ->join('buyers', 'buyers.id', 'cart.buyer_id')
                        ->leftJoin('product_photos', 'products.id', 'product_photos.product_id')
                        ->leftJoin('product_sizes', 'product_sizes.id', 'cart.size_id')
                        ->leftJoin('product_colors', 'product_colors.id', 'cart.color_id')
                        ->leftJoin('promotions',function ($join) {
                            $join->on('promotions.product_id', '=' , 'products.id') ;
                            $join->where('promotions.active','=',1) ;
                        })
                        ->select("products.id","products.name", "product_photos.photo", "product_sizes.name as size", "product_colors.name as color", "products.price", 'promotions.discount', 'cart.id as cart_id', 'cart.pro_qty as pro_qty', DB::raw('products.price*cart.pro_qty AS total_sales'))
                        ->where('cart.buyer_id', Session::get("buyer")->id)
                        ->where('cart.active',1)
                        ->where('cart.status',1)
                        ->where('products.active',1)
                        ->where('cart.id',$decrypted_id)
                        ->groupBy('products.id')
                        ->first();

        $proudct_id = $data['cart']->id;

        $data['colors'] = DB::table('product_colors')
                        ->where(['active'=>1, 'product_id'=>$proudct_id])
                        ->get();

        $data['sizes'] = DB::table('product_sizes')
                        ->where(['active'=>1, 'product_id'=>$proudct_id])
                        ->get();
        
        return view("fronts.buyers.carts.edit", $data);
    }

    //do update
    public function update(Request $r)
    {
        $decrypted_id = Crypt::decryptString($r->id);
        $mycart = DB::table('cart')->where('cart.id',$decrypted_id)->first();
        //check if add or sub
        if($r->action=="add"){
            $qty = $mycart->pro_qty + 1;
        }elseif($r->action=="sub"){
            if($mycart->pro_qty>0){
                $qty = $mycart->pro_qty - 1;
            }
        }else{
            $qty = 0;
        }

        $data = array(
            'pro_qty' => $qty
        );
        $i = DB::table('cart')->where(DB::raw('cart.id'),$decrypted_id)->update($data);
        if($i){
            echo $qty;
        }else{
            echo $mycart->pro_qty;
        }
    }
   
     // delete
     public function delete($id)
     {
        $decrypted_id = Crypt::decryptString($id);
        DB::table('cart')->where(DB::raw('cart.id'),$decrypted_id)->update(['active'=>0]);
        return redirect('/buyer/mycart');
     }



     // count wishlist by buyer
     public function cart_count()
     {
        $buyer_id = Session::get("buyer")->id;
        $resutl = DB::table('cart')
        ->join('products','products.id','cart.product_id')
        ->where('buyer_id', $buyer_id)
        ->where('products.active', 1)
        ->where('cart.active', 1)
        ->where('cart.status', 1)
        ->count();
        
        return response()->json($resutl);
     }
}
