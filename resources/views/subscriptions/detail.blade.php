@extends('layouts.customer')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <strong>Subscription Detail</strong>&nbsp;&nbsp;
        <a href="{{url('/admin/subscription/edit/'.$subscription->id)}}" class="text-warning"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;
        <a href="{{url('/admin/subscription')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
        <hr>
        <form action="#" method="post" id="frm" class="form-horizontal">
            <input type="hidden" name="id" value="{{$subscription->id}}">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="name" class="control-label col-sm-3 lb"> Name</label>
                        <label class="control-label col-sm-9 lb">
                            : {{$subscription->name}}
                        </label>
                    </div>

                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Price</label>
                        <label class="control-label col-sm-9 lb">
                            : {{$subscription->price}}
                        </label>
                    </div>
                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Product Post</label>
                        <label class="control-label col-sm-9 lb">
                            : {{$subscription->posted_product}}
                        </label>
                    </div>

                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Duration </label>
                        <label class="control-label col-sm-9 lb">
                            : {{$subscription->duration}}
                        </label>
                    </div>

                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Description</label>
                        <label class="control-label col-sm-9 lb">
                            : {{$subscription->description}}
                        </label>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_subscription").addClass("current");
        })
    </script>
@endsection