<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Intervention\Image\ImageManagerStatic as Image;

class AdminShopOwnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //back end

    public function index() {
        $data['shop_owners'] = DB::table('shop_owners')
        ->orderBy('id', 'desc')
        ->where('active', 1)
        ->paginate(18);
    return view('shop-owners.index', $data);
    }
         
    public function delete($id) {
        DB::table('shop_owners')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/shop-owner?page='.$page);
        }

        return redirect('/admin/shop-owner');
    }
      // load reset password form
      public function reset_password($id)
      {
         $data['owner'] = DB::table('shop_owners')->where('id', $id)->first();
         return view('shop-owners.reset-password', $data);
      }

      public function detail($id){
        $data['owner'] = DB::table('shop_owners')->where('id', $id)->first();
         return view('shop-owners.detail', $data);
      }
  
      public function change_password(Request $r)
      {
          $id = $r->id;
            $this->validate(
                $r, 
                ['new_password' => 'required'],
                ['confirm_password' => 'required']
            );
           
          $new_password = $r->new_password;
          $confirm_password = $r->confirm_password;
     
          if ($new_password!=$confirm_password)
          {
                 $r->session()->flash('sms1',"The password is not matched, please check again.");
                 return redirect('admin/shop-owner/reset-password/'.$id);
          }
          else{
              $data = array(
                  'password' => bcrypt($new_password)
              );
              $i = DB::table('shop_owners')->where('id', $id)->update($data);
              if($i) {
                  $r->session()->flash('sms',"Reset password successfully!");
              }
              return redirect('admin/shop-owner/reset-password/'.$id);
          }
      }
}
