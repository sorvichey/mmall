@extends('layouts.front')
@section('content')
<div tabindex="-1" class="site-content" id="content">
    <div class="container">
        <nav class="woocommerce-breadcrumb"><a href="{{url('/')}}">Home</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>
            Payment Method
        </nav>
        <ul class="progressbar">
                <li class="active"><a href="javascript:history.go(-1)">Shipping Details</a></li>
                <li class="active">Payment Method</li>
                <li id="progress_credit">Credit Card</li>
                <li>Successfully</li>
            </ul>
        <div class="content-area" id="primary">
            <main class="site-main" id="main">
                <article class="page type-page status-publish hentry">
                    <div itemprop="mainContentOfPage" class="entry-content">
                        <div id="yith-wcwl-messages"></div>
                        <div class="col-md-6">
                            <form action="{{url('buyer/payment/save')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="adress">Payment Method:</label>
                                    <hr>
                                    @foreach($payment_types as $p)
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="payment_method" class="checking" value="{{$p->id}}"> {{$p->name}}
                                        </label>
                                    </div>
                                    <hr>
                                    @endforeach
                                </div>

                                <button type="submit" name="btn_update" class="form-control btn btn-primary">Continue</button>
                            </form>
                        </div>  
                    </div>
                </article>
            </main>
        </div>
    </div>
    <br>
    <br>
    <br>
</div>
<script>
// $(document).ready(function(){
//     //set initial state.
//     $('.checking').val(this.checked);

//     $('.checking').change(function() {
//         if(this.checked) {
//             alert()
//             // var returnVal = confirm("Are you sure?");
//             // $(this).prop("checked", returnVal);
//         }
//         $('.checking').val(this.checked);        
//     });
// });
</script>
@endsection


