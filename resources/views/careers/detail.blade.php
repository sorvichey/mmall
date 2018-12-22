@extends('layouts.career')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <strong>Detail Career</strong>&nbsp;&nbsp;
        <a class="text-warning" href="{{url('admin/career/edit/'.$career->id)}}" ><i class="fa fa-pencil"></i> Edit</a> | <a href="{{url('/admin/career')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
        <hr>
        <div class="form-group row lb">
            <label class="control-label col-lg-6 col-sm-6">
                <p class="text-primary">Position</p>
                <p>{{$career->key_position}}</p>
            </label>
            <label class="control-label col-lg-6 col-sm-6">
                <p class="text-primary">Department</p>
                <p>{{$career->department}}</p>
            </label>
        </div>
        <div class="form-group row lb">
            <label class="control-label col-lg-6 col-sm-6">
                <p class="text-primary">Category</p>
                <p>{{$career->category}}</p>
            </label>
            <label  class="control-label col-lg-6 col-sm-6">
                <p class="text-primary">Dateline</p>
                <p class="text-danger">{{$career->dateline}}</p>
            </label>
        </div>  
        <div class="form-group row lb">
            <label class="control-label col-lg-6 col-sm-6">
                <p class="text-primary">Type</p>
                <p><i class="fa fa-clock-o" aria-hidden="true"></i> {{$career->type}}</p>
            </label>
            <label for="title" class="control-label col-lg-6 col-sm-6">
                Document <br>
               <a href="{{asset('uploads/documents/'.$career->document)}}">{{$career->document}}</a>
            </label>
        </div>      
        <div class="form-group row lb">
            <label class="control-label col-lg-6 col-sm-6">
                <p class="text-primary">Gender</p>
                <p>{{$career->gender}}</p>
            </label>
            <label  class="control-label col-lg-6 col-sm-6">
                <p class="text-primary">Hire</p>
                <p class="text-danger">{{$career->hire}}</p>
            </label>
        </div>   
        <div class="form-group row lb">
            <label class="control-label col-lg-12 col-sm-12">
                <p class="text-primary">Short Description</p>
                <p>{{$career->short_description}}</p>
            </label>
        </div>   
        <hr>
        <?php $locations = DB::table('career_locations_r_careers')->where('active', 1)->where('career_id', $career->id)->get(); ?>
           <span class="lb text-primary">Location</span> : <span class="text-primary">|</span>

            @foreach($locations as $l)
               <span class="lb">{{$l->name}} </span> <span class="text-primary">|</span>
            @endforeach</span> 
        <hr>    
        <div class="form-group row lb">
            <label class="control-label col-lg-12 col-sm-12">
                <p class="text-primary">Description</p>
                <p>{!!$career->description!!}</p>
            </label>
            <label  class="control-label col-lg-12 col-sm-12">
                <p class="text-primary">Requirement</p>
                <p class="text-danger">{!!$career->requirement!!}</p>
            </label>
        </div>    
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_career").addClass("current");
        })
    </script>
@endsection