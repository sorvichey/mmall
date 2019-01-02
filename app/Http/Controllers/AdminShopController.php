<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Intervention\Image\ImageManagerStatic as Image;

class AdminShopController extends Controller
{
  public function __construct()
  {
      // $this->middleware('auth');
  }
  //back end

  public function index() {
        $data['shops'] = DB::table('shops')
        ->join('product_categories', 'product_categories.id','shops.shop_category')
        ->select('shops.*', 'product_categories.name as category')
        ->orderBy('id', 'desc')
        ->paginate(18);
    return view('shops.index', $data);
    }
  public function approve($id){
    $data = array(
        "active" => 1
    );

    $i = DB::table('shops')
          ->where("id", $id)
          ->where("active", 0)
          ->update($data);
      $page = @$_GET['page'];
    if ($page>0)
      {
          return redirect('/admin/shops?page='.$page);
      }
    return redirect("/admin/shops");
  }

  public function disable($id) {
      DB::table('shops')->where('id', $id)->update(["active"=>0]);
      $page = @$_GET['page'];
      if ($page>0)
      {
          return redirect('/admin/shops?page='.$page);
      }

      return redirect('/admin/shops');
  }

  public function detail($id){
    $data['shops'] = DB::table('shops')
      ->join('shop_owners', 'shop_owners.id', 'shops.shop_owner_id')
      ->join('product_categories', 'product_categories.id', 'shops.shop_category')
      ->select('shops.*',
        'product_categories.name as shop_category',
        'shops'
      )
    ->orderBy('id', 'desc')
    ->first();
     return view('shops.detail', $data);
  }
}
