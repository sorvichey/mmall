<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class MainMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // select self join company categories
        $data['menu_ones'] = DB::table('menu_ones')
            ->orderBy('id', 'desc')
            ->where('active',1)
            ->paginate(18);

        return view("main-menus.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("main-menus.create");
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
        $i = DB::table('menu_ones')->insertGetId($data);
        if($request->hasFile('icon'))
        {
            $file = $request->file('icon');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/menu-ones/'; // usually in public folder
            $file->move($destinationPath, $i.$file_name);
            $data['icon'] = $i.$file_name;
          
            $i = DB::table('menu_ones')->where('id', $i)->update($data);
        }
        if ($i)
        {
            $request->session()->flash("sms", "New Main menu has been created successfully!");
            return redirect("/admin/main-menu/create");
        } else {
            $request->session()->flash("sms1", "Fail to create new event category!");
            return redirect("/admin/main-menu/create")->withInput();
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
        $data['menu_one'] = DB::table('menu_ones')
            ->where('id', $id)
            ->first();
        return view("main-menus.edit", $data);
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
        if($request->hasFile('icon'))
        {
            $file = $request->file('icon');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/menu-ones/'; // usually in public folder
            $file->move($destinationPath, $request->id.$file_name);
            $data['icon'] = $request->id.$file_name;
        }
        $i = DB::table('menu_ones')->where("id", $request->id)->update($data);
        if($i)
        {
            $request->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/admin/main-menu/edit/". $request->id);
        } else {
            $request->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/admin/main-menu/edit/". $request->id);
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
        DB::table('menu_ones')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/main-menu?page='.$page);
        }
        return redirect('/admin/main-menu');
    }
}
