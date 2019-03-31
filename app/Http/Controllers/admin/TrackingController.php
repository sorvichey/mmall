<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Auth;
class TrackingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {
        // if(!Right::check('Tracking', 'l'))
        // {
        //     return view('permissions.no');
        // }
        $data['query']= "";
        if(isset($_GET['q']))
        {
            $data['query'] = $_GET['q'];
            $data['trackings'] = DB::table('tracking')
                ->where('tracking.active', 1)
                ->orderBy('tracking.id', 'desc')
                ->where(function($fn){
                    $fn->where('tracking.waybill', 'like', "%{$_GET['q']}%");
                    $fn->orWhere('tracking.status', 'like', "%{$_GET['q']}%");
                })
                ->paginate(200);
        }
        else{ 
        $data['trackings'] = DB::table('tracking')
            ->where('active', 1)
            ->orderBy('id', 'desc')
            ->paginate(12);
        }
        return view('trackings.index', $data);
    }
    // load create form
    public function create()
    {
        // if(!Right::check('Tracking', 'i'))
        // {
        //     return view('permissions.no');
        // }

        $data['origin'] = DB::table('tracking_origins')
            ->orderBy('name')
            ->get();
        $data['status'] = DB::table('tracking_status')
            ->orderBy('name')
            ->get();
        $data['destination'] = DB::table('tracking_destinations')
            ->orderBy('name')
            ->get();
        return view('trackings.create', $data);
    }
    // save new page
    public function save(Request $r)
    {
        // if(!Right::check('Tracking', 'i'))
        // {
        //     return view('permissions.no');
        // }
        $cwaybill = DB::table('tracking')->where('waybill',$r->waybill)->count();
        if($cwaybill == 0) {
            $data = array(
                'waybill' => $r->waybill,
                'destination' => $r->destination,
                'origin' => $r->origin,
                'status' => $r->status,
                'datetime' => $r->datetime,
                'pcs' => $r->pcs,
                'receiver' => $r->recever,
            );
            $i = DB::table('tracking')->insert($data);
            $r->session()->flash('sms', 'New tracking has been created successfully!');
            return redirect('/admin/tracking/create');
        } else {
            $r->session()->flash('sms1', 'Fail to create new tracking.  Please check your input again!');
            return redirect('/admin/tracking/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        // if(!Right::check('Tracking', 'd'))
        // {
        //     return view('permissions.no');
        // }
        DB::table('tracking')->where('id', $id)->update(['active'=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/tracking/?page='.$page);
        }
        return redirect('/admin/tracking');
    }

    public function sub_tracking_delete($id, Request $r)
    {
        // if(!Right::check('Page', 'd'))
        // {
        //     return view('permissions.no');
        // }
        DB::table('sub_tracking')->where('id', $id)->update(['active'=>0]);

        return redirect('/admin/tracking/detail/'. $r->query('tracking_id'));
    }

    public function edit($id)
    {
        // if(!Right::check('Tracking', 'u'))
        // {
        //     return view('permissions.no');
        // }
        $data['origin'] = DB::table('tracking_origins')
        ->orderBy('name')
        ->get();
    $data['status'] = DB::table('tracking_status')
        ->orderBy('name')
        ->get();
    $data['destination'] = DB::table('tracking_destinations')
        ->orderBy('name')
        ->get();
        $data['tracking'] = DB::table('tracking')
            ->where('active', 1)
            ->where('id',$id)
            ->first();
        return view('trackings.edit', $data);
    }

    public function update(Request $r)
    {
        // if(!Right::check('Tracking', 'u'))
        // {
        //     return view('permissions.no');
        // }
        $data = array(
            'waybill' => $r->waybill,
            'destination' => $r->destination,
            'origin' => $r->origin,
            'status' => $r->status,
            'datetime' => $r->datetime,
            'pcs' => $r->pcs,
            'receiver' => $r->receiver
        );
        $i = DB::table('tracking')->where('id', $r->id)->update($data);
        if ($i)
        {
            $sms = "All changes have been saved successfully.";
            $r->session()->flash('sms', $sms);
            return redirect('/admin/tracking/edit/'.$r->id);
        }
        else
        {   
            $sms1 = "Fail to to save changes, please check again!";
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/tracking/edit/'.$r->id);
        }
    }
    // view detail
    public function view($id) 
    {
        // if(!Right::check('Tracking', 'l'))
        // {
        //     return view('permissions.no');
        // }
        $data['status'] = DB::table('tracking_status')
            ->orderBy('name')
            ->get();
        $data['locations'] = DB::table('tracking_locations')
            ->orderBy('name')
            ->get();
        $data['tracking'] = DB::table('tracking')
            ->where('active', 1)
            ->where('id',$id)
            ->first();
        return view('trackings.detail', $data);
    }
     // save new page
     public function sub_tracking_save(Request $r)
    {
        // if(!Right::check('Tracking', 'i'))
        // {
        //     return view('permissions.no');
        // }
        $data = array(
            'location' => $r->location,
            'tracking_id' => $r->id,
            'datetime' => $r->datetime,
            'status' => $r->status,
            'note' => $r->note
        );
        $i = DB::table('sub_tracking')->insert($data);
        DB::table('tracking')->where('id', $r->id) ->where('active',1)->update(['datetime' => $r->datetime, 'status' => $r->status]);
        if($i)
        {
            $r->session()->flash('sms', 'New Sub tracking has been created successfully!');
            return redirect('admin/tracking/detail/'.$r->id);
        }
        else{
            $r->session()->flash('sms1', 'Fail to create new tracking. Please check your input again!');
            return redirect('/admin/tracking/detail/'.$r->id)->withInput();
        }
     }
}

