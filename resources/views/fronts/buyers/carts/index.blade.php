@extends('layouts.front')
@section('content')
<div tabindex="-1" class="site-content" id="content">
    <div class="container">
        <nav class="woocommerce-breadcrumb"><a href="{{url('/')}}">Home</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>
            Add to Cart
        </nav>
        <div class="content-area" id="primary">
            <main class="site-main" id="main">
                <article class="page type-page status-publish hentry">
                    <div itemprop="mainContentOfPage" class="entry-content">
                        <div id="yith-wcwl-messages"></div>
                        <form action="" method="">
                            <button class="btn btn-warning">&nbsp; &nbsp; &nbsp; &nbsp; Buy Selected Item(s)&nbsp; &nbsp; &nbsp; &nbsp; </button>
                            <br>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th width="10"><input type="checkbox" name=""></th>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th width="100">Quantity</th>
                                            <th>Discount</th>
                                            <th width="150">Price/Unit</th>
                                            <th>Total</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i =1; ?>
                                        @foreach($carts as $cart)
                                        <tr>
                                            <td width="5">{{$i++}}</td>
                                            <td width="5"><input type="checkbox" name="checkbox[]"></td>
                                            <td width="30"><img src="{{asset('uploads/products/180/'.$cart->photo)}}" class="" class="img-responsive" alt="No Image" ></td>
                                            <td>{{$cart->name}}</td>
                                            <td><input type="number" name="quantity[]" value="{{$cart->pro_qty}}" class="form-control" required></td>
                                            <td align="center">@if($cart->discount!=""){{$cart->discount}} @else 0 @endif% </td>
                                            <td>$ {{$cart->price}}</td>
                                            <td>$ @if($cart->discount > 0)  {{$cart->total_sales - ($cart->total_sales / 100 * $cart->discount) }} @else {{$cart->total_sales}}@endif</td>
                                            <td>
                                                <a href="#" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </article>
            </main>
        </div>
    </div>
</div>
@endsection

