<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Intervention\Image\ImageManagerStatic as Image;

class AdminShopSubscriptionController extends Controller
{
  public function __construct()
  {
      // $this->middleware('auth');
  }
  //back end

  public function index() {
    $data['shops'] = DB::table('shops')
      ->join('product_categories', 'product_categories.id', 'shops.shop_category')
      ->join('shop_subscriptions', 'shop_subscriptions.shop_id', 'shops.id')
      ->join('subscription', 'subscription.id', 'shop_subscriptions.subscription_id')
      ->select('shops.name',
        'shops.phone',
        'shops.email' ,
        'shops.logo',
        'shops.active',
        'shops.phone',
        'product_categories.name as shop_category',
        'shops.id as id',
        'subscription.name as request_subscription',
        DB::raw("(SELECT name FROM subscription WHERE subscription.id = shops.subscription_id) as current_subscription")
      )
      ->where('shop_subscriptions.status', 0)
      ->orderBy('shops.id', 'desc')
      ->paginate(18);
    return view('shop-subscriptions.index', $data);
  }
       
  public function delete($id) {
      DB::table('subscription')->where('id', $id)->update(["active"=>0]);
      $page = @$_GET['page'];
      if ($page>0)
      {
          return redirect('/admin/subscription?page='.$page);
      }

      return redirect('/admin/subscription');
  }

  public function detail($id){
    $data['shops'] = DB::table('shops')
      ->join('shop_owners', 'shop_owners.id', 'shops.shop_owner_id')
      ->join('shop_categories', 'shop_categories.id', 'shops.shop_category')
      ->join('shop_subscriptions', 'shop_subscriptions.shop_id', 'shops.id')
      ->join('subscription', 'subscription.id', 'shop_subscriptions.subscription_id')
      ->select('shops.name',
        'shops.phone',
        'shops.email',
        'shops.logo',
        'shops.status',
        'shops.active',
        'shops.address',
        'shops.location',
        'shops.description as description',
        'shops.website',
        'shop_categories.name as shop_category',
        'subscription.name as subscription_name',
        'shop_owners.id as owner_id',
        'shops.id as id')
    ->orderBy('id', 'desc')
    ->first();
     return view('shop-subscriptions.detail', $data);
  }

  public function approve_subscription($id){
    $data = array(
        "status" => 1
    );

    $i = DB::table('shop_subscriptions')
          ->where("shop_id", $id)
          ->where("status", 0)
          ->first();
    if($i!=null){
      DB::table('shop_subscriptions')
          ->where("shop_id", $id)
          ->where("status", 0)
          ->update($data);

      $data_shop = array(
          "subscription_id" => $i->subscription_id
      );

      DB::table('shops')
            ->where("id", $id)
            ->update($data_shop);
        
      return redirect("/admin/shops/detail/".$id);
    }else{
      // $r->session()->flash('sms', 'New product has been create successfully!');
      return redirect("/admin/shop-subscription");

    }
        

  }

  public function save(Request $r){
    $data = array(
        "name" => $r->name,
        "price" => $r->price,
        "posted_product" => $r->product_post,
        "duration" => $r->duration,
        "active" => $r->status,
        "description" => $r->description,
    );
    $i = DB::table('subscription')->insert($data);
    if($i)
    {
        $r->session()->flash("sms", "New subscription has been created successfully!");
        return redirect("/admin/subscription/create");
    }
    else{
        $r->session()->flash("sms1", "Fail to create new subscription!");
        return redirect("/admin/subscription/create")->withInput();
    }
  }

  public function edit($id){
    $data['subscription'] = DB::table('subscription')->where('id', $id)->first();
     return view('subscriptions.edit', $data);
  }

  public function update(Request $r){
    $data = array(
        "name" => $r->name,
        "price" => $r->price,
        "posted_product" => $r->product_post,
        "duration" => $r->duration,
        "active" => $r->status,
        "description" => $r->description,
    );

    $i = DB::table('subscription')->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/admin/subscription/edit/".$r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/admin/subscription/edit/".$r->id);
        }
  }
}
