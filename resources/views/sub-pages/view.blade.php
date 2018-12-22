@extends('layouts.setting')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <strong>Detail Sub-Page</strong>&nbsp;&nbsp;
        <a class="text-warning" href="{{url('admin/sub-page/edit/'.$sub_page->id)}}" ><i class="fa fa-pencil"></i> Edit</a> | <a href="{{url('/admin/sub-page')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
        <hr>
        <div class="form-group row lb">
            <label for="title" class="control-label col-lg-6 col-sm-6">
                <p class="text-primary">Sub-Page Title</p>
                <p>{{$sub_page->title}}</p>
            </label>
            <label for="url" class="control-label col-lg-6 col-sm-6">
                <p class="text-primary">Page Name</p>
                <p>{{$sub_page->page_name}}</p>
            </label>
        </div>
        <div class="form-group row lb">
            <label for="description" class="control-label col-lg-6 col-sm-6">
                <p class="text-primary">Description</p>
                <p>{!!$sub_page->description!!}</p>
            </label>
        </div>       
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_sub_page").addClass("current");
        })
    </script>
@endsection