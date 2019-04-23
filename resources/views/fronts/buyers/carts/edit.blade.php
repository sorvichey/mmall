@extends('layouts.front')
@section('content')
<div tabindex="-1" class="site-content" id="content">
    <div class="container">
        <nav class="woocommerce-breadcrumb">
            <a href="{{url('/')}}">Home</a>
            <span class=""><i class="fa fa-angle-right"></i></span>
            <a href="{{url('/buyer/mycart')}}">Add to Cart</a>
            <span class=""><i class="fa fa-angle-right"></i></span>
            edit
        </nav>
        <div class="content-area" id="primary">
            <main class="site-main" id="main">
                <article class="page type-page status-publish hentry">
                    <div itemprop="mainContentOfPage" class="entry-content">
                         @if(Session::has('sms'))
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div>
                                    {{session('sms')}}
                                </div>
                            </div>
                        @endif
                        
                        @if(Session::has('sms1'))
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div>
                                    {{session('sms1')}}
                                </div>
                            </div>
                        @endif

                        <div id="yith-wcwl-messages"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">Edit your item</div>
                                    <div class="card-body">
                                        <form action="{{url('/buyer/mycart/update')}}" method="post">
                                            {{csrf_field()}}
                                            <div class="form-group col-md-12">
                                                <label for="text">Product Name:</label>
                                                <input type="text" class="form-control" value="{{$cart->name}}" readonly style="background: #fff;">
                                            </div>

                                            <input type="hidden" name="cart_id" id="cart_id" value="{{ Crypt::encryptString($cart->cart_id) }}">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="quantity">Quantity:</label>
                                                    <input type="number" min="1" value="{{$cart->pro_qty}}" class="form-control" name="quantity" id="quantity" placeholder="Enter Quantity" name="quantity" style="line-height:1.5em;">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                            @if($colors!==null)
                                                <div class="form-group">
                                                    <label for="">Color:</label>
                                                    <select name="color" id="color" class="form-control" required>
                                                        <option value="">Please chose option below</option>
                                                        @foreach($colors as $color)
                                                            <option value="{{Crypt::encryptString($color->id)}}" {{ (Crypt::encryptString($color->id)==Crypt::encryptString($cart->id))?"selected":"" }}>{{$color->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                            </div>
                                            <div class="col-md-4">
                                            @if($sizes!==null)
                                                <div class="form-group">
                                                    <label for="">Size:</label>
                                                    <select name="size" id="size" class="form-control" >
                                                        <option value="">Please chose option below</option>
                                                        @foreach($sizes as $size)
                                                            <option value="{{Crypt::encryptString($size->id)}}" {{ (Crypt::encryptString($size->id)==Crypt::encryptString($cart->id))?"selected":"" }}>{{$size->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                                <!-- <br> -->
                                            </div>                               
                                            
                                            <button type="submit" name="btn_save" class="btn btn-success" style="margin-left:15px !important;">Save Change</button>
                                        </form>
                                    </div> 
                                </div>
                               
                                <hr>
                               
                            </div>
                        </div>
                    </div>
                </article>
            </main>
        </div>
    </div>
</div>
@endsection

