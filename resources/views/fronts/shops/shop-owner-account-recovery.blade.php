@extends('layouts.page')
@section('content')
<div id="content" class="site-content" tabindex="-1">
    <div class="container">
        <nav class="woocommerce-breadcrumb" >
            <a href="{{url('/')}}">{{trans('labels.home')}}</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>
            Account recovery
        </nav>
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <article id="post-8" class="hentry">
                    <div class="entry-content">
                        <div class="woocommerce">
                            <div class="customer-login-form">
                                <div class="col2-set" id="customer_login">
                                    <div class="col-1">
                                        @if(Session::has('sms2'))
                                            <div class="alert alert-danger" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <div>
                                                    {{session('sms2')}}
                                                </div>
                                            </div>
                                        @endif
                                        <h2>Account recovery</h2>
                                        <form action="{{url('owner/account-recovery/send')}}" method="post" class="login">
                                        {{csrf_field()}}  
                                            <p class="before-login-text">Enter your email register with mmall</p>

                                            <p class="form-row form-row-wide">
                                                <label for="email">Email address<span class="required">*</span></label>
                                                <input type="text" class="input-text" required name="email" id="email" value="{{old('email')}}" />
                                            </p>

                                            <p class="form-row">
                                                <input class="button" type="submit" value="Send" name="send">
                                            </p>
                                        </form>
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