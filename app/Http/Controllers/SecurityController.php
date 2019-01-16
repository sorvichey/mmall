<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use App\Http\Controllers\Right;
use Intervention\Image\ImageManagerStatic as Image;
class SecurityController extends Controller
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
        return view("fronts.login");
    }

    public function buyer_sign_up(Request $r) {
        // check the email if it is valid or not
        if (!filter_var($r->email, FILTER_VALIDATE_EMAIL)) {
        
                $r->session()->flash('sms1', "Your email is invalid. Check it again!");

            return redirect('/buyer/login')->withInput();
        }
        $email = DB::table('buyers')
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
            $i = DB::table('buyers')->insertGetId($data);

            $buyer_email = $r->email;
            // check if email exist

            $id = md5($i);
            $success = Right::send_email_activated($buyer_email, $id);

            if ($success)
            {
                $r->session()->flash('sms', $sms);
                return redirect('/buyer/login');
            }
            else
            {
                $r->session()->flash('sms1', $sms1);
                return redirect('/buyer/login')->withInput();
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
            return redirect('/buyer/login')->withInput();
        } 
    }

    public function do_login(Request $r)
    {
        $email = $r->email;
        $pass = $r->password;
        $buyer = DB::table('buyers')->where('active',1)->where('email', $email)->first();
        
        $buyer_activated = 
            DB::table('buyers')
            ->where('active',1)
            ->where('activated', 1)
            ->where('email', $email)
            ->count();
        if($buyer != null)
        {
            if($buyer_activated > 0) {
                if(password_verify($pass, $buyer->password))
                {
                    // save user to session
                    $r->session()->put('buyer', $buyer);
                   
                    return redirect('/');
                }
                else{
                    if ($r->session()->get('lang')=='en') {
                        $r->session()->flash('sms2', "Invalid email or password. Try again!");
                    } else {
                        $r->session()->flash('sms2', "ឈ្មេាះឬលេខសម្ងាត់មិនត្រឹមត្រូវទេ។ សូមព្យាយាមម្តងទៀត!");
                    }
                    
                    return redirect('/buyer/login')->withInput();
                }
            } else {
                if ($r->session()->get('lang')=='en') {
                    $r->session()->flash('sms2', "Please activate in account from your email");
                } else {
                    $r->session()->flash('sms2', "សូមចូលទៅក្នុងគណនីអីុម៉ែលរបស់អ្នកដើម្បីដំណើរការគណនី");
                }
                
                return redirect('/buyer/login')->withInput();
            }
        }
        else{
            if ($r->session()->get('lang')=='en') {
                $r->session()->flash('sms2', "Invalid email or password!");
            } else {
                $r->session()->flash('sms2', "អីុម៉ែលឬលេខសម្ងាត់មិនត្រឹមត្រូវទេ!");
            }
            
            return redirect('/buyer/login')->withInput();
        }
    }

    public function buyer_account_recovery() {
        return view("fronts.buyer-account-recovery");
    }

    public function buyer_send_account_recovery(Request $r)
    {
        $buyer_email = $r->email;
        // check if email exist
        $result = DB::table("buyers")->where("email", $buyer_email)->first();
        if ($result!=null)
        {
            $id = md5($result->id);
            $i = Right::send_email($buyer_email, $id);
            // update recovery mode for seeker
            //DB::raw("update employers set recovery_mode=1 where md5(id)='{$id}'");
            DB::table("buyers")->where("id", $result->id)->update(['recovery_mode'=>1]);
            return view("fronts.buyer-account-recovery-success");
        }
        else{
            if ($r->session()->get('lang')=='en') {
                $r->session()->flash("sms2", "Your email does not exist in our system!");
            
            } else {
                $r->session()->flash("sms2", "អុីម៉ែលរបស់អ្នកមិនមាននៅក្នុងប្រព័ន្ធយើងទេ!");
            
            }
            return redirect('/buyer/account-recovery')->withInput();
        }
    }
    public function buyer_new_password($id)
    {
        $data['id'] = $id;
        return view("fronts.buyer-new-password", $data);
    }

    public function buyer_reset_password(Request $r)
    {
        

        if($r->password === $r->cpassword) {
            $pass = password_hash($r->password, PASSWORD_BCRYPT);
          $i =  DB::table("buyers")->whereRaw("md5(id)='{$r->id}'")->update(["password"=>$pass, "recovery_mode"=>0]);
          if ($r->session()->get('lang')=='en') {
                $r->session()->flash("sms3", "You've reset successfully. Please login with your new password!");
            
            } else {
                $r->session()->flash("sms3", "អ្នកទើបតែប្តូរលេខសម្ងាត់ សូមចូលក្នុងប្រព័ន្ធជាមួយនឹងលេខសម្ងាត់ថ្មីរបស់អ្នក!");
            }
            return redirect('/buyer/login');
        } else {
            if ($r->session()->get('lang')=='en') {
                $r->session()->flash("sms4", "You've fail reset password. Please try to reset again!");
            
            } else {
                $r->session()->flash("sms4", "អ្នកមិនអាចផ្លាស់ប្តូលេខសំងាត់បានទេ. សូមព្យាយាមម្តងទៀត!");
            }
            return redirect('/buyer/service/reset/'.$r->id);
        }
        
       
    }

    public function buyer_activated_account() {
        
        return view("fronts.buyer-activated-account");
    }

    public function buyer_activated_save(Request $r) {

        $code = $r->code;
        $i = DB::table('buyers')->whereRaw("md5(id)='{$r->code}'")->update(["activated"=> 1]);
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
        return redirect('buyer/login/');
    }

    public function buyer_account_setting($id){
        $data['buyer_account'] = DB::table("buyers")->where("id", $id)->first();
        return view("fronts.buyer-account-setting",$data);
    }

    public function buyer_account_save_change(Request $r){
        $data = array(
            'first_name' => $r->first_name,
            'last_name' => $r->last_name,
            'gender' => $r->gender,
            'phone' => $r->phone,
            'email' => $r->email
        );

        

        if($r->hasFile('photo'))
        {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'pro' .$r->id . $ss;

            $destinationPath2 = 'uploads/buyer_profiles/';
            $new_img2 = Image::make($file->getRealPath())->resize(500, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img2->save($destinationPath2 . $file_name, 80);
            $data['photo'] = $file_name;

            echo "Hello";

        }

        $i = DB::table('buyers')->where("id", $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash("sms", "Your account've modified  successfully!");
            return redirect("/my-account/setting/".$r->id);
        } else {
            $r->session()->flash("sms1", "Fail to save change!");
            return redirect("/my-account/setting/".$r->id);
        }
    }

    public function buyer_account_save_change_pwd(Request $r){

        if($r->password==$r->re_password){
            $data = array(
                'password' => password_hash($r->password, PASSWORD_BCRYPT)
            );
            $i = DB::table('buyers')->where("id", $r->id)->update($data);
            if ($i)
            {
                $r->session()->flash("sms", "Your password's changed successfully!");
                return redirect("/my-account/setting/".$r->id);
            } else {
                $r->session()->flash("sms1", "Fail to save change!");
                return redirect("/my-account/setting/".$r->id);
            }
        }else{
            $r->session()->flash("sms1", "Password and Re-Password are not the same!");
            return redirect("/my-account/setting/".$r->id);
        }
        
    }
     // logout function
     public function logout(Request $request)
     {
         $lang = $request->session()->get('lang');
         $request->session()->forget('buyer');
         $request->session()->flush();
         $request->session()->put('lang', $lang);
         return redirect('/');
     }
}
