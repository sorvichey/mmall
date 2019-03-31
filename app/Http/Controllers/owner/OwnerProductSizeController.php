<?php

namespace App\Http\Controllers\owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;

class OwnerProductSizeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    public function index($id)
    {
        $data['sizes'] = DB::table('product_sizes')
            ->where('product_id', $id)
            ->orderBy('id', 'desc')
            ->get();
        $data['p_id'] = $id;
        return view('fronts.shops.products.size', $data);
    }
    public function delete($id)
    {
        $pid = $_GET['pid'];
        DB::table("product_sizes")->where('id', $id)->delete();
        return redirect('/owner/product/detail/'.$pid.'/size');
    }
    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'product_id' => $r->product_id
        );
        $i = DB::table('product_sizes')->insertGetId($data);
        if($i)
        {
            // if($r->hasFile('photo'))
            // {
            //     $file = $r->file('photo');
            //     $file_name = $file->getClientOriginalName();
            //     $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            //     $file_name = $i . $ss;
                
            //     $destinationPath = 'uploads/products/colors/180/';
            //     $new_img = Image::make($file->getRealPath())->resize(180, null, function ($con) {
            //         $con->aspectRatio();
            //     });

            //     $destinationPath2 = 'uploads/products/colors/250/';
            //     $new_img2 = Image::make($file->getRealPath())->resize(250, null, function ($con) {
            //         $con->aspectRatio();
            //     });

            //     $destinationPath3 = 'uploads/products/colors/600/';
            //     $new_img3 = Image::make($file->getRealPath())->resize(600, null, function ($con) {
            //         $con->aspectRatio();
            //     });
            //     $new_img->save($destinationPath . $file_name, 80);
            //     $new_img2->save($destinationPath2 . $file_name, 80);
            //     $new_img3->save($destinationPath3 . $file_name, 80);

            //     DB::table('product_colors')->where('id', $i)->update(['photo'=>$file_name]);
            // }

            $r->session()->flash('sms3', 'New size has been added successfully!');
            return redirect('/owner/product/detail/'.$r->product_id.'/size');
        }
        else{
            $r->session()->flash('sms4', 'Fail to add new size!');
            return redirect('/owner/product/detail/'.$r->product_id.'/size');
        }
    }
}
