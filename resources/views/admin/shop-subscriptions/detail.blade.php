@extends('layouts.customer')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <strong>shops Detail</strong>&nbsp;&nbsp;
        <a href="{{url('/admin/shop-subscription')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
        <hr>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="name" class="control-label col-sm-3 lb">Shop Owner Name</label>
                        <label class="control-label col-sm-9 lb">
                            <a href="{{url('/admin/shop-owner/detail/'.$shops->owner_id)}}">View owner</a>
                        </label>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="control-label col-sm-3 lb">Shop Subscripton</label>
                        <label class="control-label col-sm-9 lb">
                            : <a href="{{url('admin/shop-subscription/history/'.$shops->id)}}" class="text-primary" style="font-weight: bold;">{{$shops->subscription_name}}</a>
                        </label>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="control-label col-sm-3 lb">Shop Name</label>
                        <label class="control-label col-sm-9 lb">
                            : {{$shops->name}}
                        </label>
                    </div>

                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Shop Category</label>
                        <label class="control-label col-sm-9 lb">
                            : {{$shops->shop_category}}
                        </label>
                    </div>
                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Phone</label>
                        <label class="control-label col-sm-9 lb">
                            : {{$shops->phone}}
                        </label>
                    </div>

                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Eamil </label>
                        <label class="control-label col-sm-9 lb">
                            : {{$shops->phone}}
                        </label>
                    </div>

                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Website </label>
                        <label class="control-label col-sm-9 lb">
                            : {{$shops->website}}
                        </label>
                    </div>

                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Address </label>
                        <label class="control-label col-sm-9 lb">
                            : {{$shops->address}}
                        </label>
                    </div>

                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Shop Status </label>
                        <label class="control-label col-sm-9 lb">
                            : @if($shops->status==1) <i class="text-success">Approved</i> @else <i class="text-warning">Pendding</i> @endif
                        </label>
                    </div>

                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Description</label>
                        <label class="control-label col-sm-9 lb">
                            : {{$shops->description}}
                        </label>
                    </div>

                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Map</label>
                        <div class="control-label col-sm-9 lb">
                            <span><?php echo $shops->location; ?></span>
                        </div>
                    </div>
                    
                </div>

                <div class="col-md-5">
                    <img src="{{asset('uploads/shop_logos/'.$shops->logo)}}" width="300" alt="profile">
                </div>
            </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_shops").addClass("current");
        })
    </script>
@endsection