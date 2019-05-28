@extends('layouts.front')
@section('content')
<div tabindex="-1" class="site-content" id="content">
    <div class="container">
        <nav class="woocommerce-breadcrumb"><a href="{{url('/')}}">Home</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>
            My Order
        </nav>
        <div class="content-area" id="primary">
            <main class="site-main" id="main">
                <article class="page type-page status-publish hentry">
                    <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <!-- <th>No</th> -->
                                        <!-- <th>ORDER CODE</th> -->
                                        <th>PRODUCT</th>
                                        <th>QUANTITY</th>
                                        <th>PRICE</th>
                                        <th>DISCOUNT(%)</th>
                                        <th>AMOUNT</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1; @endphp
                                    @foreach($orders as $order)
                                    <tr>
                                        <!-- <td>{{$i++}}</td> -->
                                        <!-- <td>{{$order->order_code}}</td> -->
                                        <td>
                                            <div class="col-xs-2">
                                            @if($order->color!="")
                                            <img src="{{asset('uploads/colors/180/'.$order->color)}}" class="" class="img-responsive" alt="IMG" >
                                            @else
                                            <img src="{{asset('uploads/products/180/'.$order->color)}}" class="" class="img-responsive" alt="IMG" >
                                            @endif
                                            </div>
                                            <div class="col-xs-10">
                                                {{$order->name}}
                                                <br>
                                                @if($order->size!=""){
                                                    Size: {{$order->size}}
                                                }
                                                @endif
                                                
                                            </div>
                                        </td>
                                        <td>{{$order->quantity}}</td>
                                        <td>${{$order->price}}</td>
                                        <td>{{$order->discount}}</td>
                                        <td>${{$order->amount}}</td>
                                        <td>
                                            @if($order->order_status=="To Review")
                                                <a href="#" class="btn btn-xs btn-warning">Ready to Review</a>
                                            @else
                                            {{$order->order_status}}
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </article>
            </main>
        </div>
    </div>
</div>
@endsection


