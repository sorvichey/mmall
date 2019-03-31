<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ShopCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // select self join company categories
        $data['categories'] = DB::table('shop_categories as a')
            ->where('a.active',1)
            ->paginate(18);

        return view("admin/shop-categories.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view("admin/shop-categories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        // save data into company categories
        $data = array(
            "name" => $request->name,
        );
        $i = DB::table('shop_categories')->insertGetId($data);
       
        if ($i)
        {
            $request->session()->flash("sms", "New shop category has been created successfully!");
            return redirect("/admin/shop-category/create");
        } else {
            $request->session()->flash("sms1", "Fail to create new shop category!");
            return redirect("/admin/shop-category/create")->withInput();
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['category'] = DB::table('shop_categories')
            ->where('id', $id)
            ->first();
        return view("admin/shop-categories.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // update data into company categories
        $data = array(
            "name" => $request->name,
        );
       
        $i = DB::table('shop_categories')->where("id", $request->id)->update($data);
        if($i)
        {
            $request->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/admin/shop-category/edit/". $request->id);
        } else {
            $request->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/admin/shop-category/edit/". $request->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('shop_categories')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/shop-category?page='.$page);
        }
        return redirect('/admin/shop-category');
    }
}
