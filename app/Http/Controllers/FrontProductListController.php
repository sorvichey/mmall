<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class FrontProductListController extends Controller
{

  public function __construct()
    {
        $this->middleware(function ($request, $next) {
           app()->setLocale(Session::get("lang"));
            return $next($request);
        });
    }
    public function best_deal()
    {
        $data['best_deal_products'] = DB::table('products')
            ->join('product_categories', 'product_categories.id', 'products.category_id')
            ->leftJoin('promotions',function ($join) {
                $join->on('promotions.product_id', '=' , 'products.id') ;
                $join->where('promotions.active','=',0) ;
            })
            ->select('products.name','products.id as p_id','short_description', 'products.price', 'promotions.discount', 'products.featured_image', 'product_categories.name as category_name', 'product_categories.id as category_id')
            ->where('products.active',1)
            ->where('products.best_deal', 1)
            ->orderBy('products.id', 'desc')
            ->paginate(10);
        return view('fronts.product-best-deal-list', $data);
    }

    public function best_deal_list_view()
    {
        $data['best_deal_products'] = DB::table('products')
            ->join('product_categories', 'product_categories.id', 'products.category_id')
            ->leftJoin('promotions',function ($join) {
                $join->on('promotions.product_id', '=' , 'products.id') ;
                $join->where('promotions.active','=',0) ;
            })
            ->select('products.name','products.id as p_id','short_description', 'products.price', 'promotions.discount', 'products.featured_image', 'product_categories.name as category_name', 'product_categories.id as category_id')
            ->where('products.active',1)
            ->where('products.best_deal', 1)
            ->orderBy('products.id', 'desc')
            ->paginate(10);
        return view('fronts.product-best-deal-list-view', $data);
    }
    
    
    public function best_seller()
    {
        $data['best_seller_products'] = DB::table('products')
            ->join('product_categories', 'product_categories.id', 'products.category_id')
            ->leftJoin('promotions',function ($join) {
                $join->on('promotions.product_id', '=' , 'products.id') ;
                $join->where('promotions.active','=',0) ;
            })
            ->select('products.name', 'products.id as p_id', 'products.price', 'promotions.discount', 'products.featured_image', 'product_categories.name as category_name', 'product_categories.id as category_id')
            ->where('products.active',1)
            ->where('products.best_seller', 1)
            ->orderBy('products.id', 'desc')
            ->paginate(80);
        return view('fronts.product-best-seller-list', $data);
    }
    public function best_seller_list_view()
    {
        $data['best_seller_products'] = DB::table('products')
            ->join('product_categories', 'product_categories.id', 'products.category_id')
            ->leftJoin('promotions',function ($join) {
                $join->on('promotions.product_id', '=' , 'products.id') ;
                $join->where('promotions.active','=',0) ;
            })
            ->select('products.name', 'products.id as p_id', 'products.short_description', 'products.price', 'promotions.discount', 'products.featured_image', 'product_categories.name as category_name', 'product_categories.id as category_id')
            ->where('products.active',1)
            ->where('products.best_seller', 1)
            ->orderBy('products.id', 'desc')
            ->paginate(80);
        return view('fronts.product-best-seller-list-view', $data);
    }
    public function new_arrival()
    {
        $data['product_new_arrivals'] = DB::table('products')
            ->join('product_categories', 'product_categories.id', 'products.category_id')
            ->leftJoin('promotions',function ($join) {
                $join->on('promotions.product_id', '=' , 'products.id') ;
                $join->where('promotions.active','=',0) ;
            })
            ->select('products.name', 'products.id as p_id', 'products.price', 'promotions.discount', 'products.featured_image', 'product_categories.name as category_name', 'product_categories.id as category_id')
            ->where('products.active',1)
            ->where('products.best_deal', 0)
            ->where('products.best_seller', 0)
            ->orderBy('products.id', 'desc')
            ->paginate(80);
        return view('fronts.product-new-arrival-list', $data);
    }

    public function new_arrival_list_view()
    {
        $data['product_new_arrivals'] = DB::table('products')
            ->join('product_categories', 'product_categories.id', 'products.category_id')
            ->leftJoin('promotions',function ($join) {
                $join->on('promotions.product_id', '=' , 'products.id') ;
                $join->where('promotions.active','=',0) ;
            })
            ->select('products.name', 'products.id as p_id', 'products.short_description', 'products.price', 'promotions.discount', 'products.featured_image', 'product_categories.name as category_name', 'product_categories.id as category_id')
            ->where('products.active',1)
            ->where('products.best_deal', 0)
            ->where('products.best_seller', 0)
            ->orderBy('products.id', 'desc')
            ->paginate(80);
        return view('fronts.product-new-arrival-list-view', $data);
    }

    public function product_by_category($id)
    {
        $data['products'] = DB::table('products')
            ->join('product_categories', 'product_categories.id', 'products.category_id')
            ->leftJoin('promotions',function ($join) {
                $join->on('promotions.product_id', '=' , 'products.id') ;
                $join->where('promotions.active','=',0) ;
            })
            ->select('products.name', 'products.id as p_id', 'products.short_description', 'products.price', 'promotions.discount', 'products.featured_image', 'product_categories.name as category_name', 'product_categories.id as category_id')
            ->where('products.active',1)
            ->where('products.category_id', $id)
            ->orderBy('products.id', 'desc')
            ->orderBy('products.best_deal', 'desc')
            ->orderBy('products.best_seller', 'desc')
            ->paginate(80);
        $data['cid'] = $id;
        return view('fronts.product-by-category-list', $data);
    }

    public function product_by_category_list_view($id)
    {
        $data['products'] = DB::table('products')
            ->join('product_categories', 'product_categories.id', 'products.category_id')
            ->leftJoin('promotions',function ($join) {
                $join->on('promotions.product_id', '=' , 'products.id') ;
                $join->where('promotions.active','=',0) ;
            })
            ->select('products.name', 'products.id as p_id', 'products.short_description', 'products.price', 'promotions.discount', 'products.featured_image', 'product_categories.name as category_name', 'product_categories.id as category_id')
            ->where('products.active',1)
            ->where('products.category_id', $id)
            ->orderBy('products.id', 'desc')
            ->orderBy('products.best_deal', 'desc')
            ->orderBy('products.best_seller', 'desc')
            ->paginate(80);
        $data['cid'] = $id;
        return view('fronts.product-by-category-list-view', $data);
    }

    public function product_search(Request $r) {
    
        if(isset($r->product_name))
        {
            // dd(1);
            $data['products'] = DB::table('products')
            ->join('product_categories', 'product_categories.id', 'products.category_id')
            ->leftJoin('promotions',function ($join) {
                $join->on('promotions.product_id', '=' , 'products.id') ;
                $join->where('promotions.active','=',0) ;
            })
            ->select('products.name', 'products.id as p_id', 'products.price', 'promotions.discount', 'products.featured_image', 'product_categories.name as category_name')
            ->where('products.active',1)
            ->where('products.name', 'like', "%$r->product_name%")
            ->orWhere('products.description', 'like', "%$r->product_name%")
            ->orWhere('products.price', 'like', "%$r->product_name%")
            ->orWhere('products.short_description', 'like', "%$r->product_name%")
            ->orderBy('products.id', 'desc')
            ->orderBy('products.best_deal', 'desc')
            ->orderBy('products.best_seller', 'desc')
            ->paginate(80);
      
        }  elseif(isset($r->product_cat))
        {
            $data['products'] = DB::table('products')
            ->join('product_categories', 'product_categories.id', 'products.category_id')
            ->leftJoin('promotions',function ($join) {
                $join->on('promotions.product_id', '=' , 'products.id') ;
                $join->where('promotions.active','=',0) ;
            })
            ->select('products.name', 'products.id as p_id', 'products.price', 'promotions.discount', 'products.featured_image', 'product_categories.name as category_name')
            ->where('products.active',1)
            ->where('products.category_id', 'like', "%$r->product_cat%")
            ->orderBy('products.id', 'desc')
            ->orderBy('products.best_deal', 'desc')
            ->orderBy('products.best_seller', 'desc')
            ->paginate(80);
      
        } 
        elseif(isset($r->product_name) && isset($r->product_cat))
        {
            $data['products'] = DB::table('products')
            ->join('product_categories', 'product_categories.id', 'products.category_id')
            ->leftJoin('promotions',function ($join) {
                $join->on('promotions.product_id', '=' , 'products.id') ;
                $join->where('promotions.active','=',0) ;
            })
            ->select('products.name', 'products.id as p_id', 'products.price', 'promotions.discount', 'products.featured_image', 'product_categories.name as category_name')
            ->where('products.active',1)
            ->where('products.name', 'like', "%$r->product_name%")
            ->where('products.category_id', 'like', "%$r->product_cat%")
            ->orderBy('products.id', 'desc')
            ->orderBy('products.best_deal', 'desc')
            ->orderBy('products.best_seller', 'desc')
            ->paginate(80);
      
        }
        else{
            $data['products'] = DB::table('products')
                ->join('product_categories', 'product_categories.id', 'products.category_id')
                ->leftJoin('promotions',function ($join) {
                    $join->on('promotions.product_id', '=' , 'products.id') ;
                    $join->where('promotions.active','=',0) ;
                })
                ->select('products.name', 'products.id as p_id', 'products.price', 'promotions.discount', 'products.featured_image', 'product_categories.name as category_name', 'product_categories.id as category_id')
                ->where('products.active',1)
                ->orderBy('products.id', 'desc')
                ->orderBy('products.best_deal', 'desc')
                ->orderBy('products.best_seller', 'desc')
                ->paginate(80);
        }
        return view('fronts.product-search', $data);
    }
}
