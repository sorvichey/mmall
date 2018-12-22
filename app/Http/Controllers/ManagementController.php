<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view("products.home");
    }
    public function customer()
    {
        return view("customers.home");
    }
    public function career()
    {
        return view("careers.home");
    }
    public function tracking()
    {
        return view("trackings.home");
    }
}
