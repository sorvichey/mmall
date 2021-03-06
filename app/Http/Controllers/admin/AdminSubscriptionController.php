<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Intervention\Image\ImageManagerStatic as Image;

class AdminSubscriptionController extends Controller
{
  public function __construct()
  {
      // $this->middleware('auth');
  }
  //back end

  public function index() {
    $data['subscriptions'] = DB::table('subscription')
      ->orderBy('id', 'desc')
      ->paginate(18);
    return view('admin/subscriptions.index', $data);
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
    $data['subscription'] = DB::table('subscription')->where('id', $id)->first();
     return view('admin/subscriptions.detail', $data);
  }

  public function create(){
    // $data['subscription'] = DB::table('subscription')->where('id', $id)->first();
     return view('admin/subscriptions.create');
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
     return view('admin/subscriptions.edit', $data);
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
