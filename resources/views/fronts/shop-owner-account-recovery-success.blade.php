@extends('layouts.page')
@section('content')
<div class="container-fluit">
    <div class="row">
        <div class="col-md-12">
            <div class="page-title text-success" style="background: #f1f1f1; padding: 50px;">
                <h1 align="center">{{trans('labels.recovery_passoward_success')}}</h1>
            </div>
            <div class="border" style="margin-bottom: 50px;">
                <h5 align="center" style="padding: 50px;">
                    {{trans('labels.please_check_email')}}
                </h5>
                <p align="center">
                    <a href="{{url('/')}}" class="btn btn-warning">{{trans('labels.back_home')}}</a>
                </p>
            </div>
        </div>
    </div>
</div>        
@endsection