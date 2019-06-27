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
class ShopPromotionController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
           app()->setLocale(Session::get("lang"));
            return $next($request);
        });

        // prepare data to insert
        date_default_timezone_set('Asia/Phnom_Penh');
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
        $token = $this->getToken(4, $product_id);
        $code = 'P'. $token . strtotime("now");
        return $code;
    }

    // view list of promotion
    public function index() {
        $shop_id = @Session::get("shop")->id;
        $data['promotions']=DB::table('promotions')
            ->join('products','products.id','promotions.product_id')
            ->join('promotion_types','promotion_types.id','promotions.discount_type')
            ->select('products.*','promotions.*', 'promotion_types.name as promo_type', 'promotions.active as promo_active', 'promotions.id as promo_id')
            ->where('products.shop_id',$shop_id)
            ->orderBY('promotions.id','DESC')
            ->paginate(18);
        return view('fronts.shops.promotions.index',$data);
    }

    // load add form
    public function add($id)
    {
        //decrypt id
        $encrypted_id = $id;
        $decrypted_id = base64_decode($encrypted_id);

        // check if promtion already exist
        $active_promotion = DB::table('promotions')->where('product_id', $decrypted_id)->where('active',1)->first();
        if($active_promotion!==null)
        {
            $data['promotion_exist']= array("1",Crypt::encryptString($active_promotion->id));
        }else{
            $data['promotion_exist']= array("0",);
        }

        $data['promotion_types'] = DB::table('promotion_types')
            ->where('active', 1)
            ->get();
        $data['product'] = DB::table('products')
            ->where('active', 1)
            ->where('id',$decrypted_id)
            ->first();

        return view('fronts.shops.promotions.create',$data);
    }
    // save promotion
    public function save(Request $r)
    {
        //decrypt id 
        $encrypted_id = $r->product_id;
        $decrypted_id = base64_decode($encrypted_id);

        // check if promtion already exist
        $active_promotion = DB::table('promotions')->where('product_id', $decrypted_id)->where('active',1)->first();
        if($active_promotion!==null)
        {
            $r->session()->flash('sms', "You could not create a new promotion!");
            return redirect('/owner/product/promotion/'.$encrypted_id);
        }
        // date formart
        $datetime = $r->datetimes;
        $date = explode(' - ', $datetime);
        $start_date = Carbon::createFromFormat('Y-m-d H:i', $date[0]);
        $end_date = Carbon::createFromFormat('Y-m-d H:i', $date[1]);

        // validation form
        $validatedData = $r->validate([
            'promotion_type' => 'required',
            'discount' => 'required',
            'number_product' => 'required',
            'datetimes' => 'required',
            'description' => 'nullable',
        ]);
        
        // data to be insert
         $data = array(
                'product_id' => $decrypted_id,
                'discount_code' =>$this->promotion_code($decrypted_id),
                'discount_type' => $r->promotion_type,
                'discount' => $r->discount,
                'number_product' => $r->number_product,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'description' => $r->description,
            );
        // query insert data
        $i = DB::table('promotions')->insertGetId($data);
        // message 
        $sms = "Your promotion have been saved successfully";
        $sms1 = "Failed to add new promotion!";

        if ($i>0) {
            $r->session()->flash('sms', $sms);
            return redirect('/owner/product/promotion/');
        }else{
            $r->session()->flash('sms', $sms1);
            return redirect('/owner/product/promotion/'.$encrypted_id);
        }
    }

    // edit promotion
    public function edit($id){
        $encrypted_id = $id;
        $decrypted_id = base64_decode($encrypted_id);

        $data['promotion'] = DB::table('promotions')
            ->join('products', 'products.id', 'promotions.product_id')
            ->where('promotions.active', 1)
            ->where('promotions.id',$decrypted_id)
            ->first();
        $data['promotion_types'] = DB::table('promotion_types')
            ->where('active', 1)
            ->get();

        return view('fronts.shops.promotions.edit',$data);
    }

    // update promotion
    public function update(Request $r){
        // date_default_timezone_set('Asia/Phnom_Penh');
        // validation
         $validatedData = $r->validate([
            'promotion_type' => 'required',
            'discount' => 'required',
            'number_product' => 'required',
            'datetimes' => 'required',
            'description' => 'nullable',
        ]);

        // date formart
        $datetime = $r->datetimes;
        $date = explode(' - ', $datetime);
        $start_date = Carbon::createFromFormat('Y-m-d H:i', $date[0]);
        $end_date = Carbon::createFromFormat('Y-m-d H:i', $date[1]);

        $encrypted_id = $r->id;
        $decrypted_id = base64_decode($encrypted_id);
        // prepare data to insert
         $data = array(
                'discount_type' => $r->promotion_type,
                'discount' => $r->discount,
                'number_product' => $r->number_product,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'description' => $r->description,
            );

        // update
        $i = DB::table('promotions')->where('promotions.id', $decrypted_id)->update($data);

        $sms = "Your promotion have been changed successfully";
        $sms1 = "Failed to change promotion!";

        if ($i) {
            $r->session()->flash('sms', $sms);
            return redirect('/owner/product/promotion/');
        }else{
            $r->session()->flash('sms', $sms1);
            return redirect('/owner/product/promotion/edit/'.$encrypted_id);
        }

    }

    // delete
    public function delete($id)
    {
        // date_default_timezone_set('Asia/Phnom_Penh');
        // prepare data to insert
        $encrypted_id = $id;
        $decrypted_id = base64_decode($encrypted_id);
         $data = array(
                'active' => 0,
                'updated_at' => date('Y-m-d H:i:s'),
            );
       // update
        $i = DB::table('promotions')->where('promotions.id', $decrypted_id)->update($data);
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



