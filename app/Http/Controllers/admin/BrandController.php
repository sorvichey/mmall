<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
class BrandController extends Controller
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
        $data['product_brands'] = DB::table('product_brands')
            ->where('active',1)
            ->orderBy('id', 'desc')
            ->paginate(18);
        return view('admin/brands.index', $data);
    }
    // load create form
    public function create()
    {
        return view('admin/brands.create');
    }
    // save new social
    public function save(Request $r)
    {
        $i = DB::table('product_brands')->where('name', $r->name)->where('active',1)->count();
        if($i>0) {
            $r->session()->flash('sms1', 'Fail to create new product. Your brand name maybe created');
            return redirect('/admin/brand/create')->withInput();
        } else {
            $data = [
                'name' => $r->name
            ];
        }
       
        $sms = "The new brand has been created successfully.";
        $sms1 = "Fail to create the new brand, please check again!";
        $i = DB::table('product_brands')->insertGetId($data);
        if($i)
        {
            if($r->hasFile('photo'))
            {
                $file = $r->file('photo');
                $file_name = $file->getClientOriginalName();
                $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
                $file_name = $i . $ss;
                
                $destinationPath = 'uploads/products/brands/';
                $new_img = Image::make($file->getRealPath())->resize(180, null, function ($con) {
                    $con->aspectRatio();
                });
                $new_img->save($destinationPath . $file_name, 80);

                DB::table('product_brands')->where('id', $i)->update(['icon'=>$file_name]);
            }

            $r->session()->flash('sms', $sms);
            return redirect('admin/brand/create');
        }
        else{
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/brand/craete')->withInput();
        }
    }

    public function edit($id)
    {   
        $data['brand'] = DB::table('product_brands')
            ->where('id',$id)->first();
        return view('admin/brands.edit', $data);
    }
    
    public function update(Request $r)
    {
        $data = [
            'name' => $r->name
        ];
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('product_brands')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/brand/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/brand/edit/'.$r->id);
        }
    }

    public function top(Request $r)
    {
        $sms = "All changes have been add brand to top successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('product_brands')->where('id', $r->id)->update(['top_brand'=> 1]);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/brand');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/brand');
        }
    }

    public function down(Request $r)
    {
        $sms = "All changes have been add brand to simple successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('product_brands')->where('id', $r->id)->update(['top_brand'=> 0]);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/brand');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/brand');
        }
    }

     // delete
     public function delete($id)
     {
        DB::table('product_brands')->where('id', $id)->update(['active'=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/brand?page='.$page);
        }

        return redirect('/admin/brand');
     }
}
