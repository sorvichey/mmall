<?php

namespace App\Http\Controllers\owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
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
        //decrypt id
        $encrypted_id = $id;
        $decrypted_id = Crypt::decryptString($encrypted_id);
        $data['sizes'] = DB::table('product_sizes')
            ->where('product_id', $decrypted_id)
            ->orderBy('id', 'desc')
            ->get();
        $data['p_id'] = $encrypted_id;
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
        $encrypted_id = $r->product_id;
        $decrypted_id = Crypt::decryptString($encrypted_id);

        $data = array(
            'name' => $r->name,
            'product_id' => $decrypted_id
        );
        $i = DB::table('product_sizes')->insert($data);
        if($i)
        {
            $r->session()->flash('sms3', 'New size has been added successfully!');
            return redirect('/owner/product/detail/'.$encrypted_id.'/size');
        }
        else{
            $r->session()->flash('sms4', 'Fail to add new size!');
            return redirect('/owner/product/detail/'.$encrypted_id.'/size');
        }
    }
}
