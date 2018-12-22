<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class PageController extends Controller
{
    public function __construct()
    {
       $this->middleware("auth");
    }
    // index
    public function index()
    {
        $data['pages'] = DB::table('pages')
            ->where('active',1)
            ->orderBy('id', 'desc')
            ->paginate(12);
        return view('pages.index', $data);
    }

    public function create()
    {
        return view('pages.create');
    }

    public function save(Request $r)
    {
        $data = array(
            'title' => $r->title,
            'description' => $r->description,
        );
        $i = DB::table('pages')->insertGetId($data);
        if($i) {
            if($r->photo) {
                $file = $r->file('photo');
                $file_name = $file->getClientOriginalName();
                $destinationPath = 'uploads/pages/';
                $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
                $file_name = $i . $ss;
                $file->move($destinationPath, $file_name);
                DB::table('pages')->where('id', $i)->update(['photo' => $file_name]);
            }
        }
        $sms = "The new page has been created successfully.";
        $sms1 = "Fail to create the new page, please check again!";
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/page/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/page/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        DB::table('pages')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/page?page='.$page);
        }

        return redirect('/admin/page');
    }

    public function detail($id) {
        $data['page'] = DB::table('pages')
            ->where('id',$id)
            ->first();
        return view('pages.view', $data);
    }

    public function edit($id)
    {
        $data['page'] = DB::table('pages')
            ->where('id',$id)
            ->first();
        return view('pages.edit', $data);
    }
    
    public function update(Request $r)
    {
        $data = array(
            'title' => $r->title,
            'description' => $r->description,
        );
        if($r->photo) {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/pages/';
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = $r->id . $ss;
            $file->move($destinationPath, $file_name);
            DB::table('pages')->where('id', $r->id)->update(['photo' => $file_name]);
        }

        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('pages')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/page/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/page/edit/'.$r->id);
        }
    }
}

