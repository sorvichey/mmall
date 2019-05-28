@extends('layouts.front')
@section('content')
<div tabindex="-1" class="site-content" id="content">
    <div class="container">
        <nav class="woocommerce-breadcrumb"><a href="{{url('/')}}">Home</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>
            Credit Card Infomations
        </nav>
        <div class="content-area" id="primary">
            <main class="site-main" id="main">
                <article class="page type-page status-publish hentry">
                    <div itemprop="mainContentOfPage" class="entry-content">
                        <div id="yith-wcwl-messages"></div>
                        <div class="col-md-12">
                            <form action="{{url('buyer/credit-card/save')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="holder_name">Holder Name <i class="text-danger">*</i>:</label>
                                    <input type="text" class="form-control" name="holder_name" id="holder_name"  placeholder="#John Smit" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="card_number">Card Number<i class="text-danger">*</i>:</label>
                                    <input type="text" class="form-control" name="card_number" id="card_number" placeholder="XXXX XXXX XXXX XXXX" required>
                                </div>

                                <div class="form-group">
                                    <label for="expiry">Expiration date<i class="text-danger">*</i>:</label>
                                    <input type="text" class="form-control" name="expiry" id="expiry" placeholder="00/00" required>
                                </div>

                                <div class="form-group">
                                    <label for="postcode">CVV<i class="text-danger">*</i>:</label>
                                    <input type="number" min="1" class="form-control" name="cvv" id="cvv" placeholder="000" required>
                                </div>

                                <button type="submit" name="btn_save" class="btn btn-info">Continue</button>
                            </form>
                        </div>  
                    </div>
                </article>
            </main>
        </div>
    </div>
</div>
@endsection


