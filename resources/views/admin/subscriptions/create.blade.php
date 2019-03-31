@extends('layouts.customer')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <strong>New Subscription</strong>&nbsp;&nbsp;
        &nbsp;&nbsp;
        <a href="{{url('/admin/subscription')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
        <hr>
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
        <form action="{{url('admin/subscription/save')}}" enctype="multipart/form-data" class="form-horizontal" method="post">
            {{csrf_field()}}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="name" class="control-label col-sm-3 lb">Name <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="name" value="{{old('name')}}" name="name" class="form-control" autofocus required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="price" class="control-label col-sm-3 lb">Price <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" id="price" value="{{old('price')}}" name="price" class="form-control" step="0.1" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="product_post" class="control-label col-sm-3 lb">Product Post <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="price" value="{{old('product_post')}}" name="product_post" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="duration" class="control-label col-sm-3 lb">Duration <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="price" value="{{old('duration')}}" name="duration" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
           
           <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="status" class="control-label col-sm-3 lb">Status <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Unactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 px-0">
                <div class="form-group row">
                    <label for="description" class="control-label col-sm-12 lb"> Description <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <textarea name="description" class="form-control ckeditor" id="description" required></textarea>
                    </div>
                </div>
            </div>
              
            <p></p>
            <div class="row">
                <div class="col-sm-6">    
                    <div class="form-group row">
                    
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
@endsection
@section('js')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_subscription").addClass("current");
        });
       
    </script>
@endsection