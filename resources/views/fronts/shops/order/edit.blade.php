@extends('layouts.shop-admin')
@section('content')
<div tabindex="-1" class="site-content" id="content">
    <div class="container">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div id="invoce_container" style="width:100%">
                <table class="table" width="100%">
                    
                    <tr>
                        <td>ORDER DATE: {{$invoice->created_at}}</td>
                        <td></td>
                        <td rowspan="3" style="text-align:center">
                        {!! QrCode::size(100)->generate($invoice->order_code); !!}
                            <p>{{$invoice->order_code}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td width="" colspan="2">SHIP TO: 
                            <span>{{$invoice->address}}</span>,
                            <span>{{$invoice->city}}</span>,
                            <span>{{$invoice->state}}</span>,
                            <span>{{$invoice->contry}}</span>,
                            <span>{{$invoice->postcode}}</span>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>BUYER: {{$invoice->first_name." ".$invoice->last_name}}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="">
                            PHONE: <span>{{$invoice->phone}}</span>
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered" width="100%"> 
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Product</td>
                            <td>Quantity</td>
                            <td>Price</td>
                            <td>Discount(%)</td>
                            <td>Amount</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach($order_items as $inv)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{$inv->name}}</td>
                            <td>{{$inv->quantity}}</td>
                            <td>${{$inv->price}}</td>
                            <td>{{$inv->discount}}</td>
                            <td>${{$inv->amount}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="5" align="right">
                                Total Amount
                            </td>
                            <td>${{$invoice->total_amount}}</td>
                        </tr>
                    </tbody>
                </table>
                <form action="{{url('owner/product/order/update')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$invoice->order_id}}">
                    <div class="form-group">
                        <label for="order_status">Order Status:</label>
                        <select name="order_status" id="order_status" class="form-control">
                            @foreach($status as $status)
                            <option value="{{$status->id}}" @php echo ($invoice->order_status_id==$status->id)?'selected':''; @endphp>{{$status->status_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Active Status:&nbsp;&nbsp;&nbsp; </label>
                        <label><input type="radio" name="status" value="1" @php echo ($invoice->active==1)?'checked':''; @endphp> Active</label>&nbsp;&nbsp;
                        <label><input type="radio" name="status" value="0" @php echo ($invoice->active==0)?'checked':'' @endphp> Inactive</label>
                    </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Change</button>
                </form>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
    
</div>

@endsection


