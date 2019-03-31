@extends('layouts.owner')
@section('content')
    
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br>
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
            <div class="card">
                <div class="card-header">
                    Product promotion list
                </div>
                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Promotino Code</th>
                                        <th>Product Name</th>
                                        <th>Product Quantity</th>
                                        <th>Discount (%)</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Promotino Type</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $pagex = @$_GET['page'];
                                        if(!$pagex)
                                            $pagex = 1;
                                        $i = 18 * ($pagex - 1) + 1;
                                    ?>

                                    @foreach($promotions as $promo)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td title="{{$promo->description}}">{{$promo->discount_code}}</td>
                                        <td>{{$promo->name}}</td>
                                        <td>{{$promo->number_product}}</td>
                                        <td>{{$promo->discount}}</td>
                                        <td>{{$promo->start_date}}</td>
                                        <td>{{$promo->end_date}}</td>
                                        <td>{{$promo->promo_type}}</td>
                                        <td>
                                            @if($promo->promo_active==1)
                                            <span class="text-success ">Active</span>
                                            @else
                                            <span class="text-warning s">Expired</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-info btn-xs" href="{{url('/owner/product/promotion/edit/'.Crypt::encryptString($promo->promo_id))}}" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-xs" href="{{url('/owner/product/promotion/delete/'.Crypt::encryptString($promo->promo_id) ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav>
                                {{$promotions->links()}}
                            </nav>
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
            $("#my-promotion").addClass("active");
        });
       
    </script>
@endsection