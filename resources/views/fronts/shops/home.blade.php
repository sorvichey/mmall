@extends('layouts.shop-admin')
@section('content')

<!-- Page Heading -->
<h3>Dashboard</h3>
<hr style="border: 1px solid blue;">
<!-- Content Row -->
<div class="row">

    <!-- Total products -->
    @php 
        $shop_id = Session::get("shop")->id;
        $products = DB::table('products')->where('active',1)->where('shop_id',$shop_id)->count();
    @endphp
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Products</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$products}}</div>
                </div>
                <div class="col-auto">
                <i class="fa fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- Ordering -->
    @php 
        $ordering = DB::table('orders')
        ->join('order_items','order_items.order_id','orders.id')
        ->join('products','products.id','order_items.product_id')
        ->where('orders.active',1)->where('order_items.active',1)
        ->where('order_status_id', '<' , 3)
        ->where('shop_id',$shop_id)->count();
    @endphp
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">PRODUCT ORDER</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$ordering}}</div>
                </div>
                <div class="col-auto">
                <i class="fa fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- Promotion -->
    @php 
        $promotions = DB::table('promotions')
        ->join('products','products.id','promotions.product_id')
        ->where('promotions.active',1)->where('shop_id',$shop_id)->count();
    @endphp
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">CURRENT PROMOTION</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$promotions}}</div>
                </div>
                <div class="col-auto">
                <i class="fa fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- Shipping -->
    @php 
        $shipping = DB::table('orders')
        ->join('order_items','order_items.order_id','orders.id')
        ->join('products','products.id','order_items.product_id')
        ->where('orders.active',1)->where('order_items.active',1)
        ->where('order_status_id', '>' , 2)
        ->where('shop_id',$shop_id)->count();
    @endphp
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">SHIPPING</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$shipping}}</div>
                </div>
                <div class="col-auto">
                <i class="fa fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
            </div>
        </div>
    </div>

</div>
<!-- ----------------------------------ROW 2---------------------------------- -->
<div class="row">

    <!-- Total products -->
    @php 
        $out_stock = DB::table('products')->where('active',1)
        ->where('quantity','<',10)
        ->where('shop_id',$shop_id)->count();
    @endphp
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Product Left (Out-stock)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$out_stock}}</div>
                </div>
                <div class="col-auto">
                <i class="fa fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
            </div>
        </div>
    </div>

   
</div>

@endsection
@section('js')

@endsection