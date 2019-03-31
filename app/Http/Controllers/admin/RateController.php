<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Intervention\Image\ImageManagerStatic as Image;

class RateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['rate'] = DB::table('review_products')
            ->join('products', 'products.id', 'review_products.product_id')
            ->select('products.name as name','rate','review_products.description as description', 'review_products.approve as approve', 'review_products.id as id')
            ->where('review_products.active', 1)
            ->orderBy('review_products.id', 'desc')
            ->paginate(18);
        
        return view('admin/rate.index', $data);
    }

    public function approve($id)
    {
        $approved = DB::table('review_products')
            ->where('id', $id)
            ->first();
        if ($approved->approve==1) {
            DB::table('review_products')->where('id', $id)->update(["approve"=>0]);
        }else{
            DB::table('review_products')->where('id', $id)->update(["approve"=>1]);
        }
        
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/rating?page='.$page);
        }
        return redirect('/admin/rating');
    }

    public function delete($id)
    {
        DB::table('review_products')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/rating?page='.$page);
        }
        return redirect('/admin/rating');
    }
    
}
