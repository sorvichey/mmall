<?php

namespace App\Http\Controllers\owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use DB;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;

class OwnerPhotoController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    public function index($id)
    {
        $encrypted_id = $id;
        $decrypted_id = Crypt::decryptString($encrypted_id);

        $data['photos'] = DB::table('product_photos')
            ->where('product_id', $decrypted_id)
            ->orderBy('id', 'desc')
            ->get();
        $data['p_id'] = $decrypted_id;
        return view('fronts.shops.products.photo', $data);
    }
    public function delete($poId, $pId)
    {
        $encrypted_id = $poId;
        $decrypted_id = Crypt::decryptString($encrypted_id);

        $encrypted_pid = $pId;
        // $decrypted_pid = Crypt::decryptString($encrypted_pid);

        DB::table("product_photos")->where('id', $decrypted_id)->delete();
        return redirect('/owner/product/detail/'.$encrypted_pid.'/image');
    }
    public function save(Request $r)
    {
        $encrypted_id = $r->product_id;
        $decrypted_id = Crypt::decryptString($encrypted_id);
        $data = array(
            'product_id' => $decrypted_id
        );
        $i = DB::table('product_photos')->insertGetId($data);
        if($i)
        {
            if($r->hasFile('photo'))
            {
                $file = $r->file('photo');
                $file_name = $file->getClientOriginalName();
                $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
                $file_name = $i . $ss;
                
                $destinationPath = 'uploads/products/180/';
                $new_img = Image::make($file->getRealPath())->resize(180, null, function ($con) {
                    $con->aspectRatio();
                });

                $destinationPath2 = 'uploads/products/250/';
                $new_img2 = Image::make($file->getRealPath())->resize(250, null, function ($con) {
                    $con->aspectRatio();
                });

                $destinationPath3 = 'uploads/products/600/';
                $new_img3 = Image::make($file->getRealPath())->resize(600, null, function ($con) {
                    $con->aspectRatio();
                });
                $new_img->save($destinationPath . $file_name, 80);
                $new_img2->save($destinationPath2 . $file_name, 80);
                $new_img3->save($destinationPath3 . $file_name, 80);

                DB::table('product_photos')->where('id', $i)->update(['photo'=>$file_name]);
            }

            $r->session()->flash('sms', 'New photo has been uploaded successfully!');
            return redirect('/owner/product/detail/'.$r->product_id.'/image');
        }
        else{
            $r->session()->flash('sms1', 'Fail to upload new photo!');
            return redirect('/owner/product/detail/'.$r->product_id.'/image');
        }
    }
}
