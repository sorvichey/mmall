@extends('layouts.shop-admin')
@section('content')
<!-- Page Heading -->
<h3>Product Orders</h3>
<hr style="border: 1px solid blue;">
    <div class="row">
        <div class="col-md-12">
            <div class="float-right">
                <form action="{{url('/owner/product/order')}}" class="form-inline" method="get">
                    <div class="form-group">
                        <label for="name">Search&nbsp;&nbsp;</label>
                        <input type="text" class="form-control" id="q" name="q" value="" >
                        <button type="submit"   class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
                    </div>
                </form>
                <br>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>&numero;</th>
                            <th>ORDER CODE</th>
                            <th>ORDER BY</th>
                            <th>ORDERED DATE</th>
                            <th>PAYMENT METHOD</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>   
                    <tbody>
                    <?php
                        $pagex = @$_GET['page'];
                        if(!$pagex)
                            $pagex = 1;
                        $i = 20 * ($pagex - 1) + 1;
                    ?>
                    @php $i=1; @endphp
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$order->order_code}}</td>
                            <td>{{$order->first_name." ".$order->last_name}}</td>
                            <td>{{$order->order_date}}</td>
                            <td>{{$order->payment_type}}</td>
                            <td>{{$order->order_status}}</td>
                            <td>
                                <a href="{{url('owner/product/order/edit/'.base64_encode($order->id))}}" class="btn btn-xs text-success" title="Edit">
                                    <span class="fa fa-edit"></span>
                                </a>
                                <a href="{{url('owner/product/order/detail/'.base64_encode($order->id))}}" class="btn btn-xs text-info" title="Detial">
                                    <span class="fa fa-eye"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <nav>
                    {{$orders->links()}}
                </nav>
            </div>
        </div>
    </div>

@endsection
@section('js')
   <script type="text/javascript">

        $(document).ready(function () {
            $("#shop-menu li a").removeClass("active");
            $("#ordering").addClass("active");
        });
       
    </script>
@endsection