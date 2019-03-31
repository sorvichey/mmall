<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Auth;
class SubPageController extends Controller
{
    public function __construct()
    {
       $this->middleware("auth");
    }
    // index
    public function index()
    {
        $data['sub_pages'] = DB::table('sub_pages')
            ->join('pages', 'pages.id', 'sub_pages.page_id')
            ->select('sub_pages.title as title', 'sub_pages.id as id', 'pages.title as page_name')
            ->where('sub_pages.active', 1)
            ->orderBy('sub_pages.id', 'desc')
            ->paginate(12);
        return view('admin/sub-pages.index', $data);
    }

    public function create()
    {
        $data['pages'] = DB::table('pages')
            ->where('active', 1)
            ->orderBy('id', 'desc')
            ->paginate(12);
        return view('admin/sub-pages.create', $data);
    }

    public function save(Request $r)
    {
        $data = array(
            'title' => $r->title,
            'description' => $r->description,
            'page_id' => $r->page_name
        );
        $i = DB::table('sub_pages')->insert($data);

        $sms = "The new sub-page has been created successfully.";
        $sms1 = "Fail to create the new sub-page, please check again!";
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/sub-page/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/sub-page/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        DB::table('sub_pages')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/sub-page?page='.$page);
        }

        return redirect('/admin/sub-page');
    }

    public function detail($id) {
        $data['sub_page'] = DB::table('sub_pages')
            ->join('pages', 'pages.id', 'sub_pages.page_id')
            ->select('sub_pages.title as title', 'sub_pages.id as id', 'pages.title as page_name', 'sub_pages.description as description')
            ->where('sub_pages.active', 1)
            ->orderBy('sub_pages.id', 'desc')
            ->first();
        return view('admin/sub-pages.view', $data);
    }

    public function edit($id)
    {
        $data['sub_page'] = DB::table('sub_pages')
            ->select('sub_pages.title as title', 'sub_pages.id as id', 'sub_pages.description as description', 'sub_pages.page_id' )
            ->where('sub_pages.active', 1)
            ->where('sub_pages.id',$id)
            ->first();
        $data['pages'] = DB::table('pages')
            ->where('active', 1)
            ->orderBy('id', 'desc')
            ->get();
        return view('admin/sub-pages.edit', $data);
    }
    
    public function update(Request $r)
    {
        $data = array(
            'title' => $r->title,
            'description' => $r->description,
            'page_id' => $r->page_name
        );
        

        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('sub_pages')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/sub-page/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/sub-page/edit/'.$r->id);
        }
    }
}

