<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Auth;
class TrackingOriginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {
        // if(!Right::check('Origin', 'l'))
        // {
        //     return view('permissions.no');
        // }
        $data['origins'] = DB::table('tracking_origins')
            ->orderBy('id', 'desc')
            ->paginate(18);
        return view('tracking-origins.index', $data);
    }
    // load create form
    public function create()
    {
        // if(!Right::check('Origin', 'i'))
        // {
        //     return view('permissions.no');
        // }
        return view('tracking-origins.create');
    }
    // save new page
    public function save(Request $r)
    {
        // if(!Right::check('Origin', 'i'))
        // {
        //     return view('permissions.no');
        // }
        $data = array(
            'name' => $r->name,
        );
       
        $i = DB::table('tracking_origins')->insert($data);
        
        if($i)
        {
            $r->session()->flash('sms', 'New origin has been created successfully!');
            return redirect('/admin/tracking-origin/create');
        }
        else{
            $r->session()->flash('sms1', 'Fail to create new origin. Please check your input again!');
            return redirect('/admin/tracking-origin/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        // if(!Right::check('Origin', 'd'))
        // {
        //     return view('permissions.no');
        // }
        DB::table('tracking_origins')->where('id', $id)->delete();
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/tracking-origin/?page='.$page);
        }
        return redirect('/admin/tracking-origin');
    }

    public function edit($id)
    {
        // if(!Right::check('Page', 'u'))
        // {
        //     return view('permissions.no');
        // }
        $data['origin'] = DB::table('tracking_origins')
            ->where('id',$id)->first();
        return view('tracking-origins.edit', $data);
    }

    public function update(Request $r)
    {
        // if(!Right::check('Origin', 'u'))
        // {
        //     return view('permissions.no');
        // }
        $data = array(
            'name' => $r->name,
        );
        $i = DB::table('tracking_origins')->where('id', $r->id)->update($data);
        if ($i)
        {
            $sms = "All changes have been saved successfully.";
            $r->session()->flash('sms', $sms);
            return redirect('/admin/tracking-origin/edit/'.$r->id);
        }
        else
        {   
            $sms1 = "Fail to to save changes, please check again!";
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/tracking-origin/edit/'.$r->id);
        }
    }
}
