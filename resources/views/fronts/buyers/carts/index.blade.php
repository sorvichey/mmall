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
                        <div class="col-md-7">
                            <table class="table table-bordered">
                                <tr>
                                    <td>ITEMS</td>
                                </tr>
                                @foreach($carts as $cart)
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img src="{{asset('uploads/products/180/'.$cart->photo)}}" class="" class="img-responsive" alt="No Image" >
                                            </div>
                                            <div class="col-md-6">
                                                
                                                <p>Name: {{$cart->name}}</p>
                                                <p>Color: {{$cart->color}}</p>
                                                <p>Size: {{$cart->size}}</p>
                                                <p>Quantity: {{$cart->pro_qty}}</p>
                                                <p>Price: {{number_format($cart->price , 2)}} $</p>
                                                <p>Discount: @if($cart->discount!=""){{$cart->discount}} @else 0 @endif%</p>
                                                <p>Total:  @if($cart->discount > 0)  {{number_format($cart->total_sales - ($cart->total_sales / 100 * $cart->discount) , 2)}} @else {{number_format($cart->total_sales , 2)}}@endif $</p>
                                            </div>
                                            <div class="col-md-2">
                                                <a href="{{url('/buyer/mycart/edit/'.Crypt::encryptString($cart->cart_id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                                <a href="{{url('/buyer/mycart/delete/'.Crypt::encryptString($cart->cart_id))}}" onclick="return confirm('Are you sure, you want to remove the item?')" class="btn btn-danger btn-xs"><i class="fa fa-minus"></i></a> 
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col-md-5">
                            <form action="{{url('buyer/product/order/create')}}" class="form-horizontal" method="post">
                                {{csrf_field()}}
                                <table class="table table-bordered">
                                    <tr>
                                        <td colspan="3"><b>ORDER SUMARY</b></td>
                                    </tr>
                                    <tr>
                                        <td>Item Name</td>
                                        <td>Quantity</td>
                                        <td>Price X Discount</td>
                                    </tr>
                                    <?php $total = 0; ?>
                                    @foreach($carts as $cart)
                                        <input type="hidden" name="cart[]" value="{{Crypt::encryptString($cart->cart_id)}}">
                                    <tr>
                                        <td>
                                            {{$cart->name}}
                                        </td>
                                        <td>
                                            {{$cart->pro_qty}}
                                        </td>
                                        <td>
                                            <?php 
                                                if($cart->discount > 0){
                                                   echo number_format($cart->total_sales - ($cart->total_sales / 100 * $cart->discount),2 )."$";
                                                }else{
                                                   echo number_format($cart->total_sales , 2)."$";
                                                }

                                                if($cart->discount > 0){
                                                    $total += number_format($cart->total_sales - ($cart->total_sales / 100 * $cart->discount),2 );
                                                }else{
                                                   $total +=  number_format($cart->total_sales , 2);
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                      
                                    @endforeach
                                    <tr>
                                        <td colspan="2" align="right">
                                            SUB-TOTAL:
                                        </td>
                                        <td>
                                            {{$total}} $
                                        </td>
                                    </tr>
                                </table>
                                <button class="btn btn-success">ORDER NOW</button>
                            </form>
                        </div>
                    </div>
                </article>
            </main>
        </div>
    </div>
</div>
@endsection

