@extends('layouts.page')
@section('content')
<div id="content" class="site-content" tabindex="-1">
    <div class="container">
        <nav class="woocommerce-breadcrumb">
            <a href="{{url('/')}}">Home</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>Best Seller
        </nav>
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <header class="page-header">
                    <h1 class="page-title">Best Seller</h1>
                </header>
                <div class="shop-control-bar">
                    <ul class="shop-view-switcher nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" title="Grid View" href="{{url('product/best-seller')}}">
                                <i class="fa fa-th"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" title="List View" href="{#">
                                <i class="fa fa-list"></i>
                            </a>
                        </li>
                    </ul>
                    <form class="woocommerce-ordering" method="get">
                        <select name="orderby" class="orderby">
                            <option value="menu_order"  selected='selected'>Default sorting</option>
                            <option value="popularity" >Sort by popularity</option>
                            <option value="rating" >Sort by average rating</option>
                            <option value="date" >Sort by newness</option>
                            <option value="price" >Sort by price: low to high</option>
                            <option value="price-desc" >Sort by price: high to low</option>
                        </select>
                    </form>
                </div>
                    <div role="tabpanel" class="tab-pane" id="list-view-small" aria-expanded="true">
                        <ul class="products columns-3">
                            @foreach($best_seller_products as $b)
                                <li class="product list-view list-view-small">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="{{url('product/detail/'.$b->p_id)}}">
                                                <img class="wp-post-image" src="{{asset('uploads/products/featured_images/250/'.$b->featured_image)}}" alt="">
                                            </a>
                                        </div>
                                        <div class="media-body media-middle">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <span class="loop-product-categories">
                                                        <a rel="tag" href="{{url('product/category/'.$b->category_id)}}">{{$b->category_name}}</a>
                                                    </span>
                                                    <h3>
                                                        <a href="{{url('product/detail/'.$b->p_id)}}">
                                                            {{$b->name}}
                                                        </a>
                                                    </h3>
                                                    <p style="padding-top: 10px;">
                                                        <span class="loop-product-categories">
                                                            <a rel="tag" href="{{url('product/detail/'.$b->p_id)}}">{{$b->short_description}}</a>
                                                        </span>
                                                    </p>
                                                
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="price-add-to-cart">
                                                        <span class="price"><span class="electro-price">
                                                            <ins><span class="amount">US @if($b->discount > 0)  {{$b->price - ($b->price / 100 * $b->discount) }} @else {{$b->price}}@endif</span></ins>
                                                            @if($b->discount > 0) 
                                                                <del><span class="amount">US {{$b->price}} </span></del>
                                                                <span style="font-size: 0.6em;"> | {{$b->discount}} % off</span>
                                                            @endif
                                                        </span></span>
                                                    </div>
                                                    <div class="hover-area">
                                                        <div class="action-buttons">
                                                            <form action="{{url('buyer/wish/save')}}" method="post">
                                                                {{ csrf_field() }}
                                                                    @if(Session::has('buyer'))
                                                                        <input type="hidden" name="buyer_id" id="buyer_id" value="{{session('buyer')->id}}">
                                                                        <input type="hidden" name="product_id" id="product_id" value="{{$b->p_id}}">
                                                                        <?php 
                                                                            $wished = DB::table('wishes')
                                                                                ->where('buyer_id', session('buyer')->id)
                                                                                ->where('product_id', $b->p_id)
                                                                                ->count();
                                                                        ?>
                                                                    @else 
                                                                    <a href="#" rel="nofollow"  class="add_to_wishlist"> Wishlist</a>
                                                                    @endif
                                                                    
                                                                    @if(Session::has('buyer'))
                                                                        @if($wished > 0)
                                                                        <span> <i class="fa fa-heart-o"></i> Added to</span> <a href="{{url('buyer/wishlist')}}" class="text-primary">wish list</a>
                                                                        @else
                                                                        <a rel="nofollow" onclick="add_wish_list(this, event)"  class="add_to_wishlist" data-id="{{$b->p_id}}" id="add_to_wishlist"> Wishlist</a>
                                                                            @endif
                                                                    @endif
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="shop-control-bar-bottom">
                        <nav class="woocommerce-pagination">
                            <ul class="page-numbers">
                                <li>
                                    {{$best_seller_products->links()}}
                                </li>
                            </ul>
                        </nav>
                    </div>
                </main>
            </div>
        </div>
    </div> 
</div>
<script>
        var burl = "{{url('/')}}";
    </script>
@endsection
@section('js')
<script src="{{asset('fronts/assets/js/add-wishlist.js')}}"></script>
@endsection