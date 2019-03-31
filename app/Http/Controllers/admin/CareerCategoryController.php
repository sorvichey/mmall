<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Auth;
class CareerCategoryController extends Controller
{
    public function __construct()
    {
       $this->middleware("auth");
    }
    // index
    public function index()
    {
        $data['career_categories'] = DB::table('career_categories')
            ->orderBy('id', 'desc')
            ->where('active', 1)
            ->get();
        return view('admin/career-categories.index', $data);
    }

    public function create()
    {
        return view('admin/career-categories.create');
    }

    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name,
        );
        $i = DB::table('career_categories')->insert($data);
        $sms = "The new career category has been created successfully.";
        $sms1 = "Fail to create the new career category, please check again!";
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/career-category/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/career-category/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        DB::table('career_categories')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/career-category?page='.$page);
        }

        return redirect('/admin/career-category');
    }

    public function edit($id)
    {
        $data['career_category'] = DB::table('career_categories')
            ->where('id',$id)
            ->first();
        return view('admin/career-categories.edit', $data);
    }
    
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name,
        );

        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('career_categories')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/career-category/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/career-category/edit/'.$r->id);
        }
    }
}

