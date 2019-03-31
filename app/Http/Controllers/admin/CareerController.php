<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Auth;
use Datetime;
class CareerController extends Controller
{
    public function __construct()
    {
       $this->middleware("auth");
    }
    // index
    public function index()
    {
        $data['careers'] = DB::table('careers')
            ->join('career_categories', 'career_categories.id', 'careers.career_category_id')
            ->join('department_categories', 'department_categories.id', 'careers.department_id')
            ->where('careers.active',1)
            ->orderBy('careers.id', 'desc')
            ->select('careers.*', 'careers.id as id', 'career_categories.name as category', 'department_categories.name as department')
            ->paginate(18);
        return view('admin/careers.index', $data);
    }
    public function create()
    {
        $data['career_categories'] = DB::table('career_categories')
            ->orderBy('name', 'asc')
            ->where('active', 1)
            ->get();

        $data['department_categories'] = DB::table('department_categories')
            ->orderBy('name', 'asc')
            ->where('active', 1)
            ->get();

        $data['career_locations'] = DB::table('career_locations')
            ->orderBy('name', 'asc')
            ->where('active', 1)
            ->get();

        return view('admin/careers.create', $data);
    }
    public function save(Request $r)
    {
        $data = array(
            'key_position' => $r->position,
            'short_description' => $r->short_description,
            'description' => $r->description,
            'dateline' => $r->dateline,
            'department_id' => $r->department,
            'type' => $r->type,
            'hire' => $r->hire,
            'career_category_id' => $r->category,
            'requirement' => $r->requirement,
            'gender' => $r->gender,
            'post_by' => Auth::user()->id,
        );
        $date = new Datetime('now');
        $get_date_time = $date->format('d-m-Y').'-'.$date->format('H-i-s');

        $i = DB::table('careers')->insertGetId($data);

        foreach($r->location as $location) {
            DB::table('career_locations_r_careers')->insert(['name'=> $location, 'career_id'=> $i]);
        }
        
        if($i) {
            if($r->document) {
                $file = $r->file('document');
                $file_name = $file->getClientOriginalName();
                $destinationPath = 'uploads/documents/';
                $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
                $file_name = 'career-'.$get_date_time.'-'.$i.$ss;
                $file->move($destinationPath, $file_name);
                $i = DB::table('careers')->where('id', $i)->update(['document' => $file_name]);
               
            }
        }
        $sms = "The new career has been created successfully.";
        $sms1 = "Fail to create the new career, please check again!";
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/career/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/career/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        DB::table('careers')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/career?page='.$page);
        }
        return redirect('/admin/career');
    }

    public function detail($id)
    {
        $data['career'] = DB::table('careers')
            ->join('career_categories', 'career_categories.id', 'careers.career_category_id')
            ->join('department_categories', 'department_categories.id', 'careers.department_id')
            ->where('careers.active',1)
            ->orderBy('careers.id', 'desc')
            ->where('careers.id', $id)
            ->select('careers.*', 'careers.id as id', 'career_categories.name as category', 'department_categories.name as department')
            ->first();

        return view('admin/careers.detail', $data);
    }

    public function edit($id)
    {
        $data['career_categories'] = DB::table('career_categories')
            ->orderBy('name', 'asc')
            ->where('active', 1)
            ->get();

        $data['department_categories'] = DB::table('department_categories')
            ->orderBy('name', 'asc')
            ->where('active', 1)
            ->get();

        $data['career_locations'] = DB::table('career_locations')
            ->orderBy('name', 'asc')
            ->where('active', 1)
            ->get();

        $data['career'] = DB::table('careers')
            ->join('career_categories', 'career_categories.id', 'careers.career_category_id')
            ->join('department_categories', 'department_categories.id', 'careers.department_id')
            ->where('careers.active',1)
            ->where('careers.id', $id)
            ->select('careers.*', 'careers.id as id', 'career_categories.name as category', 'department_categories.name as department')
            ->first();
        return view('admin/careers.edit', $data);
    }
    
    public function update(Request $r)
    {
        $data = array(
            'key_position' => $r->position,
            'short_description' => $r->short_description,
            'description' => $r->description,
            'dateline' => $r->dateline,
            'department_id' => $r->department,
            'type' => $r->type,
            'hire' => $r->hire,
            'career_category_id' => $r->category,
            'requirement' => $r->requirement,
            'gender' => $r->gender,
            'post_by' => Auth::user()->id,
        );
        if($r->document) {
            $file = $r->file('document');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/documents/';
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'career-'.$get_date_time.'-'.$i.$ss;
            $file->move($destinationPath, $file_name);
            $i = DB::table('careers')->where('id', $i)->update(['document' => $file_name]);
           
        }
     
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        DB::table('career_locations_r_careers')->where('career_id', $r->id)->update(["active"=>0]);
        foreach($r->location as $location) {
            $s = DB::table('career_locations_r_careers')->insert(['name'=> $location, 'career_id'=> $r->id]);
        }
        
        $i = DB::table('careers')->where('id', $r->id)->update($data);
        if ($i or $s)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/career/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/career/edit/'.$r->id);
        }
    }
}

