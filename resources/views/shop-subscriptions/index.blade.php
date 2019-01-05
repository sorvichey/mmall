@extends('layouts.customer')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <strong>Shop Subscription List</strong>&nbsp;&nbsp;
        
        <hr>
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
        <table class="tbl">
            <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Shop Name</th>
                    <th>Shop Category</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Current Subscription</th>
                    <th>Request New Subscription</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $pagex = @$_GET['page'];
                    if(!$pagex)
                        $pagex = 1;
                    $i = 18 * ($pagex - 1) + 1;
                ?>
                @foreach($shops as $s)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$s->name}}</td>
                        <td>{{$s->shop_category}}</td>
                        <td>{{$s->phone}}</td>
                        <td>{{$s->email}}</td>
                        <td>{{$s->current_subscription}}</td>
                        <td><i class="bg-warning" style="padding: 0px 12px 0px 12px">{{$s->request_subscription}}</i></td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="{{url('/admin/shop-subscription/approve/'.$s->id)}}" onclick="return confirm('Are sure to approve new subscriptoin to this shop?')" title="Approve"><i class="fa fa-check"></i></a>
                            <!-- <a class="btn btn-sm btn-info" href="{{url('/admin/shop-subscription/detail/'.$s->id)}}" title="Detail"><i class="fa fa-eye"></i></a>
                           
                            <a class="btn btn-sm btn-primary" href="{{url('/admin/shop-subscription/all/'.$s->id ."?page=".@$_GET["page"])}}" title="All subscription"><i class="fa fa"></i>All Subs</a> -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_shop_subscription").addClass("current");
        })
    </script>
@endsection