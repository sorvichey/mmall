@extends('layouts.page')
@section('content')
<div id="content" class="site-content" tabindex="-1">
    <div class="container">
        <nav class="woocommerce-breadcrumb" >
            <a href="home.html">Home</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>Track your Order
        </nav><!-- .woocommerce-breadcrumb -->
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <article id="post-2181" class="post-2181 page type-page status-publish hentry">

                    <header class="entry-header">
                        <h1 class="entry-title" itemprop="name">Track your Order</h1>
                    </header><!-- .entry-header -->
                    <div class="entry-content" itemprop="mainContentOfPage">
                        <div class="woocommerce">
                            <form action="{{url('/tracking')}}" method="get" class="track_order">
                                <p>To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                                <p class="row">
                                    <div class="col-md-6">
                                        <input class="form-control" type="text"  id="q" name="q" value="{{$query}}"  required  placeholder="Enter your waybill ID" />
                                    </div>
                                    <div class="col-md-6">
                                     <input type="submit" class="button btn btn-primary" id="order_email"  name="track" value="Track" />
                                    </div>
                                </p>
                                <div class="clear"></div>
                            </form>
                        </div>
                    </div><!-- .entry-content -->
                </article><!-- #post-## -->
            </main><!-- #main -->
        </div><!-- #primary -->
        
        @if($tracking != null)
    
        <div class="col-lg-12 my-5"><br>
            <div class="card">
                <div class="card-header text-bold">
                    <h3><span class="text-primary font-weight-bold">[ {{$tracking->waybill}} ] Tracking Info</span></h3> 
                </div>
                <div class="card-block">
                    <table class="tbl table">
                        <thead>
                            <tr>
                                <th>Waybill</th>
                                <th>Origin</th>
                                <th>Destination</th>
                                <th>PCS</th>
                                <th>Date Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$tracking->waybill}}</td>
                                <td>{{$tracking->origin}}</td>
                                <td>{{$tracking->destination}}</td>
                                <td>{{$tracking->pcs}}</td>
                                <td>{{$tracking->datetime}}</td>
                                <td>{{$tracking->status}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-header text-bold">
                    <h3><span class="text-success font-weight-bold">Tracking Result</span></h3> 
                </div>
                    <?php $sub_trackings = DB::table('sub_tracking')->where('active', 1)->where('tracking_id', $tracking->id)->orderBy('id', 'desc')->get();?>
    <div class="card-block">
                    <table class="tbl table">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                               
                                <th>Datetime</th>
                                <th>Location</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $pagex = @$_GET['page'];
                                if(!$pagex)
                                $pagex = 1;
                                $i = 18 * ($pagex - 1) + 1;
                            ?>
                            @foreach($sub_trackings as $pag)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$pag->datetime}}</td>
                                    <td>{{$pag->location}}</td>
                                    <td>{{$pag->status}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                </div>
                </div>
            </div>
        </div>
   
 @else 
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
@endif
    </div><!-- .col-full -->
</div><!-- #content --> <br>


@endsection