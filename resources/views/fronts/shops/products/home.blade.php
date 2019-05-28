@extends('layouts.shop-admin')
@section('content')
<?php $total_products = DB::table('products')->where('active', 1)->get();?>
<?php $total_brands = DB::table('product_brands')->where('active', 1)->get();?>
<?php $total_categories = DB::table('product_categories')->where('active', 1)->get();?>
<div class="container px-0">
    <div class="row">
        <div class="col-sm-12">
            <div class="card bg-secondary">
                <div class="card-body">
                    <small class="card-title">Total Products</small><hr>
                    <div class="col-md-12">
                        <div class="row">
                            <h4>{{count($total_products)}}</h4>&nbsp;&nbsp;&nbsp;<a href="{{url('admin/product')}}" class="btn btn-secondary">View List</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card bg-secondary">
                        <div class="card-body">
                            <small class="card-title">Total Brand</small><hr>
                            <div class="col-md-12">
                                <div class="row">
                                    <h4>{{count($total_brands)}}</h4>&nbsp;&nbsp;&nbsp;<a href="{{url('admin/brand')}}" class="btn btn-secondary">View List</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-secondary">
                        <div class="card-body">
                            <small class="card-title">Total Product Caregory</small><hr>
                            <div class="col-md-12">
                                <div class="row">
                                    <h4>{{count($total_categories)}}</h4>&nbsp;&nbsp;&nbsp;<a href="{{url('admin/product-category')}}" class="btn btn-secondary">View List</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection