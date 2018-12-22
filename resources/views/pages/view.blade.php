@extends('layouts.setting')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <strong>Detail Page</strong>&nbsp;&nbsp;
        <a class="text-warning" href="{{url('admin/page/edit/'.$page->id)}}" ><i class="fa fa-pencil"></i> Edit</a> | <a href="{{url('/admin/page')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
        <hr>
        <div class="form-group row lb">
            <label for="title" class="control-label col-lg-6 col-sm-6">
                <p class="text-primary">Title</p>
                <p>{{$page->title}}</p>
            </label>
            <label for="url" class="control-label col-lg-6 col-sm-6">
                <p class="text-primary">URL</p>
                <p>/page/{{$page->id}}</p>
            </label>
        </div>
        <div class="form-group row lb">
            <label for="description" class="control-label col-lg-6 col-sm-6">
                <p class="text-primary">Description</p>
                <p>{!!$page->description!!}</p>
            </label>
            <label for="title" class="control-label col-lg-6 col-sm-6">
                <img src="{{asset('uploads/pages/'.$page->photo)}}" width="100%" alt="">
            </label>
        </div>       
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_page").addClass("current");
        })
    </script>
@endsection