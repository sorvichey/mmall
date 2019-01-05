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
      ->join('product_categories', 'product_categories.id','shops.shop_category')
      ->join('shop_owners', 'shop_owners.id', 'shops.shop_owner_id')
      ->select('shops.*', 'product_categories.name as category', 'shop_owners.first_name', 'shop_owners.last_name')
      ->where('shops.id', $id)
      ->first();

    $data['subscriptions'] = DB::table('subscription')
      ->join('shop_subscriptions', 'shop_subscriptions.subscription_id', 'subscription.id')
      ->select(
        'subscription.name',
        'shop_subscriptions.status',
        'shop_subscriptions.created_at',
        'shop_subscriptions.subscription_id',
        DB::raw("(SELECT shops.subscription_id  FROM shops WHERE subscription.id = shops.subscription_id) as current_subscription")
        )
      ->where('shop_subscriptions.shop_id', $id)
      ->orderBy('shop_subscriptions.created_at', 'desc')
      ->get();

    return view('shops.detail', $data);
  }
}
