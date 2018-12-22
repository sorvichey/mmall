@extends('layouts.customer')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <strong>Buyer Detail</strong>&nbsp;&nbsp;
        <a href="{{url('/admin/buyer/edit/'.$buyer->id)}}" class="text-warning"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;
        <a href="{{url('/admin/buyer')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
        <hr>
        <form action="#" method="post" id="frm" class="form-horizontal">
            <input type="hidden" name="id" value="{{$buyer->id}}">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="control-label col-sm-9 lb">
                            <img src="{{asset('uploads/buyer_profiles/'.$buyer->photo)}}" width="300" alt="profile">
                        </label>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="control-label col-sm-3 lb"> Full Name</label>
                        <label class="control-label col-sm-9 lb">
                            : {{$buyer->first_name}} {{$buyer->last_name}}
                        </label>
                    </div>
                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Gender</label>
                        <label class="control-label col-sm-9 lb">
                            : {{$buyer->gender}}
                        </label>
                    </div>
                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Phone</label>
                        <label class="control-label col-sm-9 lb">
                            : {{$buyer->phone}}
                        </label>
                    </div>
                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Email</label>
                        <label class="control-label col-sm-9 lb">
                            : {{$buyer->email}}
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
            $("#menu_buyer").addClass("current");
        });
       
    </script>
@endsection