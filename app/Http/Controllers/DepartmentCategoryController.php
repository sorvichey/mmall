<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class DepartmentCategoryController extends Controller
{
    public function __construct()
    {
       $this->middleware("auth");
    }
    // index
    public function index()
    {
        $data['department_categories'] = DB::table('department_categories')
            ->orderBy('id', 'desc')
            ->where('active', 1)
            ->get();
        return view('department-categories.index', $data);
    }

    public function create()
    {
        return view('department-categories.create');
    }

    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name,
        );
        $i = DB::table('department_categories')->insert($data);
        $sms = "The new department category has been created successfully.";
        $sms1 = "Fail to create the new department category, please check again!";
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/department-category/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/department-category/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        DB::table('department_categories')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/department-category?page='.$page);
        }

        return redirect('/admin/department-category');
    }

    public function edit($id)
    {
        $data['department_category'] = DB::table('department_categories')
            ->where('id',$id)
            ->first();
        return view('department-categories.edit', $data);
    }
    
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name,
        );

        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('department_categories')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/department-category/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/department-category/edit/'.$r->id);
        }
    }
}

