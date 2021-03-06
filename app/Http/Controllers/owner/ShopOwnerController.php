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
class ShopOwnerController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
           app()->setLocale(Session::get("lang"));
            return $next($request);
        });
    }
    // index
    public function login()
    {
        
        return view("fronts.shops.shop-owner-login");
    }

    public function shop_owner_sign_up(Request $r) {
        // check the email if it is valid or not
        if (!filter_var($r->email, FILTER_VALIDATE_EMAIL)) {
        
            $r->session()->flash('sms1', "Your email is invalid. Check it again!");
            return redirect('/owner/login')->withInput();
        }
        $email = DB::table('shop_owners')
            ->where('email', $r->email)
            ->where('active', 1)
            ->count();
        
        if($email === 0 && $r->password === $r->cpassword) {
            $data = array(
                'first_name' => $r->first_name,
                'last_name' => $r->last_name,
                'gender' => $r->gender,
                'phone' => $r->phone,
                'email' => $r->email,
                'password' => password_hash($r->password, PASSWORD_BCRYPT)
            );
           
            $sms = "You have registered successfully. Please Login!";
            $sms1 = "Cannot register your account. Please check your inputs again!";
            $i = DB::table('shop_owners')->insertGetId($data);

            $owner_email = $r->email;
            // check if email exist

            $id = md5($i);
            $success = Right::send_email_shop_owner_activated($owner_email, $id);

            if ($success)
            {
                $r->session()->flash('sms', $sms);
                return redirect('/owner/login');
            }
            else
            {
                $r->session()->flash('sms1', $sms1);
                return redirect('/owner/login')->withInput();
            }
        } else {
            if ($email > 0) {
                if ($r->session()->get('lang')=='en') {
                    $sms1 = "Your email already exist. Please use a different one!";
                 } else {
                    $r->session()->flash('sms1', "អីុម៉ែលមួយនេះមានរួចមកហើយ, សូមព្យាយាមប្រើអីុម៉ែលខុសពីនេះម្តងទៀត!");
                }
            } 
            if($r->password != $r->cpassword) {
                if ($r->session()->get('lang')=='en') {
                $sms1 = "Your Confirm Password Incorrect. Please  try again!";
                } else {
                    $sms1 = "ពាក្យសម្ងាត់របស់អ្នកមិនត្រឹមត្រូវសូមព្យាយាមម្តងទៀត!";
                }
            }
            return redirect('/owner/login')->withInput();
        } 
    }


   

    public function do_login(Request $r)
    {
        $email = $r->email;
        $pass = $r->password;
        $shop_owner = DB::table('shop_owners')->where('active',1)->where('email', $email)->first();
        if ($shop_owner === null) {
            $r->session()->flash('sms2', 'Invalide email address!');
            return redirect('/owner/login')->withInput();
        }
        $shop = DB::table('shops')->where('shop_owner_id', $shop_owner->id)->first();

        $shop_owner_activated = 
            DB::table('shop_owners')
            ->where('active',1)
            ->where('activated', 1)
            ->where('email', $email)
            ->count();
           
        if($shop_owner != null)
        {
            if($shop_owner_activated > 0) {
                if(password_verify($pass, $shop_owner->password))
                {
                    // save user to session
                    $r->session()->put('shop_owner', $shop_owner);
                    $r->session()->put('shop', $shop);
                    return redirect('/owner/home');
                }
                else{
                    if ($r->session()->get('lang')=='en') {
                        $r->session()->flash('sms2', "Invalid email or password. Try again!");
                    } else {
                        $r->session()->flash('sms2', "ឈ្មេាះឬលេខសម្ងាត់មិនត្រឹមត្រូវទេ។ សូមព្យាយាមម្តងទៀត!");
                    }
                    
                    return redirect('/owner/login')->withInput();
                }
            } else {
                if ($r->session()->get('lang')=='en') {
                    $r->session()->flash('sms2', "Please activate in account from your email");
                } else {
                    $r->session()->flash('sms2', "សូមចូលទៅក្នុងគណនីអីុម៉ែលរបស់អ្នកដើម្បីដំណើរការគណនី");
                }
                
                return redirect('/owner/login')->withInput();
            }
        }
        else{
            if ($r->session()->get('lang')=='en') {
                $r->session()->flash('sms2', "Invalid email or password!");
            } else {
                $r->session()->flash('sms2', "អីុម៉ែលឬលេខសម្ងាត់មិនត្រឹមត្រូវទេ!");
            }
            
            return redirect('/owner/login')->withInput();
        }
    }

    public function shop_owner_account_recovery() {
        return view("fronts.shop-owner-account-recovery");
    }

    // admin shop owner in front end
    public function home() {
        return view("fronts.shops.home");
    }

    public function edit($id) {
        $data['owner'] = DB::table('shop_owners')->where('id', $id)->first();
        return view("fronts.shops.edit", $data);
    }

    public function update(Request $r) {
        $data = array(
            'first_name' => $r->first_name,
            'last_name' => $r->last_name,
            'gender' => $r->gender,
            'phone' => $r->phone,
            'email' => $r->email,
            'address' => $r->email,
        );
        if($r->hasFile('photo'))
        {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'pro' .$r->id . $ss;

            $destinationPath2 = 'uploads/owner_profiles/';
            $new_img2 = Image::make($file->getRealPath())->resize(500, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img2->save($destinationPath2 . $file_name, 80);
            $data['photo'] = $file_name;

        }
        $i = DB::table('shop_owners')->where('id', $r->id)->update($data);
        if($i)
        {
            $r->session()->flash('sms', 'All changes have been saved!');
            return redirect('/owner/home/');
        }
        else{
            $r->session()->flash('sms1', 'Fail to save changes!');
            return redirect('/owner/home');
        }
    }

    public function my_shop() {
        $owner_id = @Session::get("shop_owner")->id;
        $owner_id;

        $data['my_shop'] = DB::table('shops')->where('shop_owner_id', $owner_id)->count();
       
        if($data['my_shop']==1){
            $shop_id = DB::table('shops')->where('shop_owner_id', $owner_id)->first();
            // echo $shop_id->id;
            // exit();
            // $data['shop_active'] = $shop_id->active;
            // $data['shop_info'] = DB::table('shops')
            //     ->join('product_categories', 'product_categories.id', 'shops.shop_category')
            //     ->join('subscription','subscription.id', 'shops.subscription_id')
            //     ->select('shops.*', 'shops.id as id', 'product_categories.name as shop_category_name', 'product_categories.id as shop_category_id', 'subscription.name as current_subscribe')
            //     ->first();
            // $data['pedding_sub']=DB::table('shop_subscriptions')
            // ->join('subscription', 'subscription.id', 'shop_subscriptions.subscription_id')
            // ->select('subscription.name as sub_name')
            // ->where('shop_id', $shop_id->id)
            // ->where('status', 0)
            // ->first();
            //get shop info
            $data['shop']=DB::table('shops')
                ->join('product_categories', 'product_categories.id', 'shops.shop_category')
                ->join('subscription','subscription.id', 'shops.subscription_id')
                ->select('shops.*', 'shops.id as id', 'product_categories.name as shop_category_name', 'product_categories.id as shop_category_id', 'subscription.name as current_subscribe')
                ->where('shops.shop_owner_id',$owner_id)
                ->first();
            //get pending subscription
            $data['pending_subscription']=DB::table('shop_subscriptions')
                ->join('subscription', 'subscription.id', 'shop_subscriptions.subscription_id')
                ->select('subscription.name as sub_name')
                ->where('shop_id', $shop_id->id)
                ->where('status', 0)
                ->first();
        }
        return view("fronts.shops.my-shop", $data);
    }

    public function create_shop(Request $r) {
        return view("fronts.shops.create-shop");
    }

    public function do_create_shop(Request $r) {
        $owner_id = Session::get("shop_owner")->id;
        $owner_id;
        $find_shop = DB::table('shops')->where('name', $r->shop_name)->count();
        $shop = DB::table('shops')->orderBy('id', 'DESC')->first();
         if($shop==null){
            $last_id = 1;
        }else{
            $last_id = $shop->id+1;
        }
         $data = array(
            'name' => $r->shop_name,
            'shop_category' => $r->shop_category,
            'address' => $r->shop_address,
            'phone' => $r->shop_phone,
            'email' => $r->shop_email,
            'website' => $r->shop_website,
            'description' => $r->shop_description,
            'location' => $r->shop_location,
            'shop_owner_id' => $owner_id,
        );

        if($find_shop>0){
             $r->session()->flash('sms1', 'Shop name ['.$r->shop_name.'] is already exist!');
            return redirect('/owner/my-shop');
        }else{

            if($r->hasFile('logo'))
            {
                $file = $r->file('logo');
                $file_name = $file->getClientOriginalName();
                $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
                $file_name = 'pro' .$last_id . $ss;

                $destinationPath2 = 'uploads/shop_logos/';
                $new_img2 = Image::make($file->getRealPath())->resize(500, null, function ($con) {
                    $con->aspectRatio();
                });
                $new_img2->save($destinationPath2 . $file_name, 80);
                $data['logo'] = $file_name;

            }

             $i = DB::table('shops')->insertGetId($data);
            if($i)
            {
                $shop_sub = array(
                    'shop_id' => $i,
                    'subscription_id'=> 1,
                    'status' => 1
                 );
                $shop = DB::table('shops')->where('active',1)->where('id', $i)->first();
                DB::table('shop_subscriptions')->insertGetId($shop_sub);
                $r->session()->put('shop', $shop);
                $r->session()->flash('sms', 'Your shop saved successfully, thanks!');
                return redirect('/owner/my-shop');
            }
            else{
                $r->session()->flash('sms1', 'Fail to save!');
                return redirect('/owner/my-shop');
            }
        }
    }
    public function edit_shop($id) {
        $data['shops'] = DB::table('shops')->where('id', $id)->first();
        return view("fronts.shops.edit-shop",$data);
    }

     public function do_edit_shop(Request $r) {
         $data = array(
            'name' => $r->shop_name,
            'shop_category' => $r->shop_category,
            'address' => $r->shop_address,
            'phone' => $r->shop_phone,
            'email' => $r->shop_email,
            'website' => $r->shop_website,
            'description' => $r->shop_description,
            'location' => $r->shop_location,
        );

        if($r->hasFile('logo'))
        {
            $file = $r->file('logo');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'pro' .$r->id . $ss;

            $destinationPath2 = 'uploads/shop_logos/';
            $new_img2 = Image::make($file->getRealPath())->resize(500, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img2->save($destinationPath2 . $file_name, 80);
            $data['logo'] = $file_name;

        }

        $i = DB::table('shops')->where('id', $r->id)->update($data);
        if($i)
        {
            $r->session()->flash('sms', 'Your shop information have changed successfully!');
            return redirect('/owner/my-shop');
        }
        else{
            $r->session()->flash('sms1', 'Fail to save change!');
            return redirect('/owner/shop/edit/'.$r->id);
        }
    }

    public function shop_subscription($id){
        $data['subscriptions'] = DB::table('subscription')->where('id','>', 1)->get();
        return view("fronts.shops.shop-subscription",$data);
    }

    public function do_shop_subscription($id){
        $owner_id = Session::get("shop_owner")->id;
        $shops  = DB::table('shops')->where('shop_owner_id',$owner_id)->where('active',1)->first();
        $shop_sub = array(
            'shop_id' => $shops->id,
            'subscription_id'=> $id
         );
        $i = DB::table('shop_subscriptions')->insertGetId($shop_sub);
        if($i)
        {
            Session::flash('sms', 'Your subscription have been submit successfully!');
            return redirect('/owner/my-shop');
        }
        else{
            Session::flash('sms1', 'Fail to subscribe!');
            return redirect('/owner/my-shop');
        }
    }

     // product
    public function product(){
        $owner_id = Session::get("shop_owner")->id;
        $data['query']= "";
        if(isset($_GET['q']))
        {
            $data['query'] = $_GET['q'];
            $data['products'] = DB::table('products')
                ->join('product_categories', 'products.category_id', 'product_categories.id')
                ->join('shops', 'shops.id', 'products.shop_id')
                ->join('shop_owners', 'shop_owners.id', 'shops.shop_owner_id')
                ->select('products.*', 'product_categories.name as cname')
                ->where(function($fn){
                    $fn->where('products.name', 'like', "%{$_GET['q']}%")
                    ->orWhere('product_categories.name', 'like', "%{$_GET['q']}%");
                })
                ->where('products.active', 1)
                ->where('shop_owners.id', $owner_id)
                ->orderBy('products.id', 'desc')
                ->paginate(18);
        }
        else{
            
            $data['products'] = DB::table('products')
                ->join('product_categories', 'products.category_id', 'product_categories.id')
                ->join('shops', 'shops.id', 'products.shop_id')
                ->join('shop_owners', 'shop_owners.id', 'shops.shop_owner_id')
                ->select(
                    'products.*', 
                    'product_categories.name as cname'
                )
                ->where('shop_owners.id', $owner_id)
                ->where('products.active', 1)
                ->orderBy('products.id', 'desc')
                ->paginate(10);
        }
        
        return view("fronts.shops.products.index",$data);
    }

    public function new_product(){
        $shop_category = Session::get("shop")->shop_category;
       
         $data['categories'] = DB::table('product_categories')
            ->where('active', 1)
            ->orderBy('name')
            ->where('id', $shop_category)
            ->get();
        $data['brands'] = DB::table('product_brands')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        return view("fronts.shops.products.create",$data);
    
    }

    public function save_product(Request $r){
        //validation
        $validatedData = $r->validate([
            'price' => 'required',
            'original_price' => 'required',
            'name' => 'required',
            'category' => 'required',
            'quantity' => 'required',
            'condiction' => 'required'
        ]);
        $owner_id = Session::get("shop_owner")->id;
        $shops  = DB::table('shops')->where('shop_owner_id',$owner_id)->where('active',1)->first();
        $i = DB::table('products')->where('brand_id',$r->brand)->where('name', $r->name)->where('shop_id', $shops->id)->where('active',1)->count();
            if($i>0) {
                $r->session()->flash('sms1', 'Fail to create new product. This product name ['.$r->name.'] have already!');
                return redirect('/owner/new-product/')->withInput();
            } else {
    
                $data = [
                    'name' => $r->name,
                    'shop_id' => $shops->id,
                    'category_id' => $r->category,
                    'condiction' => $r->condiction,
                    'brand_id' => $r->brand,
                    'price' => $r->price,
                    'original_price' => $r->original_price,
                    'quantity' => $r->quantity,
                    'description' => $r->description,
                    'short_description'=> $r->short_description,
                ];
            }
    
        $id = DB::table('products')->insertGetId($data);
        $i = $id;
        if($i)
        {
            if($r->hasFile('photo'))
            {
                $file = $r->file('photo');
                $file_name = $file->getClientOriginalName();
                $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
                $file_name = $i . $ss;
                
                $destinationPath = 'uploads/products/featured_images/180/';
                $new_img = Image::make($file->getRealPath())->resize(180, null, function ($con) {
                    $con->aspectRatio();
                });

                $destinationPath2 = 'uploads/products/featured_images/250/';
                $new_img2 = Image::make($file->getRealPath())->resize(250, null, function ($con) {
                    $con->aspectRatio();
                });

                $destinationPath3 = 'uploads/products/featured_images/600/';
                $new_img3 = Image::make($file->getRealPath())->resize(600, null, function ($con) {
                    $con->aspectRatio();
                });
                $new_img->save($destinationPath . $file_name, 80);
                $new_img2->save($destinationPath2 . $file_name, 80);
                $new_img3->save($destinationPath3 . $file_name, 80);
                $qr_code_link = 'detail-product/'.$i;
                DB::table('products')->where('id', $i)->update(['featured_image'=>$file_name, 'qr_code_link' => $qr_code_link]);
            }
            $r->session()->flash('sms', 'New product has been create successfully!');
            return redirect('/owner/detail-product/'.base64_encode($i));
        }
        else{
            $r->session()->flash('sms1', 'Fail to create new product. Please check your input again!');
            return redirect('/owner/new-product/')->withInput();
        }
    }

    public function detail_product($id){
        //  if(!Right::check('Product', 'i'))
        // {
        //     return view('permissions.no');
        // }

        $encrypted_id = $id;
        $decrypted_id = base64_decode($encrypted_id);

        $data['product'] = DB::table('products')
            ->join('product_categories', 'products.category_id', 'product_categories.id')
            ->leftjoin('product_brands', 'products.brand_id', 'product_brands.id')
            ->leftJoin('promotions',function ($join) {
                $join->on('promotions.product_id', '=' , 'products.id') ;
                $join->where('promotions.active','=',1) ;
            })
            ->where('products.id', $decrypted_id)
            ->select('products.*',
             'product_categories.name as cname', 
             'products.id as p_id', 
             'product_brands.name as brand', 
             'promotions.discount', 
             'promotions.number_product', 
             'promotions.start_date', 
             'promotions.end_date', 
             'promotions.discount_code')->first();

        $data['photos'] = DB::table('product_photos')
            ->where('product_id', $decrypted_id)
            ->orderBy('id', 'desc')
            ->get();

        $data['color'] = DB::table('product_categories')
            ->where('id', $data['product']->category_id)
            ->select('color')
            ->first();
        $data['colors'] = DB::table('product_colors')
            ->where('product_id', $decrypted_id)
            ->orderBy('id', 'desc')
            ->get();
        $data['size'] = DB::table('product_categories')
            ->where('id', $data['product']->category_id)
            ->select('size')
            ->first();
        $data['sizes'] = DB::table('product_sizes')
            ->where('product_id', $decrypted_id)
            ->orderBy('id', 'desc')
            ->get();
        return view('fronts.shops.products.detail', $data);
    }

    function edit_product($id){
        $encrypted_id = $id;
        $decrypted_id = base64_decode($encrypted_id);
        $shop_category = Session::get("shop")->shop_category;
         $data['product'] = DB::table('products')
            ->leftJoin('promotions',function ($join) {
                $join->on('promotions.product_id', '=' , 'products.id') ;
                $join->where('promotions.active','=',1) ;
            })
            ->select('products.*','promotions.discount')
            ->where('products.id', $decrypted_id)
            ->first();
         $data['categories'] = DB::table('product_categories')
            ->where('active', 1)
            ->orderBy('name')
            ->where('id', $shop_category)
            ->get();
        
        $data['brands'] = DB::table('product_brands')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        return view('fronts.shops.products.edit', $data);
    }

    public function do_edit_product(Request $r){
        $encrypted_id = $r->id;
        $decrypted_id = base64_decode($encrypted_id);
         $i = DB::table('products')->where('brand_id',$r->brand)->where('name', $r->name)->where('active',1)->where('id', '!=', $decrypted_id)->count();
        if($i>0) {
            $r->session()->flash('sms1', 'Fail to save change product! your product has been posted.');
            return redirect('/owner/edit-product/'.$encrypted_id)->withInput();
        } else {
            $data = [
                'name' => $r->name,
                'category_id' => $r->category,
                'condiction' => $r->condiction,
                'brand_id' => $r->brand,
                'price' => $r->price,
                'original_price' => $r->original_price,
                'quantity' => $r->quantity,
                'description' => $r->description,
                'short_description'=> $r->short_description
            ];
        }
        if($r->hasFile('photo'))
        {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'pro' .$decrypted_id . $ss;
            $destinationPath = 'uploads/products/featured_images/180/';
            $new_img = Image::make($file->getRealPath())->resize(180, null, function ($con) {
                $con->aspectRatio();
            });

            $destinationPath2 = 'uploads/products/featured_images/250/';
            $new_img2 = Image::make($file->getRealPath())->resize(250, null, function ($con) {
                $con->aspectRatio();
            });

            $destinationPath3 = 'uploads/products/featured_images/600/';
            $new_img3 = Image::make($file->getRealPath())->resize(600, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);
            $new_img2->save($destinationPath2 . $file_name, 80);
            $new_img3->save($destinationPath3 . $file_name, 80);
            $data['featured_image'] = $file_name;

        }
        $affected = DB::table('products')->where('id', $decrypted_id)->update($data);
        if($affected)
        {
            $r->session()->flash('sms', 'All changes have been saved!');
            return redirect('/owner/edit-product/'.$encrypted_id);
        }
        else{
            $r->session()->flash('sms1', 'Fail to save changes!');
            return redirect('/owner/edit-product/'.$encrypted_id);
        }
    }

        public function best_seller($id)
    {
        $i = DB::table('products')->where('id', $id)->update(['best_seller'=> 1]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/owner/my-product?page='.$page);
        }
        return redirect('/owner/my-product');
    }

    public function best_seller_return($id)
    {
        $i = DB::table('products')->where('id', $id)->update(['best_seller'=> 0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/owner/my-product?page='.$page);
        }
        
        return redirect('/owner/my-product');
    }

    public function best_deal($id)
    {
        $i = DB::table('products')->where('id', $id)->update(['best_deal'=> 1]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/owner/my-product?page='.$page);
        }
        return redirect('/owner/my-product');
    }

    public function best_deal_return($id)
    {
        $i = DB::table('products')->where('id', $id)->update(['best_deal'=> 0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/owner/my-product?page='.$page);
        }
        return redirect('/owner/my-product');
    }

    public function delete_product($id){
        $encrypted_id = $id;
        $decrypted_id = base64_decode($encrypted_id);
        DB::table('products')->where('id', $decrypted_id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/owner/my-product?page='.$page);
        }
        return redirect('/owner/my-product');
    }

    public function shop_owner_send_account_recovery(Request $r)
    {
        $shop_owner_email = $r->email;
        // check if email exist
        $result = DB::table("shop_owners")->where("email", $shop_owner_email)->first();

        if ($result!=null)
        {
            $id = md5($result->id);
            $i = Right::send_email_shop_owner_recovery($shop_owner_email, $id);
            // update recovery mode for seeker
            //DB::raw("update employers set recovery_mode=1 where md5(id)='{$id}'");
            DB::table("shop_owners")->where("id", $result->id)->update(['is_verified'=>1]);
            return view("fronts.shop-owner-account-recovery-success");
        }
        else{
            if ($r->session()->get('lang')=='en') {
                $r->session()->flash("sms2", "Your email does not exist in our system!");
            
            } else {
                $r->session()->flash("sms2", "អុីម៉ែលរបស់អ្នកមិនមាននៅក្នុងប្រព័ន្ធយើងទេ!");
            
            }
            return redirect('/owner/account-recovery')->withInput();
        }
    }

    // product out of the stock
    public function out_stock()
    {
        $owner_id = Session::get("shop_owner")->id;
        $data['products'] = DB::table('products')
            ->join('product_categories', 'products.category_id', 'product_categories.id')
            ->join('shops', 'shops.id', 'products.shop_id')
            ->join('shop_owners', 'shop_owners.id', 'shops.shop_owner_id')
            ->select('products.*', 'product_categories.name as cname')
            ->where('shop_owners.id', $owner_id)
            ->where('products.quantity', '<=', 10)
            ->where('products.active', 1)
            ->orderBy('products.id', 'desc')
            ->paginate(18);
        return view("fronts.shops.products.out-stock", $data);
    }

    //add more quantities to product that less than 10
    public function add_qty(Request $r)
    {
        $encrypted_id = $r->id;
        $decrypted_id = Crypt::decryptString($encrypted_id);
        $decrypted_owner_id = Crypt::decryptString($r->shop_id);
        
        $pro_name = DB::table('products')->where('id', $decrypted_id)
            ->where('shop_id', $decrypted_owner_id)
            ->select('name', 'quantity')
            ->first();
        $total_qty = $pro_name->quantity+$r->qty;
        $i = DB::table('products')->where('id', $decrypted_id)
            ->where('shop_id', $decrypted_owner_id)
            ->update(["quantity"=>$total_qty]);
        
        if($i)
        {
            $r->session()->flash('sms', 'You have added ['.$r->qty.'] to ['.$pro_name->name.'] !');
            return redirect('/owner/product/out-stock');
        }
        else{
            $r->session()->flash('sms1', 'Fail to add ['.$r->qty.'] to ['.$pro_name->name.'] !');
            return redirect("/owner/product/out-stock");
        }
    }



    // shop owner account reset
    public function shop_owner_new_password($id)
    {
        $data['id'] = $id;
        return view("fronts.shop-owner-new-password", $data);
    }

    public function shop_owner_reset_password(Request $r)
    {
        if($r->password === $r->cpassword) {
            $pass = password_hash($r->password, PASSWORD_BCRYPT);
          $i =  DB::table("shop_owners")->whereRaw("md5(id)='{$r->id}'")->update(["password"=>$pass, "is_verified"=>0]);
          if ($r->session()->get('lang')=='en') {
                $r->session()->flash("sms3", "You've reset successfully. Please login with your new password!");
            
            } else {
                $r->session()->flash("sms3", "you just changed your passoword, please enter your new password!");
            }
            return redirect('/owner/login');
        } else {
            if ($r->session()->get('lang')=='en') {
                $r->session()->flash("sms4", "You've fail reset password. Please try to reset again!");
            
            } else {
                $r->session()->flash("sms4", "You have no change!");
            }
            return redirect('/owner/service/reset/'.$r->id);
        }
        
       
    }

    public function shop_owner_activated_account() {
        
        return view("fronts.shops.shop-owner-activated-account");
    }

    public function shop_owner_activated_save(Request $r) {

        $code = $r->code;
        $i = DB::table('shop_owners')->whereRaw("md5(id)='{$r->code}'")->update(["activated"=> 1, "active"=>1]);
        if($i) {
            if ($r->session()->get('lang')=='en') {
                $r->session()->flash("sms3", "Activated Successfully!");
            
            } else {
                $r->session()->flash("sms3", "Your activation is successfully!");
            }
        } else {
            if ($r->session()->get('lang')=='en') {
                $r->session()->flash("sms2", "Your has activated already! Please login");
            
            } else {
                $r->session()->flash("sms2", "Your activation is not successfully!");
            } 
        }
        return redirect('owner/login/');
    }
     // logout function
     public function logout(Request $request)
     {
         $lang = $request->session()->get('lang');
         $request->session()->forget('shop_owner');
         $request->session()->flush();
         $request->session()->put('lang', $lang);
         return redirect('/');
     }
}
