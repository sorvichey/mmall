@extends('layouts.page')
@section('content')
<div id="content" class="site-content" tabindex="-1">
    <div class="container">
        <nav class="woocommerce-breadcrumb">
            <a href="{{url('/')}}">{{trans('labels.home')}}</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>
            Reset New Password
        </nav>
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <article id="post-8" class="hentry">
                    <div class="entry-content">
                        <div class="woocommerce">
                            <div class="customer-login-form">
                                <div class="col2-set" id="customer_login">
                                    <div class="col-1">
                                        @if(Session::has('sms4'))
                                            <div class="alert alert-danger" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <div>
                                                    {{session('sms4')}}
                                                </div>
                                            </div>
                                        @endif
                                        <h2>Reset New Password</h2>
                                        <form action="{{url('buyer/reset-password/save')}}" method="post" class="login">
                                            {{csrf_field()}}  
                                            <p class="before-login-text">Enter your new password easy to remember</p>
                                            <input type="hidden" id="id" name="id" value="{{$id}}">
                                            <p class="form-row form-row-wide">
                                                <label for="password">Password<span class="required">*</span></label>
                                                <input type="password" class="input-text" required name="password" id="password" value="" />
                                            </p>
                                            <p class="form-row form-row-wide">
                                                <label for="cpassword">Confirm Password<span class="required">*</span></label>
                                                <input type="password" class="input-text" required name="cpassword" id="cpassword" value="" />
                                            </p>
                                            <p class="form-row">
                                                <input class="button" type="submit" value="Send" name="send">
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </main>
        </div>
    </div>
</div>
@endsection