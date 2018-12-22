<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class FrontPageController extends Controller
{
    public function page($id)
    {
        $data['page'] = DB::table('pages')
            ->where('id', $id)
            ->where('active', 1)
            ->first();
        return view("fronts.page", $data);
    }
   
}
