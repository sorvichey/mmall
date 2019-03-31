<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Auth;
class TrackingLocationController extends Controller
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
        $data['locations'] = DB::table('tracking_locations')
            ->orderBy('id', 'desc')
            ->paginate(12);
        return view('tracking-locations.index', $data);
    }
    // load create form
    public function create()
    {
        // if(!Right::check('Origin', 'i'))
        // {
        //     return view('permissions.no');
        // }
        return view('tracking-locations.create');
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
       
        $i = DB::table('tracking_locations')->insert($data);
        
        if($i)
        {
            $r->session()->flash('sms', 'New location has been created successfully!');
            return redirect('/admin/tracking-location/create');
        }
        else{
            $r->session()->flash('sms1', 'Fail to create new location. Please check your input again!');
            return redirect('/admin/tracking-location/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        // if(!Right::check('Origin', 'd'))
        // {
        //     return view('permissions.no');
        // }
        DB::table('tracking_locations')->where('id', $id)->delete();
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/tracking-location/?page='.$page);
        }
        return redirect('/admin/tracking-location');
    }

    public function edit($id)
    {
        // if(!Right::check('Page', 'u'))
        // {
        //     return view('permissions.no');
        // }
        $data['origin'] = DB::table('tracking_locations')
            ->where('id',$id)->first();
        return view('tracking-locations.edit', $data);
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
        $i = DB::table('tracking_locations')->where('id', $r->id)->update($data);
        if ($i)
        {
            $sms = "All changes have been saved successfully.";
            $r->session()->flash('sms', $sms);
            return redirect('/admin/tracking-location/edit/'.$r->id);
        }
        else
        {   
            $sms1 = "Fail to to save changes, please check again!";
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/tracking-location/edit/'.$r->id);
        }
    }
}
