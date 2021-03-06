@extends('layouts.front')
@section('content')
<div tabindex="-1" class="site-content" id="content">
    <div class="container">
        
        <ul class="progressbar">
            <li class="active">Shipping Details</li>
            <li class="active">Payment Method</li>
            <li class="active">Credit Card</li>
            <li class="active">Successfully</li>
        </ul>
        <br> 
        <br> 
        <br> 
        <br> 
        <br> 
        <h1 class="text-success" style="text-align:center">Your ordering has been successfully</h1>
    
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <input type='button' id='btn' value='Print Invoice' class="btn btn-xs btn-info" onclick='printDiv();'>
            <a href="{{url('/')}}" class="btn btn-xs btn-info">Buyer Again</a>
            <div id="invoce_container" style="width:100%">
                <table class="table" width="100%">
                    <tr style="text-align:center">
                        <td colspan="3"><h3>M-MALL INVOICE</h3></td>
                    </tr>
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
                Order By: <span>{{$buyer->first_name}} {{$buyer->last_name}}</span>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
    <br>
    <br>
    <br>
</div>
<script>
    function printDiv() 
    {

        var divToPrint=document.getElementById('invoce_container');

        var newWin=window.open('','Print-Window');

        newWin.document.open();

        newWin.document.write( '<link rel="stylesheet" type="text/css" href="{{asset('fronts/assets/css/bootstrap.min.css')}}" media="all" />' );

        newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

        newWin.document.close();

        setTimeout(function(){newWin.close();},10);

    }
</script>
@endsection


