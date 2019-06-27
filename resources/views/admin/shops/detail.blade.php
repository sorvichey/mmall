@extends('layouts.customer')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <strong>shops Detail</strong>&nbsp;&nbsp;
        <a href="{{url('/admin/shops')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
        <hr>
            <div class="row">
                <div class="col-sm-6">
                    <p>Logo:</p>
                     <img src="{{asset('uploads/shop_logos/'.$shops->logo)}}" width="100" alt="profile">
                    <div class="form-group row">
                        <label for="name" class="control-label col-sm-3 lb">Shop Owner</label>
                        <label class="control-label col-sm-9 lb">
                            <a href="{{url('/admin/shop-owner/detail/'.$shops->shop_owner_id)}}">View owner</a>
                        </label>
                    </div>

                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Shop Name</label>
                        <label class="control-label col-sm-9 lb">
                            : {{$shops->name}}
                        </label>
                    </div>

                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Shop Category</label>
                        <label class="control-label col-sm-9 lb">
                            : {{$shops->category}}
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
                            : {{$shops->email}}
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

                <div class="col-md-6">
                    <div class="row">
                        <h5>Subscription Histories</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Subscription</th>
                                        <th>Satus</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach($subscriptions as $sub)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$sub->name}}</td>
                                        <td>
                                            @if($sub->status==1 && $sub->subscription_id==$shop->subscription_id)
                                                <i class="text-success">Current</i>
                                            @elseif($sub->status==1 && $sub->subscription_id!=$shop->subscription_id)
                                                <i class="text-danger">Past</i>
                                            @elseif($sub->status==0)
                                                <a href="{{url('/admin/shop-subscription')}}" class="text-warning">Pending</a>
                                            @endif
                                        </td>
                                        <td>{{$sub->created_at}}</td>
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
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_shops").addClass("current");
        })
    </script>
@endsection