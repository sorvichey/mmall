@extends('layouts.front')
@section('content')
<div tabindex="-1" class="site-content" id="content">
    <div class="container">
        <nav class="woocommerce-breadcrumb"><a href="{{url('/')}}">Home</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>
            Shipping info
        </nav>
        <div class="container">
            <ul class="progressbar">
                <li class="active">Shipping Details</li>
                <li >Payment Method</li>
                <li>Credit Card</li>
                <li>Successfully</li>
            </ul>
        </div>
        <div class="content-area" id="primary">
            <main class="site-main" id="main">
                <article class="page type-page status-publish hentry">
                    <div itemprop="mainContentOfPage" class="entry-content">
                        <div id="yith-wcwl-messages"></div>
                        <div class="col-md-6">
                            <form action="{{url('buyer/shipping-info/save')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="adress">Address:</label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="#45" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="city">City:</label>
                                    <input type="text" class="form-control" name="city" id="city" placeholder="Phnom Penh" required>
                                </div>

                                <div class="form-group">
                                    <label for="state">State:</label>
                                    <input type="text" class="form-control" name="state" id="state" placeholder="Phnom Penh" required>
                                </div>

                                <div class="form-group">
                                    <label for="postcode">Zip/Postcode:</label>
                                    <input type="number" min="1" class="form-control" name="postcode" id="postcode" placeholder="12000" required>
                                </div>

                                <div class="form-group">
                                    <label for="postcode">Contry:</label>
                                    <input type="text" class="form-control" name="contry" id="contry" placeholder="Cambodia" required>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone:</label>
                                    <input type="number" min="1" class="form-control" name="phone" placeholder="010674459" id="phone">
                                </div>

                                <button type="submit" name="btn_update" class="btn btn-info">Continue</button>
                            </form>
                        </div>  
                    </div>
                </article>
            </main>
        </div>
    </div>
</div>
@endsection


