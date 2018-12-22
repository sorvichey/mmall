@extends('layouts.owner')
@section('content')
<?php 
    $owner_id = session('shop_owner')->id;
    $owner = DB::table('shop_owners')->where('id', $owner_id)->first();
?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <img src="{{asset('uploads/owner_profiles/'.$owner->photo)}}" alt="profile" class="img-rounded">
                </div>
                <div class="col-md-8">
                    <div class="pt-10 pb-10">
                        <H4>Hi, {{$owner->last_name}} {{$owner->first_name}} <a href="{{url('/owner/profile/'.$owner->id)}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a></H4> 
                    </div>
                    <div>
                        Account Type : {{$owner->type}}
                    </div>
                    <div>
                        E-mail : {{$owner->email}}
                    </div>
                    <div>
                        Phone : {{$owner->phone}}
                    </div>
                    <div>
                        Address : {{$owner->address}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>       
<br> 
@endsection