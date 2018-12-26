@extends('layouts.owner')
@section('content')

<?php 
    if($my_shop==1){
        $shop_id = $shop_info->id;
        $shop_name = $shop_info->name;
        $shop_category = $shop_info->shop_category_name;
        $shop_phone = $shop_info->phone;
        $shop_email = $shop_info->email;
        $shop_website = $shop_info->website;
        $shop_address = $shop_info->address;
        $shop_location = $shop_info->location;
        $shop_description = $shop_info->description;
        $shop_logo = $shop_info->logo;
    }else{
        $shop_id = "";
        $shop_name = "";
        $shop_category = "";
        $shop_phone = "";
        $shop_email = "";
        $shop_website = "";
        $shop_address = "";
        $shop_location = "";
        $shop_description = "";
        $shop_logo = "";
    }
 ?>
<div class="container">
    <div class="row">
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
        <div class="row">
            @if($my_shop==0)
            <a href="{{url('/owner/create-shop')}}" class="btn btn-info" >Create Your Shop Now</a>
            @else
            <div class="col-md-2">
                <img src="{{asset('uploads/shop_logos/'.$shop_logo)}}" alt="profile" class="img-rounded">
            </div>
            <div class="col-md-10">
                <h4>Your shop informantions: <a href="{{url('/owner/shop/edit/'.$shop_id)}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a></h4>
               
                <p>Shop Name: <?php echo $shop_name; ?></p>
                <p>Shop Category: <?php echo $shop_category; ?></p>
                <p>Phone: <?php echo $shop_phone; ?></p>
                <p>Email: <?php echo $shop_email; ?></p>
                <p>Website: <?php echo $shop_website; ?></p>
                <p>Address: <?php echo $shop_address; ?></p>
                <p>Description: <?php echo $shop_description; ?></p>
                <p>Location:</p>
                <span><?php echo $shop_location; ?></span>
               

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
    
    </script>
@endsection