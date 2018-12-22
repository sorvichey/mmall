@extends('layouts.page')
@section('content')
<div id="content" class="site-content" tabindex="-1">
    <div class="container">
        <nav class="woocommerce-breadcrumb">
            <a href="{{url('/')}}">Home</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>Career 
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>Career Detail
        </nav>
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <div class="row lb">
                    <label class="control-label col-lg-6 col-sm-6">
                        <p class="text-primary">Position</p>
                        <p>{{$career->key_position}}</p>
                    </label>
                    <label class="control-label col-lg-6 col-sm-6">
                        <p class="text-primary">Department</p>
                        <p>{{$career->department}}</p>
                    </label>
                </div>
                <div class="row lb">
                    <label class="control-label col-lg-6 col-sm-6">
                        <p class="text-primary">Category</p>
                        <p>{{$career->category}}</p>
                    </label>
                    <label  class="control-label col-lg-6 col-sm-6">
                        <p class="text-primary">Dateline</p>
                        <p class="text-danger">{{$career->dateline}}</p>
                    </label>
                </div>  
                <div class="row lb">
                    <label class="control-label col-lg-6 col-sm-6">
                        <p class="text-primary">Type</p>
                        <p><i class="fa fa-clock-o" aria-hidden="true"></i> {{$career->type}}</p>
                    </label>
                    <label  class="control-label col-lg-6 col-sm-6">
                        <p class="text-primary">Hire</p>
                        <p class="text-danger">{{$career->hire}}</p>
                    </label>
                </div>      
                <div class="row lb">
                    <label class="control-label col-lg-6 col-sm-6">
                        <p class="text-primary">Gender</p>
                        <p>{{$career->gender}}</p>
                    </label>
                    <label for="title" class="control-label col-lg-6 col-sm-6">
                    <p class="text-primary">Document</p>
                    <a href="{{asset('uploads/documents/'.$career->document)}}">{{$career->document}}</a>
                    </label>
                   
                </div>   
                <hr>
                <?php $locations = DB::table('career_locations_r_careers')->where('active', 1)->where('career_id', $career->id)->get(); ?>
                <span class="lb text-primary">Location</span> : <span class="text-primary">|</span>
                    @foreach($locations as $l)
                    <span class="lb">{{$l->name}} </span> <span class="text-primary">|</span>
                    @endforeach</span> 
                <hr>    
                <div class="row lb">
                    <label class="control-label col-lg-12 col-sm-12">
                        <p class="text-primary">Description</p>
                        <p>{!!$career->description!!}</p>
                    </label>
                    <label  class="control-label col-lg-12 col-sm-12">
                        <p class="text-primary">Requirement</p>
                        <p class="text-danger">{!!$career->requirement!!}</p>
                    </label>
                </div>    
            </main>
        </div>
    </div>     
</div>
@endsection