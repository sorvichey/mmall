@extends('layouts.setting')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <strong>Edit Phone Support</strong>&nbsp;&nbsp;
        &nbsp;&nbsp;
        <a href="{{url('/admin/phone-support')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
        <form action="{{url('admin/phone-support/update')}}" chartset="UTF-8" class="form-horizontal" method="post">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$phone_support->id}}">
            <div class="row">
                <div class="col-sm-9">
                    <div class="form-group row">
                        <label for="phone" class="control-label col-sm-2 lb">Phone <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="phone" value="{{$phone_support->phone}}" name="phone" class="form-control" autofocus required>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label class="control-label col-sm-2 lb"></label>
                        <div class="col-sm-9">
                            <p></p>
                            <button class="btn btn-primary btn-flat" type="submit">Save Change</button>
                            <button class="btn btn-danger btn-flat" type="reset" id="btnCancel">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
  
   $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_phone_support").addClass("current");
        });
</script> 
@endsection