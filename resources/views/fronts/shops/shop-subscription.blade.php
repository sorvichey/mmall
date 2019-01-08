@extends('layouts.owner')
@section('content')
<?php 
    // $ = DB::table('shop_categories')->where('active',1)->get();
 ?>
<div class="container">
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

            <div class="col-sm-12">
                <br>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <br>
            <form action="{{url('owner/shop/subcribe')}}" enctype="multipart/form-data" class="form-horizontal" method="post">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{ Request::segment(3)}}">
                @foreach($subscriptions as $s)
                    <div class="col-sm-6">
                        <div class="card" style="padding: 15px;">
                          <div class="card-body">
                            <h5 class="card-title">{{$s->name}}</h5>
                            <hr style="border: 2px solid {{$s->name}};">
                            <p class="card-text">
                                {!!$s->description!!}
                            </p>

                            <a href="{{url('owner/shop/subcribe/'.$s->id)}}" class="btn btn-success" onclick="return confirm('Are you sure want to subscribe this package?')">Subscribe Now</a>
                          </div>
                        </div>
                    </div>
                @endforeach
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    function loadFile(e){
        var output = document.getElementById('preview');
        output.src = URL.createObjectURL(e.target.files[0]);
    }

    $(document).ready (function(){
        $("#success-alert").hide();
        $("#myWish").click(function showAlert() {
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
           $("#success-alert").slideUp(500);
            });   
        });
    });

</script> 
@endsection