<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view("fronts.shop-owner-login");
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
        $owner_id = Session::get("shop_owner")->id;

        $data['my_shop'] = DB::table('shops')->where('shop_owner_id', $owner_id)->count();
        if($data['my_shop']==1){
            $data['shop_info'] = DB::table('shops')
                ->join('shop_categories', 'shop_categories.id', 'shops.shop_category')
                ->select('shops.*', 'shops.id as id', 'shop_categories.name as shop_category_name', 'shop_categories.id as shop_category_id')
                ->first();
        }
        return view("fronts.shops.my-shop", $data);
    }

    public function create_shop(Request $r) {

        return view("fronts.shops.create-shop");
    }

    public function do_create_shop(Request $r) {
        $owner_id = Session::get("shop_owner")->id;
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
            $r->session()->flash('sms', 'Your shop saved successfully!');
            return redirect('/owner/my-shop');
        }
        else{
            $r->session()->flash('sms1', 'Fail to save!');
            return redirect('/owner/my-shop');
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
                $r->session()->flash("sms3", "អ្នកទើបតែប្តូរលេខសម្ងាត់ សូមចូលក្នុងប្រព័ន្ធជាមួយនឹងលេខសម្ងាត់ថ្មីរបស់អ្នក!");
            }
            return redirect('/owner/login');
        } else {
            if ($r->session()->get('lang')=='en') {
                $r->session()->flash("sms4", "You've fail reset password. Please try to reset again!");
            
            } else {
                $r->session()->flash("sms4", "អ្នកមិនអាចផ្លាស់ប្តូលេខសំងាត់បានទេ. សូមព្យាយាមម្តងទៀត!");
            }
            return redirect('/owner/service/reset/'.$r->id);
        }
        
       
    }

    public function shop_owner_activated_account() {
        
        return view("fronts.shop-owner-activated-account");
    }

    public function shop_owner_activated_save(Request $r) {

        $code = $r->code;
        $i = DB::table('shop_owners')->whereRaw("md5(id)='{$r->code}'")->update(["activated"=> 1, "active"=>1]);
        if($i) {
            if ($r->session()->get('lang')=='en') {
                $r->session()->flash("sms3", "Activated Successfully!");
            
            } else {
                $r->session()->flash("sms3", "អាប្រើប្រាស់បាន!");
            }
        } else {
            if ($r->session()->get('lang')=='en') {
                $r->session()->flash("sms2", "Your has activated already! Please login");
            
            } else {
                $r->session()->flash("sms2", "មិនអាប្រើប្រាស់បាន!");
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
