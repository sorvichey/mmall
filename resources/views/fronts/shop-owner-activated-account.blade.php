@extends('layouts.page')
@section('content')
<div id="content" class="site-content" tabindex="-1">
    <div class="container">
        <nav class="woocommerce-breadcrumb" >
            <a href="{{url('/')}}">{{trans('labels.home')}}</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>
            Activated your account
        </nav>
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <article id="post-8" class="hentry">
                    <div class="entry-content">
                        <div class="woocommerce">
                            <div class="customer-login-form">
                                <div class="col2-set" id="customer_login">
                                    <div class="col-1">
                                        <h2>Activated Your Account</h2>
                                        <form action="{{url('owner/activated/save')}}" method="post" class="login">
                                            {{csrf_field()}}  
                                            <input type="hidden" name="code" id="code" value="{{ collect(request()->segments())->last() }}">
                                            <p class="form-row">
                                                
                                                <input class="btn btn-success" style="background: green" type="submit" value="Activated Account">
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