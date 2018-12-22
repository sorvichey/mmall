<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class PhoneSupportController extends Controller
{
    public function __construct()
    {
       $this->middleware("auth");
    }
    // index
    public function index()
    {
        $data['phone_support'] = DB::table('phone_support')
            ->get();
        return view('phone-supports.index', $data);
    }

    public function edit($id)
    {
        $data['phone_support'] = DB::table('phone_support')
            ->where('id',$id)
            ->first();
        return view('phone-supports.edit', $data);
    }
    
    public function update(Request $r)
    {
        $data = array(
            'phone' => $r->phone,
        );

        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('phone_support')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/phone-support/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/phone-support/edit/'.$r->id);
        }
    }
}

