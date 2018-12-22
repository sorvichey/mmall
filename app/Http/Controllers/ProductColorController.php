<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;

class ProductColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id)
    {
        $data['colors'] = DB::table('product_colors')
            ->where('product_id', $id)
            ->orderBy('id', 'desc')
            ->get();
        $data['p_id'] = $id;
        return view('products.color', $data);
    }
    public function delete($id)
    {
        $pid = $_GET['pid'];
        DB::table("product_colors")->where('id', $id)->delete();
        return redirect('/admin/product/detail/'.$pid.'/color');
    }
    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'product_id' => $r->product_id
        );
        $i = DB::table('product_colors')->insertGetId($data);
        if($i)
        {
            if($r->hasFile('photo'))
            {
                $file = $r->file('photo');
                $file_name = $file->getClientOriginalName();
                $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
                $file_name = $i . $ss;
                
                $destinationPath = 'uploads/products/colors/180/';
                $new_img = Image::make($file->getRealPath())->resize(180, null, function ($con) {
                    $con->aspectRatio();
                });

                $destinationPath2 = 'uploads/products/colors/250/';
                $new_img2 = Image::make($file->getRealPath())->resize(250, null, function ($con) {
                    $con->aspectRatio();
                });

                $destinationPath3 = 'uploads/products/colors/600/';
                $new_img3 = Image::make($file->getRealPath())->resize(600, null, function ($con) {
                    $con->aspectRatio();
                });
                $new_img->save($destinationPath . $file_name, 80);
                $new_img2->save($destinationPath2 . $file_name, 80);
                $new_img3->save($destinationPath3 . $file_name, 80);

                DB::table('product_colors')->where('id', $i)->update(['photo'=>$file_name]);
            }

            $r->session()->flash('sms3', 'New color has been uploaded successfully!');
            return redirect('/admin/product/detail/'.$r->product_id.'/color');
        }
        else{
            $r->session()->flash('sms4', 'Fail to upload new color!');
            return redirect('/admin/product/detail/'.$r->product_id.'/color');
        }
    }
}
