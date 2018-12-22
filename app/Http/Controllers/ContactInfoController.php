<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class ContactInfoController extends Controller
{
    public function __construct()
    {
       $this->middleware("auth");
    }
    // index
    public function index()
    {
        $data['contact_infos'] = DB::table('contact_infos')
            ->where('active', 1)
            ->get();
        return view('contact-infos.index', $data);
    }

    public function create()
    {
        return view('contact-infos.create');
    }

    public function save(Request $r)
    {
        $data = array(
            'address' => $r->address,
        );
        $i = DB::table('contact_infos')->insert($data);
        $sms = "The new contact info has been created successfully.";
        $sms1 = "Fail to create the new contact info, please check again!";
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/contact-info/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/contact-info/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        DB::table('contact_infos')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/contact-info?page='.$page);
        }

        return redirect('/admin/contact-info');
    }

    public function edit($id)
    {
        $data['contact_info'] = DB::table('contact_infos')
            ->where('id',$id)
            ->first();
        return view('contact-infos.edit', $data);
    }
    
    public function update(Request $r)
    {
        $data = array(
            'address' => $r->address,
        );

        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('contact_infos')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/contact-info/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/contact-info/edit/'.$r->id);
        }
    }
}

