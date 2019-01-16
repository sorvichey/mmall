<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class WishController extends Controller
{
    // index
    public function index()
    {
        
        $data['wishes'] = DB::table('wishes')
            ->join('products', 'products.id', 'wishes.product_id')
            ->join('buyers', 'buyers.id', 'wishes.buyer_id')
            ->where('wishes.buyer_id', Session::get("buyer")->id)
            ->where('wishes.active',1)
            ->orderBy('wishes.create_at', 'desc')
            ->select('products.id as p_id', 'wishes.id as w_id', 'products.name', 'products.quantity', 'products.discount', 'products.price', 'products.featured_image', 'wishes.*')
            ->paginate(20);
        return view('fronts.buyer-wishlist', $data);
    }
  
    // save new social
    public function save(Request $r)
    {
        $data = array(
            'buyer_id' => $r->buyer_id,
            'product_id' => $r->product_id,
        );
        
        $wished = DB::table('wishes')
            ->where('buyer_id', $r->buyer_id)
            ->where('product_id', $r->product_id)
            ->count();

        if($wished <= 0 ) {
            $i = DB::table('wishes')->insertGetId($data);
            return $i;
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
     public function wishlist_count()
     {
        $buyer_id = Session::get("buyer")->id;
        $resutl = DB::table('wishes')->where('buyer_id', $buyer_id)->count();
        
        return response()->json($resutl);
     }
}
