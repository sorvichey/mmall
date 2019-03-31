<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Intervention\Image\ImageManagerStatic as Image;

class BuyerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['buyers'] = DB::table('buyers')
            ->where('active', 1)
            ->orderBy('id', 'desc')
            ->paginate(18);
        
        return view('admin/customers.index', $data);
    }
    public function create()
    {
        $data['categories'] = DB::table('product_categories')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        $data['brands'] = DB::table('product_brands')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        $data['status'] = DB::table('product_status')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        return view('admin/products.create', $data);
    }
    public function save(Request $r)
    {
        $data = [
            'name' => $r->name,
            'category_id' => $r->category,
            'status_id' => $r->status,
            'brand_id' => $r->brand,
            'price' => $r->price,
            'quantity' => $r->quantity,
            'discount' => $r->discount,
            'description' => $r->description
        ];
        $i = DB::table('products')->insertGetId($data);
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

                DB::table('products')->where('id', $i)->update(['featured_image'=>$file_name]);
            }

            $r->session()->flash('sms', 'New product has been create successfully!');
            return redirect('/admin/product/create');
        }
        else{
            $r->session()->flash('sms1', 'Fail to create new product. Please check your input again!');
            return redirect('/admin/product/create')->withInput();
        }
    }
    public function best_seller(Request $r)
    {
        $sms = "All changes have been add product to best seller successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('products')->where('id', $r->id)->update(['best_seller'=> 1]);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/product');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/product');
        }
    }

    public function best_seller_return(Request $r)
    {
        $sms = "All changes have been add product to simple seller successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('products')->where('id', $r->id)->update(['best_seller'=> 0]);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/product');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/product');
        }
    }

    public function best_deal(Request $r)
    {
        $sms = "All changes have been add product to best deal successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('products')->where('id', $r->id)->update(['best_deal'=> 1]);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/product');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/product');
        }
    }

    public function best_deal_return(Request $r)
    {
        $sms = "All changes have been add product to simple successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('products')->where('id', $r->id)->update(['best_deal'=> 0]);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/product');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/product');
        }
    }

    public function delete($id)
    {
        DB::table('buyers')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/buyer?page='.$page);
        }
        return redirect('/admin/buyer');
    }
     // load reset password form
     public function reset_password($id)
     {
        $data['buyer'] = DB::table('buyers')->where('id', $id)->first();
        
        return view('admin/customers.reset-password', $data);
     }
 
     public function change_password(Request $r)
     {
         $id = $r->id;
         $new_password = $r->new_password;
         $confirm_password = $r->cpassword;
    
         if ($new_password!=$confirm_password)
         {
                $r->session()->flash('sms1',"The password is not matched, please check again.");
                return redirect('admin/buyer/reset-password/'.$id);
         }
         else{
             $data = array(
                 'password' => bcrypt($new_password)
             );
             $i = DB::table('buyers')->where('id', $id)->update($data);
             if($i) {
                 $r->session()->flash('sms',"Reset password successfully!");
             }
             return redirect('admin/buyer/reset-password/'.$id);
         }
     }

     public function detail($id)
    {
        $data['buyer'] = DB::table('buyers')
            ->where('active', 1)
            ->where('id', $id)
            ->first();

        return view('admin/customers.detail', $data);
    }
    public function edit($id)
    {
        $data['buyer'] = DB::table('buyers')
            ->where('active', 1)
            ->where('id', $id)
            ->first();

        return view('admin/customers.edit', $data);
    }
    public function update(Request $r) {
        $data = array(
            'first_name' => $r->first_name,
            'last_name' => $r->last_name,
            'gender' => $r->gender,
            'phone' => $r->phone,
            'email' => $r->email,
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

        }
        $i = DB::table('buyers')->where('id', $r->id)->update($data);
        if($i)
        {
            $r->session()->flash('sms', 'All changes have been saved!');
            return redirect('/admin/buyer/edit/'.$r->id);
        }
        else{
            $r->session()->flash('sms1', 'Fail to save changes!');
            return redirect('/admin/buyer/edit/'.$r->id);
        }
    }
}
