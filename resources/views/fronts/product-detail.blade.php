@extends('layouts.detail')
@section('content')
            <div id="content" class="site-content" tabindex="-1">
                <div class="container">
                    <nav class="woocommerce-breadcrumb">
                        <a href="home.html">Home</a>
                        <span class="delimiter"><i class="fa fa-angle-right"></i></span>
                        <a href="product-category.html">Accessories</a>
                        <span class="delimiter"><i class="fa fa-angle-right"></i></span>
                        <a href="product-category.html">Headphones</a>
                        <span class="delimiter"><i class="fa fa-angle-right"></i>
                        </span>{{$product->name}}
                    </nav><!-- /.woocommerce-breadcrumb -->
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <div class="product">
                                <div class="single-product-wrapper">
                                    <div class="product-images-wrapper">
                                        <span class="onsale">{{$product->condiction}}</span>
                                        <div class="images electro-gallery">
                                            <div class="thumbnails-single owl-carousel">
                                                <a href="{{asset('uploads/products/featured_images/600/'.$product->featured_image)}}" class="zoom" title="" data-rel="prettyPhoto[product-gallery]"><img src="{{asset('uploads/products/featured_images/600/'.$product->featured_image)}}" class="wp-post-image" alt=""></a>
                                                @foreach($photos as $p)
                                                <a href="{{asset('uploads/products/600/'.$p->photo)}}" class="zoom" title="" data-rel="prettyPhoto[product-gallery]"><img src="{{asset('uploads/products/600/'.$p->photo)}}" class="wp-post-image" alt=""></a>
                                                @endforeach
                                            </div><!-- .thumbnails-single -->
                                            <div class="thumbnails-all columns-5 owl-carousel">
                                                <a href="{{asset('uploads/products/featured_images/180/'.$product->featured_image)}}" class="first" title=""><img src="{{asset('uploads/products/featured_images/180/'.$product->featured_image)}}" data-echo="{{asset('uploads/products/featured_images/180/'.$product->featured_image)}}" class="wp-post-image" alt=""></a>
                                                @foreach($photos as $p)
                                                <a href="{{asset('uploads/products/180/'.$p->photo)}}" class="" title=""><img src="{{asset('uploads/products/180/'.$p->photo)}}" data-echo="{{asset('uploads/products/180/'.$p->photo)}}" class="wp-post-image" alt=""></a>
                                                @endforeach
                                            </div><!-- .thumbnails-all -->
                                        </div><!-- .electro-gallery -->
                                    </div><!-- /.product-images-wrapper -->

                                    <div class="summary entry-summary">
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
                                        <span class="loop-product-categories">
                                            <a href="product-category.html" rel="tag">{{$product->category_name}}</a>
                                        </span><!-- /.loop-product-categories -->
                                        <h1 itemprop="name" class="product_title entry-title">{{$product->name}}</h1>
                                        <div class="woocommerce-product-rating">
                                            <div class="star-rating" title="Rated 4.33 out of 5">
                                                <span style="width:86.6%">
                                                    <strong itemprop="ratingValue" class="rating">4.33</strong>
                                                    out of <span itemprop="bestRating">5</span>				based on
                                                    <span itemprop="ratingCount" class="rating">3</span>
                                                    customer ratings
                                                </span>
                                            </div>
                                            <a href="#reviews" class="woocommerce-review-link">(<span itemprop="reviewCount" class="count">3</span> customer reviews)</a>
                                        </div><!-- .woocommerce-product-rating -->

                                        <div class="availability in-stock">Availablity: <span>@if($product->quantity > 0 )In stock @else <span class="text-danger"> Out Stock </span> @endif</span></div><!-- .availability -->

                                        <hr class="single-product-title-divider" />

                                        <div class="action-buttons">
                                            
                                           <form action="{{url('buyer/wish/save')}}" method="post">
                                                {{ csrf_field() }}
                                                    @if(Session::has('buyer'))
                                                        <input type="hidden" name="buyer_id" id="buyer_id" value="{{session('buyer')->id}}">
                                                        <input type="hidden" name="product_id" id="product_id" value="{{$product->p_id}}">
                                                        <?php 
                                                            $wished = DB::table('wishes')
                                                                ->where('buyer_id', session('buyer')->id)
                                                                ->where('product_id', $product->p_id)
                                                                ->count();
                                                        ?>
                                                    @else 
                                                    <a href="#" rel="nofollow"  class="add_to_wishlist"> Wishlist</a>
                                                    @endif
                                                    
                                                    @if(Session::has('buyer'))
                                                        @if($wished > 0)
                                                        <span> <i class="fa fa-heart-o"></i> Added to</span> <a href="{{url('buyer/wishlist')}}" class="text-primary">wish list</a>
                                                        @else
                                                        <a rel="nofollow" onclick="add_wish_list(this, event)"  class="add_to_wishlist" data-id="{{$product->p_id}}" id="add_to_wishlist"> Wishlist</a>
                                                            @endif
                                                    @endif
                                            </form>
                                        </div><!-- .action-buttons -->

                                        <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

                                            <p class="price"><span class="electro-price"><ins><span class="amount text-danger">&#36; @if($product->discount > 0)  {{$product->price - ($product->price / 100 * $product->discount) }} @else {{$product->price}}@endif</span></ins> @if($product->discount > 0) <del><span class="amount">&#36; {{$product->price}}</span></del>  <span style="font-size: 0.6em;"> | {{$product->discount}} % off</span>@endif</span></p>

                                            <meta itemprop="price" content="1215" />
                                            <meta itemprop="priceCurrency" content="USD" />
                                            <link itemprop="availability" href="http://schema.org/InStock" />

                                        </div><!-- /itemprop -->

                                        <form action="{{url('/buyer/cart/save')}}" id="variations_form" class="variations_form cart" method="post">
                                            {{csrf_field()}}

                                              @if(count($colors)>0)
                                                <div class="row">
                                                    <div class="col-md-2"> 
                                                        Color
                                                    </div>
                                                    @foreach($colors as $c)
                                                        <div style="float:left; padding: 1px; margin-left: 5px; border: 1px solid #000;">
                                                            <img src="{{asset('uploads/products/colors/180/'.$c->photo)}}" style="height:30px;" alt="$c->name" title="$c->name">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif


                                            <div class="single_variation_wrap">
                                                <div class="woocommerce-variation single_variation"></div>
                                                <div class="woocommerce-variation-add-to-cart variations_button">
                                                    <div class="quantity">
                                                        <label>Quantity:</label>
                                                        <input type="number" name="quantity" value="1" title="Qty" class="input-text qty text"/>
                                                    </div>
                                                    <button type="submit" class="single_add_to_cart_button button" onclick="add_to_cart_m(this, event)">Add to cart</button>

                                                    <input type="hidden" name="add-to-cart" value="2452" />
                                                    <input type="hidden" name="p_id" value="{{base64_encode($product->id)}}" />
                                                    <input type="hidden" name="variation_id" class="variation_id" value="0" />
                                                </div>
                                            </div>
                                        </form>
                                        {!! QrCode::size(100)->generate(Request::url($product->qr_code_link)); !!}

                                    </div><!-- .summary -->
                                </div><!-- /.single-product-wrapper -->
                                <div class="woocommerce-tabs wc-tabs-wrapper">
                                    <ul class="nav nav-tabs electro-nav-tabs tabs wc-tabs" role="tablist">
                                        <li class="nav-item accessories_tab">
                                            <a href="#tab-accessories" data-toggle="tab">   </a>
                                        </li>

                                        <li class="nav-item description_tab">
                                            <a href="#tab-description" class="active" data-toggle="tab">Description</a>
                                        </li>
                                        <li class="nav-item reviews_tab">
                                            <a href="#tab-reviews" data-toggle="tab">Reviews</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane panel entry-content wc-tab" id="tab-accessories">

                                            <div class="accessories">

                                                <div class="electro-wc-message"></div>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-9 col-left">
                                                        <ul class="products columns-3">

                                                            <li class="product first">
                                                                <div class="product-outer">
                                                                    <div class="product-inner">
                                                                        <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                                        <a href="single-product.html">
                                                                            <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                                            <div class="product-thumbnail">

                                                                                <img data-echo="assets/images/products/4.jpg" src="assets/images/blank.gif" alt="">

                                                                            </div>
                                                                        </a>

                                                                        <div class="price-add-to-cart">
                                                                            <span class="price">
                                                                                <span class="electro-price">
                                                                                    <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                                    <del><span class="amount">&#036;2,299.00</span></del>
                                                                                </span>
                                                                            </span>
                                                                            <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                                        </div><!-- /.price-add-to-cart -->

                                                                        <div class="hover-area">
                                                                            <div class="action-buttons">
                                                                                <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                                                <a href="#" class="add-to-compare-link">Compare</a>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- /.product-inner -->
                                                                </div><!-- /.product-outer -->
                                                            </li>
                                                            <li class="product ">
                                                                <div class="product-outer">
                                                                    <div class="product-inner">
                                                                        <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                                        <a href="single-product.html">
                                                                            <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                                            <div class="product-thumbnail">
                                                                                <img data-echo="assets/images/products/3.jpg" src="assets/images/blank.gif" alt="">
                                                                            </div>
                                                                        </a>

                                                                        <div class="price-add-to-cart">
                                                                            <span class="price">
                                                                                <span class="electro-price">
                                                                                    <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                                    <del><span class="amount">&#036;2,299.00</span></del>
                                                                                </span>
                                                                            </span>
                                                                            <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                                        </div><!-- /.price-add-to-cart -->

                                                                        <div class="hover-area">
                                                                            <div class="action-buttons">
                                                                                <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                                                <a href="#" class="add-to-compare-link">Compare</a>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- /.product-inner -->
                                                                </div><!-- /.product-outer -->
                                                            </li>
                                                            <li class="product last">
                                                                <div class="product-outer">
                                                                    <div class="product-inner">
                                                                        <span class="loop-product-categories"><a href="product-category.html" rel="tag">Smartphones</a></span>
                                                                        <a href="single-product.html">
                                                                            <h3>Notebook Black Spire V Nitro  VN7-591G</h3>
                                                                            <div class="product-thumbnail">
                                                                                <img data-echo="assets/images/products/5.jpg" src="assets/images/blank.gif" alt="">
                                                                            </div>
                                                                        </a>

                                                                        <div class="price-add-to-cart">
                                                                            <span class="price">
                                                                                <span class="electro-price">
                                                                                    <ins><span class="amount">&#036;1,999.00</span></ins>
                                                                                    <del><span class="amount">&#036;2,299.00</span></del>
                                                                                </span>
                                                                            </span>
                                                                            <a rel="nofollow" href="single-product.html" class="button add_to_cart_button">Add to cart</a>
                                                                        </div><!-- /.price-add-to-cart -->

                                                                        <div class="hover-area">
                                                                            <div class="action-buttons">
                                                                                <a href="#" rel="nofollow" class="add_to_wishlist">Wishlist</a>
                                                                                <a href="#" class="add-to-compare-link">Compare</a>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- /.product-inner -->
                                                                </div><!-- /.product-outer -->
                                                            </li>

                                                        </ul><!-- /.products -->

                                                        <div class="check-products">
                                                            <div class="checkbox accessory-checkbox">
                                                                <label>
                                                                    <input checked disabled type="checkbox" class="product-check">
                                                                    <span class="product-title">
                                                                        <strong>This product: </strong>Ultra Wireless S50 Headphones S50 with Bluetooth
                                                                    </span>
                                                                    -
                                                                    <span class="accessory-price">
                                                                        <span class="amount">&#36;1,215.00</span>
                                                                    </span>
                                                                </label>
                                                            </div>

                                                            <div class="checkbox accessory-checkbox">
                                                                <label>
                                                                    <input checked type="checkbox" class="product-check">
                                                                    <span class="product-title">Universal Headphones Case in Black</span>
                                                                    -
                                                                    <span class="accessory-price">
                                                                        <span class="amount">&#36;159.00</span>
                                                                    </span>
                                                                </label>
                                                            </div>

                                                            <div class="checkbox accessory-checkbox">
                                                                <label>
                                                                    <input checked type="checkbox" class="product-check">
                                                                    <span class="product-title">Headphones USB Wires</span>
                                                                    -
                                                                    <span class="accessory-price">
                                                                        <span class="amount">&#36;50.00</span>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div><!-- /.check-products -->

                                                    </div><!-- /.col -->

                                                    <div class="col-xs-12 col-sm-3 col-right">
                                                        <div class="total-price">
                                                            <span class="total-price-html">
                                                                <span class="amount">&#036;1,424.00</span>
                                                            </span>
                                                            for <span class="total-products">3</span>
                                                            items
                                                        </div><!-- /.total-price -->

                                                        <div class="accessories-add-all-to-cart">
                                                            <button type="button" class="button btn btn-primary add-all-to-cart">Add all to cart</button>
                                                        </div><!-- /.accessories-add-all-to-cart -->
                                                    </div><!-- /.col -->
                                                </div><!-- /.row -->

                                            </div><!-- /.accessories -->
                                        </div>

                                        <div class="tab-pane active in panel entry-content wc-tab" id="tab-description">
                                            <div class="electro-description">
                                                {!!$product->description!!}
                                            </div>
                                        </div>
                                        <div class="tab-pane panel entry-content wc-tab" id="tab-reviews">
                                            <div id="reviews" class="electro-advanced-reviews">
                                                <div class="advanced-review row">
                                                    <div class="col-xs-12 col-md-6">
                                                        <h2 class="based-title">Based on {{$reviewer}} reviews</h2>
                                                        <div class="avg-rating">
                                                            <span class="avg-rating-number">
                                                                @foreach($rate_overall as $overall) 
                                                                    {{number_format($overall->rateEverage, 2)}}
                                                                @endforeach
                                                            </span> overall
                                                        </div>

                                                        <div class="rating-histogram">
                                                        @foreach($rate_progress as $progress) 
                                                            <div class="rating-bar">
                                                                <div class="star-rating" title="Rated 5 out of 5">
                                                                    <span style="width:100%"></span>
                                                                </div>
                                                                <div class="rating-percentage-bar">
                                                                    <span style="width:{{100*$progress->rate5/100}}%" class="rating-percentage">

                                                                    </span>
                                                                </div>
                                                                <div class="rating-count">{{$progress->rate5}}</div>
                                                            </div><!-- .rating-bar -->

                                                            <div class="rating-bar">
                                                                <div class="star-rating" title="Rated 5 out of 5">
                                                                    <span style="width:80%"></span>
                                                                </div>
                                                                <div class="rating-percentage-bar">
                                                                    <span style="width:{{100*$progress->rate4/100}}%" class="rating-percentage">

                                                                    </span>
                                                                </div>
                                                                <div class="rating-count">{{$progress->rate4}}</div>
                                                            </div><!-- .rating-bar -->

                                                            <div class="rating-bar">
                                                                <div class="star-rating" title="Rated 5 out of 5">
                                                                    <span style="width:60%"></span>
                                                                </div>
                                                                <div class="rating-percentage-bar">
                                                                    <span style="width:{{100*$progress->rate3/100}}%" class="rating-percentage">

                                                                    </span>
                                                                </div>
                                                                <div class="rating-count">{{$progress->rate3}}</div>
                                                            </div><!-- .rating-bar -->

                                                            <div class="rating-bar">
                                                                <div class="star-rating" title="Rated 5 out of 5">
                                                                    <span style="width:40%"></span>
                                                                </div>
                                                                <div class="rating-percentage-bar">
                                                                    <span style="width:{{100*$progress->rate2/100}}%" class="rating-percentage">

                                                                    </span>
                                                                </div>
                                                                <div class="rating-count">{{$progress->rate2}}</div>
                                                            </div><!-- .rating-bar -->
                                                            <div class="rating-bar">
                                                                <div class="star-rating" title="Rated 5 out of 5">
                                                                    <span style="width:20%"></span>
                                                                </div>
                                                                <div class="rating-percentage-bar">
                                                                    <span style="width:{{100*$progress->rate1/100}}%" class="rating-percentage">

                                                                    </span>
                                                                </div>
                                                                <div class="rating-count">{{$progress->rate1}}</div>
                                                            </div><!-- .rating-bar -->
                                                        @endforeach
                                                        </div>
                                                    </div><!-- /.col -->

                                                    <div class="col-xs-12 col-md-6">
                                                       
                                                        <div id="review_form_wrapper">
                                                            <div id="review_form">
                                                                <div id="respond" class="comment-respond">
                                                                    <h3 id="reply-title" class="comment-reply-title">Add a review
                                                                        <small><a rel="nofollow" id="cancel-comment-reply-link" href="#" style="display:none;">Cancel reply</a>
                                                                        </small>
                                                                    </h3>

                                                                    <form action="{{url('/product/rate')}}" method="post" id="commentform" class="comment-form">
                                                                        {{csrf_field()}}
                                                                        <p class="comment-form-rating">
                                                                            <label>Your Rating</label>
                                                                        </p>

                                                                        <input type="hidden" name="pro_id" value="{{$product->id}}">
                                                                    

                                                                         <input type="hidden" name="buyer_id" value="@if (Session::has('buyer'))
                                                                            {{session('buyer')->id}}
                                                                            @endif">

                                                                        <div class='rating-stars text-center'>
                                                                            <ul id='stars'>
                                                                              <li class='star' title='Poor' data-value='1'>
                                                                                <i class='fa fa-star fa-fw'></i>
                                                                              </li>
                                                                              <li class='star' title='Fair' data-value='2'>
                                                                                <i class='fa fa-star fa-fw'></i>
                                                                              </li>
                                                                              <li class='star' title='Good' data-value='3'>
                                                                                <i class='fa fa-star fa-fw'></i>
                                                                              </li>
                                                                              <li class='star' title='Excellent' data-value='4'>
                                                                                <i class='fa fa-star fa-fw'></i>
                                                                              </li>
                                                                              <li class='star' title='WOW!!!' data-value='5'>
                                                                                <i class='fa fa-star fa-fw'></i>
                                                                              </li>
                                                                            </ul>
                                                                            <input type="hidden" id="rate_number" name="rate_number">
                                                                        </div>

                                                                        <p class="comment-form-comment">
                                                                            <label for="comment">Your Review</label>
                                                                            <textarea id="comment" name="comment" cols="45" rows="8" placeholder="Please add your comment here" aria-required="true"></textarea>
                                                                        </p>

                                                                        <p class="form-submit">
                                                                            <input name="submit" type="submit" id="submit" class="submit" value="Add Review" />
                           
                                                                        </p>

                                                                        <input type="hidden" id="_wp_unfiltered_html_comment_disabled" name="_wp_unfiltered_html_comment_disabled" value="c7106f1f46" />
                                                                        <script>(function(){if(window===window.parent){document.getElementById('_wp_unfiltered_html_comment_disabled').name='_wp_unfiltered_html_comment';}})();</script>
                                                                    </form><!-- form -->
                                                                </div><!-- #respond -->
                                                            </div>
                                                        </div>

                                                    </div><!-- /.col -->
                                                </div><!-- /.row -->

                                                <div id="comments">

                                                    <ol class="commentlist">
                                                    @foreach($reviewer_list as $v)
                                                        <li itemprop="review" class="comment even thread-even depth-1">

                                                            <div id="comment-390" class="comment_container">

                                                                <img alt='' src="assets/images/blog/avatar.jpg" class="avatar" height='60' width='60' />
                                                                <div class="comment-text">

                                                                    <div class="star-rating" title="Rated 4 out of 5">
                                                                        <span style="width:{{100*$v->rate/5}}%"><strong itemprop="ratingValue">{{$v->rate}}</strong> out of 5</span>
                                                                    </div>

                                                                    <div itemprop="description" class="description">
                                                                        <p>{{$v->description}}
                                                                        </p>
                                                                    </div>


                                                                    <p class="meta">
                                                                        <strong itemprop="author">{{$v->first_name}}</strong> &ndash; <time itemprop="datePublished" datetime="2016-03-03T14:13:48+00:00">{{$v->create_at}}</time>
                                                                    </p>


                                                                </div>
                                                            </div>
                                                        </li><!-- #comment-## -->
                                                    @endforeach
                                                    </ol><!-- /.commentlist -->

                                                </div><!-- /#comments -->
                                                <div class="shop-control-bar-bottom">
                                                    <nav class="woocommerce-pagination">
                                                        <ul class="page-numbers">
                                                            <li>
                                                                {{$reviewer_list->links()}}
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                                <div class="clear"></div>
                                            </div><!-- /.electro-advanced-reviews -->
                                        </div><!-- /.panel -->
                                    </div>
                                </div><!-- /.woocommerce-tabs -->

                          <section class="home-v1-recently-viewed-products-carousel section-products-carousel animate-in-view fadeIn animated" data-animation="fadeIn">
                                <header>
                                    <h2 class="h1">Related Product</h2>
                                    <div class="owl-nav">
                                        <a href="#products-carousel-prev" data-target="#recently-added-products-carousel" class="slider-prev"><i class="fa fa-angle-left"></i></a>
                                        <a href="#products-carousel-next" data-target="#recently-added-products-carousel" class="slider-next"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </header>

                                <div id="recently-added-products-carousel">
                                    <div class="woocommerce columns-6">
                                       
                                        <div class="products owl-carousel recently-added-products products-carousel columns-6">
                                            @foreach($related_products as $new_arrival)
                                            <div class="product">
                                                <div class="product-outer">
                                                    <div class="product-inner">
                                                        <span class="loop-product-categories"><a href="product-category.html" rel="tag">{{$new_arrival->category_name}}</a></span>
                                                        <a href="{{url('product/detail/'.$new_arrival->p_id)}}">
                                                            <h3>{{$new_arrival->name}}</h3>
                                                            <div class="product-thumbnail">
                                                                <img src="{{asset('uploads/products/featured_images/250/'.$new_arrival->featured_image)}}" data-echo="{{asset('uploads/products/featured_images/250/'.$new_arrival->featured_image)}}" class="img-responsive" alt="">
                                                            </div>
                                                        </a>

                                                        <div class="price-add-to-cart">
                                                            <span class="price">
                                                                <span class="electro-price">
                                                                    <ins><span class="amount">US @if($new_arrival->discount > 0)  {{$new_arrival->price - ($new_arrival->price / 100 * $new_arrival->discount) }} @else {{$new_arrival->price}}@endif</span></ins>
                                                                </span>
                                                                @if($new_arrival->discount > 0) 
                                                                <div>
                                                                    <del>
                                                                        <span class="amount">US {{$new_arrival->price}} </span>
                                                                    </del>
                                                                    <span style="font-size: 0.6em;"> | {{$new_arrival->discount}} % off</span>
                                                              
                                                                </div>
                                                                @endif
                                                            </span>
                                                        </div><!-- /.price-add-to-cart -->

                                                        <div class="hover-area">
                                                            <div class="action-buttons">

                                                                <a href="#" rel="nofollow" class="add_to_wishlist"> Wishlist</a>

                                                                <a href="compare.html" class="add-to-compare-link"> Compare</a>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.product-inner -->
                                                </div><!-- /.product-outer -->
                                            </div><!-- /.products -->
                                            @endforeach


                        </main><!-- /.site-main -->
                    </div><!-- /.content-area -->
                </div><!-- /.container -->
            </div><!-- /.site-content -->
            <script>
                var burl = "{{url('/')}}";
            </script>
@endsection
@section('js')
<script src="{{asset('fronts/assets/js/rate.js')}}"></script>
<script src="{{asset('fronts/assets/js/add-wishlist.js')}}"></script>
<!-- <script src="{{asset('fronts/assets/js/add-to-cart_multi.js')}}"></script> -->
@endsection