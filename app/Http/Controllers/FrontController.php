<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
class FrontController extends Controller
{

  public function __construct()
    {
        $this->middleware(function ($request, $next) {
           app()->setLocale(Session::get("lang"));
            return $next($request);
        });
        date_default_timezone_set('Asia/Phnom_Penh');
        $this->promotion_disable();
    }
    // disable all promotions are expired
    protected function promotion_disable(){
        $now_date=Carbon::now()->toDateTimeString();
        $data_update = array(
                'active' => 0
            );
        DB::table('promotions')->where('end_date','<=', $now_date)->update($data_update);
    }
    public function index()
    {
        $data['slides'] = DB::table('slides')
            ->select('title', 'photo', 'short_description', 'discount', 'order', 'url')
            ->where('active', 1)
            ->orderBy('order', 'asc')
            ->get();
        $data['product_new_arrivals'] = DB::table('products')
            ->join('product_categories', 'product_categories.id', 'products.category_id')
            ->select('products.name', 'products.id as p_id', 'products.price', 'promotions.discount', 'products.featured_image', 'product_categories.name as category_name', 'product_categories.id as category_id')
            ->leftJoin('promotions',function ($join) {
                $join->on('promotions.product_id', '=' , 'products.id') ;
                $join->where('promotions.active','=',1) ;
            })
            ->where('products.active',1)
            ->where('products.best_deal', 0)
            ->where('products.best_seller', 0)
            ->orderBy('products.id', 'desc')
            ->limit(24)
            ->get();
        $data['best_seller_products'] = DB::table('products')
            ->join('product_categories', 'product_categories.id', 'products.category_id')
            ->leftJoin('promotions',function ($join) {
                $join->on('promotions.product_id', '=' , 'products.id') ;
                $join->where('promotions.active','=',1) ;
            })
            ->select('products.name', 'products.id as p_id', 'products.price', 'promotions.discount', 'products.featured_image', 'product_categories.name as category_name', 'product_categories.id as category_id')
            ->where('products.active',1)
            ->where('products.best_seller', 1)
            ->orderBy('products.id', 'desc')
            ->limit(24)
            ->get();
        $data['best_deal_products'] = DB::table('products')
            ->join('product_categories', 'product_categories.id', 'products.category_id')
            ->leftJoin('promotions',function ($join) {
                $join->on('promotions.product_id', '=' , 'products.id') ;
                $join->where('promotions.active','=',1) ;
            })
            ->select('products.name','products.id as p_id', 'products.price', 'promotions.discount', 'products.featured_image', 'product_categories.name as category_name', 'product_categories.id as category_id')
            ->where('products.active',1)
            ->where('products.best_deal', 1)
            ->orderBy('products.id', 'desc')
            ->limit(24)
            ->get();
        return view('fronts.index', $data);
    }



    public function login(){
        return view('fronts.owners.login');
    }

    public function product_list(){
        return view('product-list');
    }

    public function product_single(){
        return view('product-single');
    }

    public function cart(){
        return view('cart');
    }

    public function product_detail($id) {
        $id = base64_decode($id);
        $data['product'] = DB::table('products')
            ->join('product_categories', 'products.category_id', 'product_categories.id')
            ->leftJoin('promotions',function ($join) {
                $join->on('promotions.product_id', '=' , 'products.id') ;
                $join->where('promotions.active','=',1) ;
            })
            ->where('products.id', $id)
            ->select('products.*', 'promotions.discount', 'product_categories.name as category_name', 'products.id as p_id')
            ->first();
        $data['related_products'] = DB::table('products')
            ->join('product_categories', 'product_categories.id', 'products.category_id')
            ->leftJoin('promotions',function ($join) {
                $join->on('promotions.product_id', '=' , 'products.id') ;
                $join->where('promotions.active','=',1) ;
            })
            ->select('products.name', 'products.id as p_id', 'products.price', 'promotions.discount', 'products.featured_image', 'product_categories.name as category_name', 'product_categories.id as category_id')
            ->where('products.active',1)
            ->where('products.category_id', $data['product']->category_id)
            ->where('products.id', '!=', $id)
            ->orderBy('products.best_deal', 'desc')
            ->orderBy('products.best_seller', 'desc')
            ->orderBy('products.id', 'desc')
            ->limit(18)
            ->get();
        $data['photos'] = DB::table('product_photos')
            ->where('product_id', $id)
            ->orderBy('id', 'desc')
            ->get();
        $data['colors'] = DB::table('product_colors')
            ->where('product_id', $id)
            ->get();
        $data['sizes'] = DB::table('product_sizes')
            ->where('product_id', $id)
            ->get();
        $data['reviewer'] = DB::table('review_products')
            ->where('product_id', $id)
            ->count();
        $data['rate_overall'] = DB::table('review_products')
            ->select(DB::raw('(5*COUNT(IF( rate = 5, rate, NULL))+
                4*COUNT(IF( rate = 4, rate, NULL))+
                3*COUNT(IF( rate = 3, rate, NULL))+
                2*COUNT(IF( rate = 2, rate, NULL))+
                1*COUNT(IF( rate = 1, rate, NULL))) / 
                (COUNT(IF( rate = 5, rate, NULL))+
                COUNT(IF( rate = 4, rate, NULL))+
                COUNT(IF( rate = 3, rate, NULL))+
                COUNT(IF( rate = 2, rate, NULL))+
                COUNT(IF( rate = 1, rate, NULL))) AS rateEverage'))
            ->where('product_id', $id)
            ->get();
        $data['rate_progress'] = DB::table('review_products')
            ->select(DB::raw('COUNT(IF( rate = 5, rate, NULL)) AS rate5,
                COUNT(IF( rate = 4, rate, NULL)) AS rate4,
                COUNT(IF( rate = 3, rate, NULL)) AS rate3,
                COUNT(IF( rate = 2, rate, NULL)) AS rate2,
                COUNT(IF( rate = 1, rate, NULL)) AS rate1'))
            ->where('product_id', $id)
            ->get();
        $data['reviewer_list'] = DB::table('review_products')
            ->select('review_products.*', 'review_products.create_at as create_at', 'buyers.first_name','buyers.last_name')
            ->join('buyers', 'buyers.id', 'review_products.buyer_id')
            ->where('product_id', $id)
            ->where('approve', 1)
            ->where('review_products.active', 1)
            ->orderBy('review_products.id', 'DESC')
            ->paginate(10);
        return view('fronts.product-detail', $data);
    }
    public function career() {
        $data['careers'] = DB::table('careers')
            ->join('career_categories', 'career_categories.id', 'careers.career_category_id')
            ->join('department_categories', 'department_categories.id', 'careers.department_id')
            ->where('careers.active',1)
            ->orderBy('careers.id', 'desc')
            ->select('careers.*', 'careers.id as id', 'career_categories.name as category', 'department_categories.name as department')
            ->paginate(18);
        return view('fronts.career', $data);
    }

    public function career_detail($id) {
        $data['career'] = DB::table('careers')
        ->join('career_categories', 'career_categories.id', 'careers.career_category_id')
        ->join('department_categories', 'department_categories.id', 'careers.department_id')
        ->where('careers.active',1)
        ->orderBy('careers.id', 'desc')
        ->where('careers.id', $id)
        ->select('careers.*', 'careers.id as id', 'career_categories.name as category', 'department_categories.name as department')
        ->first();
        return view('fronts.career-detail', $data);
    }
}
