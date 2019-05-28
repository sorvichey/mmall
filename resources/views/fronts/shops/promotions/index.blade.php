@extends('layouts.shop-admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
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

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>&numero;</th>
                        <th>CODE</th>
                        <th>PRODUCT</th>
                        <th>QUANTITY</th>
                        <th>DISCOUNT</th>
                        <th>START DATE</th>
                        <th>END DATE</th>
                        <th>TYPE</th>
                        <th>STATUS</th>
                        <th>ACTIONS</th>
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
                        <td>{{$promo->discount}}%</td>
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
                            <a class="text-primary" href="{{url('/owner/product/promotion/edit/'.Crypt::encryptString($promo->promo_id))}}" title="Edit"><i class="fa fa-edit"></i></a>
                            <a class="text-danger" href="{{url('/owner/product/promotion/delete/'.Crypt::encryptString($promo->promo_id) ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
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

@endsection
@section('js')
   <script type="text/javascript">

        $(document).ready(function () {
            $("#shop-menu li a").removeClass("active");
            $("#my-promotion").addClass("active");
        });
       
    </script>
@endsection