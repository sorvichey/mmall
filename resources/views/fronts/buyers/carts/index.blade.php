@extends('layouts.front')
@section('content')
<div tabindex="-1" class="site-content" id="content">
    <div class="container">
        <nav class="woocommerce-breadcrumb"><a href="{{url('/')}}">Home</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>
            My Cart
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
                        <div class="col-md-12">
                            <form action="{{url('buyer/product/order/create')}}" class="form-horizontal" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <button type="submit" name="btn_buy" id="btn_buy" class="btn btn-info ">Proceed To Checkout (<span id="number_selected">0</span>)</button>
                            </div>
                                <table class="table table-bordered">
                                    <tr>
                                        <td>No <input type="checkbox" id="select_all" /></td>
                                        <td>(@php echo count($carts); @endphp) PRODUCT NAME</td>
                                        <td>PRICE</td>
                                        <td>QUANTITY</td>
                                        <td>DISCOUNT</td>
                                        <td>AMOUNT</td>
                                    </tr>
                                    @php $i=1; @endphp
                                    @foreach($carts as $cart)
                                    <!-- <input type="hidden" name="cart[]" value="{{Crypt::encryptString($cart->cart_id)}}"> -->
                                    <tr>
                                        <td>
                                            @php echo $i++ @endphp 
                                            <input type="checkbox" name="selected_item[]" class="selected_item" value="{{Crypt::encryptString($cart->cart_id)}}">
                                            &nbsp;
                                            <a href="{{url('buyer/mycart/delete/')}}/{{Crypt::encryptString($cart->cart_id)}}" title="Remove"><span class='fa fa-trash text-danger'></span></a>
                                        </td>
                                        <td>
                                            <div class="col-sm-2">
                                                <img src="{{asset('uploads/products/180/'.$cart->photo)}}" class="" class="img-responsive" alt="No Image" >
                                            </div>
                                            <div class="col-sm-6">
                                                <i>Seller:</i> <br>
                                                Name:{{$cart->name}} <br>
                                                Color:  {{$cart->color}} <br>
                                                Size: {{$cart->size}} 
                                            </div>
                                        </td>
                                        <td>${{$cart->price}}</td>
                                        <td>
                                            <span id="qty">{{$cart->pro_qty}}</span> 
                                            <span class="btn btn-xs pull-right add_qty" id="{{Crypt::encryptString($cart->cart_id)}}">+</span>
                                            <span class="btn btn-xs pull-right sub_qty" id="{{Crypt::encryptString($cart->cart_id)}}">-</span>
                                        </td>
                                        <td>@if($cart->discount!=""){{$cart->discount}} @else 0 @endif%</td>
                                        <td>$ @if($cart->discount > 0)  {{number_format($cart->total_sales - ($cart->total_sales / 100 * $cart->discount) , 2)}} @else {{number_format($cart->total_sales , 2)}}@endif </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </form>
                        </div>
                    </div>
                </article>
            </main>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    var burl = "{{url('/')}}";

    // add quantity
    $('body').on('click', '.add_qty', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var action = " add"
        $.ajax({
            method: "POST",
            url: burl+"/buyer/mycart/update",
            data: 
            {
                "_token": "{{ csrf_token() }}",
                "id": id,
                "action": action 
            },
            success:function(data){
                $("#qty").text(data);
            }
        });
    });

    //sub quantity
    $('body').on('click', '.sub_qty', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var action = "sub";
        $.ajax({
            method: "POST",
            url: burl+"/buyer/mycart/update",
            data: 
            {
                "_token": "{{ csrf_token() }}",
                "id": id,
                "action": action 
            },
            success:function(data){
                $("#qty").text(data);
            }
        });
    });

    //select items
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.selected_item').each(function(){
                this.checked = true;
                var countCheckedCheckboxes = $('td input[class="selected_item"]').filter(':checked').length;
                $("#number_selected").text(countCheckedCheckboxes);
            });
        }else{
             $('.selected_item').each(function(){
                this.checked = false;
                $("#number_selected").text('0');
            });
        }
    });
    
    $('.selected_item').on('click',function(){
        if($('.selected_item:checked').length == $('.selected_item').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });

    //count checked checkbox
    var $checkboxes = $('td input[class="selected_item"]');

    $checkboxes.change(function(){
        var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
        // var selected = countCheckedCheckboxes
        // if(selected>0){}
        $("#number_selected").text(countCheckedCheckboxes);
        
    });
</script>
@endsection

