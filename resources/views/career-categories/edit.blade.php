@extends('layouts.career')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <strong>Edit Career Category</strong>&nbsp;&nbsp;
        &nbsp;&nbsp;
        <a href="{{url('/admin/career-category')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
        <form action="{{url('admin/career-category/update')}}" class="form-horizontal" method="post">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$career_category->id}}">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="name" class="control-label col-sm-3 lb">Name <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="name" value="{{$career_category->name}}" name="name" class="form-control" autofocus required>
                        </div>
                    </div>
                    <p></p>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 lb"> </label>
                        <div class="col-sm-9">
                            <button class="btn btn-primary btn-flat" type="submit">Save Change</button>
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
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_career_category").addClass("current");
        })
    </script>
@endsection