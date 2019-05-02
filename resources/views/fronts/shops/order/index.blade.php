@extends('layouts.owner')
@section('content')
    
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Product Order
                </div>
                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Customer</th>
                                        <th>Phone</th>
                                        <th>Delivery to</th>
                                        <th>Order Code</th>
                                        <th>Order Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                @php $i=1; @endphp
                                @foreach($orders as $order)
                                   <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$order->first_name}} {{$order->last_name}}</td>
                                        <td>{{$order->phone}}</td>
                                        <td>{{$order->delivery_address}}</td>
                                        <td>{{$order->order_number}}</td>
                                        <td>{{$order->created_at}}</td>
                                        <td>
                                            @if($order->payment_status==1)
                                                <span>{{$order->status_name}}</span>
                                            @else
                                                <span class="text-danger">Unpaid</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" title="Detail"><span class="fa fa-eye text-success"></span></a>
                                        </td>
                                   </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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