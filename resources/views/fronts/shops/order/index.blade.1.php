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
                                        <th>Customer Name</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                    @if(count($buyers) > 0)
                                        @php $i = 0 @endphp 
                                        @foreach($buyers as $buyer)
                                            <!-- get data order for each buyer  -->
                                            @php 
                                                $total_qty = 0; 
                                                $total_price = 0; 
                                                $orders = DB::table('orders')->join('order_status','order_status.id','orders.order_status_id')->where('buyer_id', $buyer->id)->get();
                                                if($orders){
                                                    $total_price = $orders->sum('total');
                                                    $total_qty = $orders->sum('pro_qty');
                                                }
                                                
                                            @endphp 
                                                <tr>
                                                    <td> {{ $i = $i + 1 }}</td>
                                                    <td>{{ $buyer->first_name }} {{ $buyer->last_name }}</td>
                                                    <td>{{ $buyer->phone }}</td>
                                                    <td></td>
                                                    <td>{{ $total_qty }}</td>
                                                    <td>{{ $total_price }}</td>
                                                    <td></td>
                                                </tr>
                                        @endforeach
                                    @endif 
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