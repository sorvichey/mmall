<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
class MenuOneController extends Controller
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

        return view("admin/menu-ones.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = DB::table('shop_categories')
            ->where('active', 1)
            ->get();
        return view("admin/menu-ones.create", $data);
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
            "shop_category_id" => $request->category,
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
            return redirect("/admin/menu-one/create");
        } else {
            $request->session()->flash("sms1", "Fail to create new event category!");
            return redirect("/admin/menu-one/create")->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save_sub1(Request $request)
    {
        // save data into company categories
        $data = array(
            "name" => $request->name,
            "menu_one_id" => $request->menu_one_id
        );
        $i = DB::table('menu_twos')->insertGetId($data);
      
        if ($i)
        {
            $request->session()->flash("sms", "New sub menu 1 has been created successfully!");
            return redirect("/admin/menu-one/edit/$request->menu_one_id");
        } else {
            $request->session()->flash("sms1", "Fail to create new sub menu 1 ");
            return redirect("/admin/menu-one/edit/$request->menu_one_id")->withInput();
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save_sub2(Request $request)
    {
        // save data into company categories
        $data = array(
            "name" => $request->name,
            "menu_two_id" => $request->menu_two_id
        );
        $i = DB::table('menu_threes')->insertGetId($data);
        if ($i)
        {
            $request->session()->flash("sms2", "New Sub Menu 2 has been created successfully!");
            return redirect("/admin/menu-two/edit/".$request->menu_two_id);
        } else {
            $request->session()->flash("sms3", "Fail to create new sub menu 2!");
            return redirect("/admin/menu-two/edit/".$request->menu_two_id)->withInput();
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
        $data['categories'] = DB::table('shop_categories')
        ->where('active', 1)
        ->get();
        $data['menu_one'] = DB::table('menu_ones')
            ->where('id', $id)
            ->first();
        $data['menu_twos'] = DB::table('menu_twos')
            ->where('menu_one_id', $id)
            ->orderBy('id', 'desc')
            ->where('active',1)
            ->paginate(18);
        return view("admin/menu-ones.edit", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_sub1($id)
    {
        $data['menu_two'] = DB::table('menu_twos')
            ->where('id', $id)
            ->first();
        $data['menu_threes'] = DB::table('menu_threes')
            ->where('menu_two_id', $id)
            ->orderBy('id', 'desc')
            ->where('active',1)
            ->paginate(18);
         
        return view("admin/menu-ones.edit-sub1", $data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_sub1(Request $request)
    {
        // update data into company categories
        $data = array(
            "name" => $request->name,
        );
        $i = DB::table('menu_twos')->where("id", $request->id)->update($data);
        if($i)
        {
            $request->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/admin/menu-two/edit/". $request->id);
        } else {
            $request->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/admin/menu-two/edit/". $request->id);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_sub2($id)
    {
        $data['menu_three'] = DB::table('menu_threes')
            ->where('id', $id)
            ->first();
         
        return view("admin/menu-ones.edit-sub2", $data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_sub2(Request $request)
    {
        // update data into company categories
        $data = array(
            "name" => $request->name,
        );
        $i = DB::table('menu_threes')->where("id", $request->id)->update($data);
        if($i)
        {
            $request->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/admin/menu-three/edit/". $request->id);
        } else {
            $request->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/admin/menu-three/edit/". $request->id);
        }
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
            "shop_category_id" => $request->category,
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
            return redirect("/admin/menu-one/edit/". $request->id);
        } else {
            $request->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/admin/menu-one/edit/". $request->id);
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
            return redirect('/admin/menu-one?page='.$page);
        }
        return redirect('/admin/menu-one');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_sub1($id, Request $r)
    {
       $i =  DB::table('menu_twos')->where('id', $id)->update(["active"=>0]);
        if($i)
        {
            $r->session()->flash("sms2", "Sub menu 1 has been deleted!");
            return redirect('/admin/menu-one/edit/'.$r->query('main_menu'));
        }
       
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_sub2($id, Request $r)
    {
       $i =  DB::table('menu_threes')->where('id', $id)->update(["active"=>0]);
        if($i)
        {
            $r->session()->flash("sms2", "Sub menu 2 has been deleted!");
            return redirect('/admin/menu-two/edit/'.$r->query('menu_two'));
        }
       
    }
}
