@extends('layouts.owner')
@section('content')
<?php 
    $shop_category = DB::table('shop_categories')->where('active',1)->get();
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

            <form action="{{url('owner/shop/create')}}" enctype="multipart/form-data" class="form-horizontal" method="post">
            {{csrf_field()}}
                <div class="row">
                    <br>
                    <div class="col-sm-8">
                        <div class="form-group row">
                            <label for="shop_name" class="control-label col-sm-3 lb">Shop Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="shop_name" value="" name="shop_name" class="form-control" autofocus required>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="shop_category" class="control-label col-sm-3 lb">Shop Category(ies) <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                 <select class="form-control option" name="shop_category" id="shop_category">
                                    <option value="">Please choose one</option>
                                    @foreach($shop_category as $value)
                                      <option value="{{$value->id}}" {{$shops->shop_category==$value->id?'selected':''}}>{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="shop_phone" class="control-label col-sm-3 lb">Shop phone(s) <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="shop_phone" value="" name="shop_phone" class="form-control" required>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="shop_email" class="control-label col-sm-3 lb">Shop Email <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="shop_email" value="" name="shop_email" class="form-control" required>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="shop_website" class="control-label col-sm-3 lb">Website <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="shop_website" value="" name="shop_website" class="form-control">
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="shop_address" class="control-label col-sm-3 lb">Shop Address <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="shop_address" value="" name="shop_address" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shop_location" class="control-label col-sm-3 lb">Shop Location <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="shop_location" value="" name="shop_location" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shop_description" class="control-label col-sm-3 lb">Shop Description <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <textarea  id="shop_description" value="" name="shop_description" class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="logo" class="control-label col-sm-3 lb">Logo <span class="text-danger">(500x500)</span></label>
                            <div class="col-sm-9">
                                <input type="file" name="logo" id="logo" class="form-control" onchange="loadFile(event)">
                                <br>
                                <img src="{{asset('uploads/shop_logos/profile-default.png')}}" alt="" width="120" id="preview">
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-sm-3 lb"></label>
                            <div class="col-sm-9">
                                <button class="btn btn-primary btn-flat" type="submit">Save</button>
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