<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Auth;
class SocialController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()==null)
            {
                return redirect("/login");
            }
            return $next($request);
        });
    }
    // index
    public function index()
    {
        $data['socials'] = DB::table('socials')
            ->where('active',1)
            ->orderBy('id', 'desc')
            ->paginate(12);
        return view('admin/socials.index', $data);
    }
    // load create form
    public function create()
    {
        return view('admin/socials.create');
    }
    // save new social
    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'url' => $r->url,
            'fa_fa_icon' => $r->fafa,
            'order' => $r->order
        );
        $sms = "The new social has been created successfully.";
        $sms1 = "Fail to create the new social, please check again!";
        $i = DB::table('socials')->insert($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/social/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/social/create')->withInput();
        }
    }

    public function edit($id)
    {   
        $data['social'] = DB::table('socials')
            ->where('id',$id)->first();
        return view('admin/socials.edit', $data);
    }
    
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'url' => $r->url,
            'fa_fa_icon' => $r->fafa,
            'order' => $r->order
        );
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('socials')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/social/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/social/edit/'.$r->id);
        }
    }

     // delete
     public function delete($id)
     {
        DB::table('socials')->where('id', $id)->update(['active'=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/social?page='.$page);
        }

        return redirect('/admin/social');
     }
}
