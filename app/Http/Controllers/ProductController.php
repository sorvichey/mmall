<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(!Right::check('Product', 'l'))
        {
            return view('permissions.no');
        }
        $data['query']= "";
        if(isset($_GET['q']))
        {
            $data['query'] = $_GET['q'];
            $data['products'] = DB::table('products')
                ->join('product_categories', 'products.category_id', 'product_categories.id')
                ->where('products.active', 1)
                ->orderBy('products.id', 'desc')
                ->select('products.*', 'product_categories.name as cname')
                ->where(function($fn){
                    $fn->where('products.name', 'like', "%{$_GET['q']}%")
                    ->orWhere('product_categories.name', 'like', "%{$_GET['q']}%");
                })
                ->paginate(18);
        }
        else{
        $data['products'] = DB::table('products')
            ->join('product_categories', 'products.category_id', 'product_categories.id')
            ->where('products.active', 1)
            ->orderBy('products.id', 'desc')
            ->select('products.*', 'product_categories.name as cname')
            ->paginate(18);
        }
        return view('products.index', $data);
    }
    public function detail($id)
    {
        if(!Right::check('Product', 'i'))
        {
            return view('permissions.no');
        }
        $data['product'] = DB::table('products')
            ->join('product_categories', 'products.category_id', 'product_categories.id')
            ->join('product_brands', 'products.brand_id', 'product_brands.id')
            ->where('products.id', $id)
            ->select('products.*', 'product_categories.name as cname', 'products.id as p_id', 'product_brands.name as brand')
            ->first();
        $data['photos'] = DB::table('product_photos')
            ->where('product_id', $id)
            ->orderBy('id', 'desc')
            ->get();

        $data['color'] = DB::table('product_categories')
            ->where('id', $data['product']->category_id)
            ->select('color')
            ->first();
        $data['colors'] = DB::table('product_colors')
            ->where('product_id', $id)
            ->orderBy('id', 'desc')
            ->get();
        return view('products.detail', $data);
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
        return view('products.create', $data);
    }
    public function save(Request $r)
    {
            $i = DB::table('products')->where('brand_id',$r->brand)->where('name', $r->name)->where('active',1)->count();
            if($i>0) {
                $r->session()->flash('sms1', 'Fail to create new product. Please check your input again!');
                return redirect('/admin/product/create')->withInput();
            } else {
    
                $data = [
                    'name' => $r->name,
                    'category_id' => $r->category,
                    'condiction' => $r->condiction,
                    'brand_id' => $r->brand,
                    'price' => $r->price,
                    'quantity' => $r->quantity,
                    'discount' => $r->discount,
                    'description' => $r->description,
                    'short_description'=> $r->short_description,
                ];
            }
    
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
                $qr_code_link = 'product/detail/'.$i;
                DB::table('products')->where('id', $i)->update(['featured_image'=>$file_name, 'qr_code_link' => $qr_code_link]);
            }
            $r->session()->flash('sms', 'New product has been create successfully!');
            return redirect('/admin/product/detail/'.$i);
        }
        else{
            $r->session()->flash('sms1', 'Fail to create new product. Please check your input again!');
            return redirect('/admin/product/create')->withInput();
        }
    }
    public function edit($id)
    {
        $data['product'] = DB::table('products')
            ->where('id', $id)
            ->first();
        $data['categories'] = DB::table('product_categories')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        $data['categories'] = DB::table('product_categories')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        $data['brands'] = DB::table('product_brands')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        return view('products.edit', $data);
    }
    public function update(Request $r)
    {
        $i = DB::table('products')->where('brand_id',$r->brand)->where('name', $r->name)->where('active',1)->where('id', '!=', $r->id)->count();
        if($i>0) {
            $r->session()->flash('sms1', 'Fail to save change product! your product has been posted.');
            return redirect('/admin/product/edit/'.$r->id)->withInput();
        } else {
            $data = [
                'name' => $r->name,
                'category_id' => $r->category,
                'condiction' => $r->condiction,
                'brand_id' => $r->brand,
                'price' => $r->price,
                'quantity' => $r->quantity,
                'discount' => $r->discount,
                'description' => $r->description,
                'short_description'=> $r->short_description
            ];
        }
        if($r->hasFile('photo'))
        {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'pro' .$r->id . $ss;
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
        $i = DB::table('products')->where('id', $r->id)->update($data);
        if($i)
        {
            $r->session()->flash('sms', 'All changes have been saved!');
            return redirect('/admin/product/edit/'.$r->id);
        }
        else{
            $r->session()->flash('sms1', 'Fail to save changes!');
            return redirect('/admin/product/edit/'.$r->id);
        }
    }


    public function best_seller($id)
    {
        $i = DB::table('products')->where('id', $id)->update(['best_seller'=> 1]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/product?page='.$page);
        }
        return redirect('/admin/product');
    }

    public function best_seller_return($id)
    {
        $i = DB::table('products')->where('id', $id)->update(['best_seller'=> 0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/product?page='.$page);
        }
        
        return redirect('/admin/product');
    }

    public function best_deal($id)
    {
        $i = DB::table('products')->where('id', $id)->update(['best_deal'=> 1]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/product?page='.$page);
        }
        return redirect('/admin/product');
    }

    public function best_deal_return($id)
    {
        $i = DB::table('products')->where('id', $id)->update(['best_deal'=> 0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/product?page='.$page);
        }
        return redirect('/admin/product');
    }

    public function delete($id)
    {
        DB::table('products')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/product?page='.$page);
        }
        return redirect('/admin/product');
    }
}
