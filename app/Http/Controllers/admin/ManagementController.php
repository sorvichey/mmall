<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view("home");
    }
    public function product()
    {
        return view("admin/products.home");
    }
    public function customer()
    {
        return view("admin/customers.home");
    }
    public function career()
    {
        return view("admin/careers.home");
    }
    public function tracking()
    {
        return view("admin/trackings.home");
    }
}
