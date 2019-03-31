<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Auth;
class PaymentTypeController extends Controller
{
    public function __construct()
    {
       $this->middleware("auth");
    }
    // index
    public function index()
    {
        $data['payment_types'] = DB::table('payment_types')
            ->where('active',1)
            ->orderBy('id', 'desc')
            ->paginate(12);
        return view('admin/payment-types.index', $data);
    }
    public function create()
    {
        return view('admin/payment-types.create');
    }
    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'order' => $r->order,
            'url' => $r->url,
        );
        $i = DB::table('payment_types')->insertGetId($data);
        if($i) {
            if($r->photo) {
                $file = $r->file('photo');
                $file_name = $file->getClientOriginalName();
                $destinationPath = 'uploads/payment_types/';
                $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
                $file_name = $i . $ss;
                $file->move($destinationPath, $file_name);
                $i = DB::table('payment_types')->where('id', $i)->update(['photo' => $file_name]);
               
            }
        }
        $sms = "The new payment type has been created successfully.";
        $sms1 = "Fail to create the new payment type, please check again!";
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/payment-type/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/payment-type/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        DB::table('payment_types')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/payment-type?page='.$page);
        }

        return redirect('/admin/payment-type');
    }
    public function edit($id)
    {
        $data['payment_type'] = DB::table('payment_types')
            ->where('id',$id)->first();
        return view('admin/payment-types.edit', $data);
    }
    
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'order' => $r->order,
            'url' => $r->url,
        );
        
        if($r->photo) {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/payment_types/';
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = $r->id . $ss;
            $file->move($destinationPath, $file_name);
            $i = DB::table('payment_types')->where('id', $r->id)->update(['photo' => $file_name]);
        }

        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('payment_types')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/payment-type/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/payment-type/edit/'.$r->id);
        }
    }
}

