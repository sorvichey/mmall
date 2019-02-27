<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use App\Http\Controllers\Right;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
class ShopPromotionController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
           app()->setLocale(Session::get("lang"));
            return $next($request);
        });
    }
    // String to be generating 
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
    private function promotion_code($product_id) { 
        $token = $this->getToken(3, $product_id);
        $code = 'P'.$product_id. $token . substr(strftime("%Y", time()),2);
        return $code;
    }

    // view list of promotion
    public function index() {
        $shop_id = Session::get("shop")->id;
        $data['promotions']=DB::table('promotions')
            ->join('products','products.id','promotions.product_id')
            ->join('promotion_types','promotion_types.id','promotions.discount_type')
            ->select('products.*','promotions.*', 'promotion_types.name as promo_type', 'promotions.active as promo_active', 'promotions.id as promo_id')
            ->where('promotions.active', 1)
            ->where('products.shop_id',$shop_id)
            ->paginate(18);
        return view('fronts.shops.promotions.index',$data);
    }

    // load add form
    public function add($id)
    {
        $data['promotion_types'] = DB::table('promotion_types')
            ->where('active', 1)
            ->get();
        $data['product'] = DB::table('products')
            ->where('active', 1)
            ->where(DB::raw('md5(id)'),$id)
            ->first();

        return view('fronts.shops.promotions.create',$data);
    }
    // save promotion
    public function save(Request $r)
    {
        // validation form
        $validatedData = $r->validate([
            'promotion_type' => 'required',
            'discount' => 'required',
            'number_product' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'nullable',
        ]);
        // prepare data to insert
        date_default_timezone_set('Asia/Phnom_Penh');
         $data = array(
                'product_id' =>base64_decode( $r->Product_Name),
                'discount_code' =>$this->promotion_code(base64_decode( $r->Product_Name)),
                'discount_type' => $r->promotion_type,
                'discount' => $r->discount,
                'number_product' => $r->number_product,
                'start_date' => Carbon::createFromFormat('Y-m-d H:i:s', $r->start_date.date(' H:i:s')),
                'end_date' => Carbon::createFromFormat('Y-m-d H:i:s', $r->end_date.'00:00:00'),
                'description' => $r->description,
            );
        // insert data
        $i = DB::table('promotions')->insertGetId($data);
        // message 
        $sms = "Your promotion have been saved successfully";
        $sms1 = "Failed to add new promotion!";

        if ($i>0) {
            $r->session()->flash('sms', $sms);
            return redirect('/owner/product/promotion/'.md5(base64_decode( $r->Product_Name)));
        }else{
            $r->session()->flash('sms', $sms1);
            return redirect('/owner/product/promotion/'.md5(base64_decode( $r->Product_Name)));
        }

        
         
    }

    // edit promotion
    public function edit($id){
        $data['promotion'] = DB::table('promotions')
            ->join('products', 'products.id', 'promotions.product_id')
            ->where('promotions.active', 1)
            ->where(DB::raw('md5(promotions.id)'),$id)
            ->first();
        $data['promotion_types'] = DB::table('promotion_types')
            ->where('active', 1)
            ->get();

        return view('fronts.shops.promotions.edit',$data);
    }

    // update promotion
    public function update(Request $r){
        date_default_timezone_set('Asia/Phnom_Penh');
        // validation
         $validatedData = $r->validate([
            'promotion_type' => 'required',
            'discount' => 'required',
            'number_product' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'nullable',
        ]);

        // prepare data to insert
         $data = array(
                'discount_type' => $r->promotion_type,
                'discount' => $r->discount,
                'number_product' => $r->number_product,
                'start_date' => Carbon::createFromFormat('Y-m-d H:i:s', $r->start_date.date(' H:i:s')),
                'end_date' => Carbon::createFromFormat('Y-m-d H:i:s', $r->end_date.'00:00:00'),
                'description' => $r->description,
            );

         echo Carbon::createFromFormat('Y-m-d H:i:s', $r->start_date.date(' H:i:s'));
         echo "<br>";
         echo Carbon::createFromFormat('Y-m-d H:i:s', $r->end_date.date(' H:i:s'));
        // update
        $i = DB::table('promotions')->where(DB::raw('md5(promotions.id)'), $r->id)->update($data);

        $sms = "Your promotion have been changed successfully";
        $sms1 = "Failed to change promotion!";

        if ($i) {
            $r->session()->flash('sms', $sms);
            return redirect('/owner/product/promotion/');
        }else{
            $r->session()->flash('sms', $sms1);
            return redirect('/owner/product/promotion/edit/'.$r->id);
        }

    }

    // delete
    public function delete($id)
    {
        date_default_timezone_set('Asia/Phnom_Penh');
        // prepare data to insert
         $data = array(
                'active' => 0,
                'updated_at' => date('Y-m-d H:i:s'),
            );
       // update
        $i = DB::table('promotions')->where(DB::raw('md5(promotions.id)'), $id)->update($data);
        $sms = "Your promotion have been deleted successfully";
        session()->flash('sms', $sms);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/owner/product/promotion?page='.$page);
        }
        return redirect('/owner/product/promotion');
    }

}



