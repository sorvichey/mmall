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
                    <div itemprop="mainContentOfPage" class="entry-content">
                        <div id="yith-wcwl-messages"></div>
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tr>
                                    <th>No</th>
                                    <th>PRODUCT NAME</th>
                                    <th>PRICE</th>
                                    <th>Quantity</th>
                                    <th>AMOUNT</th>
                                    <th>ORDER DATE</th>
                                    <th>STATUS</th>
                                    <th>ACTIONS</th>
                                </tr>
                                @php $i= 1; @endphp
                                @foreach($my_orders as $order)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>
                                        <div class="col-sm-2">
                                        <img src="{{asset('uploads/products/180/'.$order->photo)}}" class="" class="img-responsive" alt="No Image" >
                                        </div>
                                        <div class="col-sm-10">
                                            {{$order->name}} <br>
                                            {{$order->order_number}} <br>
                                        </div>
                                    </td>
                                    <td>${{$order->price}}</td>
                                    <td>{{$order->quantity}}</td>
                                    <td>${{$order->amount}}</td>
                                    <td>{{$order->order_date}}</td>
                                    <td>
                                        @if($order->payment_status==1)
                                            {{$order->status_name}}
                                        @else
                                            {{'Unpaid'}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-xs btn-info"><span class="fa fa-eye"></span></a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>  
                    </div>
                </article>
            </main>
        </div>
    </div>
</div>
@endsection


