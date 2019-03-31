<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Auth;
class CareerLocationController extends Controller
{
    public function __construct()
    {
       $this->middleware("auth");
    }
    // index
    public function index()
    {
        $data['career_locations'] = DB::table('career_locations')
            ->orderBy('id', 'desc')
            ->where('active', 1)
            ->get();
        return view('admin/career-locations.index', $data);
    }

    public function create()
    {
        return view('admin/career-locations.create');
    }

    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name,
        );
        $i = DB::table('career_locations')->insert($data);
        $sms = "The new career location has been created successfully.";
        $sms1 = "Fail to create the new career location, please check again!";
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/career-location/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/career-location/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        DB::table('career_locations')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/career-location?page='.$page);
        }

        return redirect('/admin/career-location');
    }

    public function edit($id)
    {
        $data['career_location'] = DB::table('career_locations')
            ->where('id',$id)
            ->first();
        return view('admin/career-locations.edit', $data);
    }
    
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name,
        );

        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('career_locations')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/career-location/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/career-location/edit/'.$r->id);
        }
    }
}

