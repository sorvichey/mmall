<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use App\Http\Controllers\Right;
use Intervention\Image\ImageManagerStatic as Image;
class OwnerMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
           app()->setLocale(Session::get("lang"));
            return $next($request);
        });
    }
    // index
    public function index()
    {
        return view("fronts.shops.messages.index");
    }
}
