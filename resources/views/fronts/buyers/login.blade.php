@extends('layouts.page')
@section('content')
<div id="content" class="site-content" tabindex="-1">
    <div class="container">
        <nav class="woocommerce-breadcrumb" >
            <a href="{{url('/')}}">{{trans('labels.home')}}</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>
            Sign In
        </nav>
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <article id="post-8" class="hentry">
                    <div class="entry-content">
                        <div class="woocommerce">
                            <div class="customer-login-form">
                                <span class="or-text">or</span>
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
                                        @if(Session::has('sms3'))
                                            <div class="alert alert-success" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <div>
                                                    {{session('sms3')}}
                                                </div>
                                            </div>
                                        @endif
                                        <h2>Login</h2>
                                        <form action="{{url('buyer/sign-in')}}" method="post" accept-charset="UTF-8" class="login">
                                            {{csrf_field()}}  
                                            <p class="before-login-text">Welcome back! Sign in to your account</p>
                                            <p class="form-row form-row-wide">
                                                <label for="email">Email address<span class="required">*</span></label>
                                                <input type="text" class="input-text" required name="email" id="email" value="{{old('email')}}" />
                                            </p>
                                            <p class="form-row form-row-wide">
                                                <label for="password">Password<span class="required">*</span></label>
                                                <input class="input-text" type="password" required name="password" id="password" />
                                            </p>
                                            <p class="form-row">
                                                <input class="button" type="submit" value="Login" name="login">
                                            </p>
                                            <p class="lost_password"><a href="{{url('buyer/account-recovery')}}">Forgot password?</a></p>
                                        </form>
                                    </div>
                                    <div class="col-2">
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
                                        <h2>Register</h2>
                                        <form action="{{url('buyer/sign-up')}}" accept-charset="UTF-8" method="post" class="register">
                                            {{csrf_field()}}    
                                            <p class="before-register-text">Create an account</p>
                                            <p class="form-row form-row-wide">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="first_name">Frist Name<span class="required">*</span></label>
                                                        <input type="text" class="input-text" required name="first_name" id="first_name" value="{{old('first_name')}}" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="last_name">Last Name<span class="required">*</span></label>
                                                        <input type="text" class="input-text" required name="last_name" id="last_name" value="{{old('last_name')}}" />
                                                    </div>
                                                </div>
                                            </p>
                                            <p class="form-row form-row-wide">
                                                <label for="gender">Gender<span class="required">*</span></label>
                                                <select class="form-control option" name="gender">
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </p>
                                            <p class="form-row form-row-wide">
                                                <label for="phone">Phone<span class="required">*</span></label>
                                                <input type="phone" class="input-text" required name="phone" id="phone" value="{{old('phone')}}" />
                                            </p>
                                            <p class="form-row form-row-wide">
                                                <label for="email">Email address<span class="required">*</span></label>
                                                <input type="email" class="input-text"​​ required name="email" id="email" value="{{old('email')}}" />
                                            </p>
                                            <p class="form-row form-row-wide">
                                                <label for="password">Password<span class="required">*</span></label>
                                                <input type="password" class="input-text" required name="password" id="password" value="" />
                                            </p>
                                            <p class="form-row form-row-wide">
                                                <label for="cpassword">Confirm Password<span class="required">*</span></label>
                                                <input type="password" class="input-text" required name="cpassword" id="cpassword" value="" />
                                            </p>
                                            <p class="form-row">
                                                <input type="submit" class="button" name="register" value="Register" />
                                                </p>
                                            <div class="register-benefits">
                                                <h3>Sign up today and you will be able to :</h3>
                                                <ul>
                                                    <li>Speed your way through checkout</li>
                                                    <li>Track your orders easily</li>
                                                    <li>Keep a record of all your purchases</li>
                                                </ul>
                                            </div>
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