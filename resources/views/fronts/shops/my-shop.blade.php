@extends('layouts.shop-admin')
@section('content')

<!-- Page Heading -->
<h3>Shop informantions</h3>
<hr style="border: 1px solid blue;">
<!-- Content Row -->
<div class="row">
    <div class="col-sm-12">
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
    </div>
        <div class="row">
            @if($my_shop==0)
            <div class="col-md-2">
                <a href="{{url('/owner/create-shop')}}" class="btn btn-info" >Create Your Shop Now</a>
            </div>
            <br>
            <br>
            @else
            <div class="col-md-2">
                <img src="{{asset('uploads/shop_logos/'.$shop->logo)}}" alt="profile" class="img-rounded">
            </div>
            <div class="col-md-6">
                <h4>Your shop informantions: <a href="{{url('/owner/shop/edit/'.$shop->id)}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a></h4>
               
                <p>Shop Name: <?php echo $shop->name; ?></p>
                <p >Shop Subscription: <u><?php echo $shop->current_subscribe; ?></u></p>
                <p>Shop Category: <?php $shop->shop_category_name; ?></p>
                <p>Phone: <?php echo $shop->phone; ?></p>
                <p>Email: <?php echo $shop->email; ?></p>
                <p>Website: <?php echo $shop->website; ?></p>
                <p>Address: <?php echo $shop->address; ?></p>
                <p>Description: <?php echo $shop->description; ?></p>
                <p>Location:</p>
                <span><?php echo $shop->location; ?></span>
               
            </div>
            <div class="col-md-4">
                @if($pending_subscription=="")
                <a class="btn btn-warning" href="{{url('owner/shop-subscribe/'.$shop->id)}}">Upgrade Your Shop Now!</a>
                @else
                <div class="alert alert-info" role="alert">
                    <div>
                        <h5><i class="fa fa-clock-o"></i> Pendding Subscription:</h5>
                        <p>You have subscribed for <span style="font-weight: bold;">[{{$pending_subscription->sub_name}}]</span> plan.</p>
                        <p>Please wait we are processing your request.</p>
                    </div>
                </div>
                @endif
            </div>

            @endif
        </div>
    </div>
</div>       


@endsection
@section('js')
   <script type="text/javascript">

        $(document).ready(function () {
            $("#shop-menu li a").removeClass("active");
            $("#my-shop").addClass("active");
        });
        $(document).ready (function(){
                $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
               $("#success-alert").slideUp(500);
                });   
        });
    </script>
@endsection