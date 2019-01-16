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
            ->join('products', 'products.id', 'add_to_carts.pro_id')
            ->join('buyers', 'buyers.id', 'wishes.buyer_id')
            ->where('add_to_carts.buyer_id', Session::get("buyer")->id)
            ->where('add_to_carts.active',1)
            ->paginate(20);
        return view('fronts.buyers.carts.index', $data);
    }
  
    // save new to cart
    public function save(Request $r)
    {

        $buyer_id = Session::get("buyer")->id;
        $price = DB::table('products')->where('id', base64_decode($r->p_id))->select('products.price')->first();
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
            // if($updated){
            //      return $count_cart;
            // }
        }
        // else{
        //     return "error";
        // }
         return $count_cart;
       
        
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
     public function wishlist_count()
     {
        $buyer_id = Session::get("buyer")->id;
        $resutl = DB::table('wishes')->where('buyer_id', $buyer_id)->count();
        
        return response()->json($resutl);
     }
}
