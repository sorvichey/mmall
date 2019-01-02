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

            <form action="{{url('owner/shop/subcribe')}}" enctype="multipart/form-data" class="form-horizontal" method="post">
            {{csrf_field()}}
                <div class="row">

                    <br>
                    <div class="col-sm-12">
                        <h4>Subscribe to upgrade your shop:</h4>
                        <hr>
                        <input type="hidden" name="id" value="{{ Request::segment(3)}}">


                         <div class="form-group row">
                            <label for="shop_category" class="control-label col-sm-3">Subscription Type <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control option" name="subscription_id" id="subscription_id">
                                    <option value="">Please choose one</option>
                                    @foreach($subscriptions as $value)
                                      <option value="{{$value->id}}" >{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-sm-3 lb"></label>
                            <div class="col-sm-9">
                                <button class="btn btn-primary btn-flat" type="submit">Subscribe</button>
                                <button class="btn btn-danger btn-flat" type="reset" id="btnCancel">Cancel</button>
                                <p></p>
                            </div>
                        </div>

                    </div>
                </div>
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

</script> 
@endsection