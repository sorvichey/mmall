@extends('layouts.buyer')
@section('content')
<div tabindex="-1" class="site-content" id="content">
    <div class="container">
        <nav class="woocommerce-breadcrumb"><a href="{{url('/')}}">Home</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>
            Wishlist
        </nav>
        <div class="content-area" id="primary">
            <main class="site-main" id="main">
                <article class="page type-page status-publish hentry">
                    <div itemprop="mainContentOfPage" class="entry-content">
                        <div id="yith-wcwl-messages"></div>
                        <form class="woocommerce" method="post" id="yith-wcwl-form">
                            <input type="hidden" value="68bc4ab99c" name="yith_wcwl_form_nonce" id="yith_wcwl_form_nonce"><input type="hidden" value="/electro/wishlist/" name="_wp_http_referer">
                            <table data-token="" data-id="" data-page="1" data-per-page="5" data-pagination="no" class="shop_table cart wishlist_table">
                                <thead>
                                    <tr>
                                        <th class="product-remove"></th>
                                        <th class="product-thumbnail"></th>
                                        <th class="product-name">
                                            <span class="nobr">Product Name</span>
                                        </th>
                                        <th class="product-price">
                                            <span class="nobr">Unit Price</span>
                                        </th>
                                        <th class="product-stock-stauts">
                                            <span class="nobr">Stock Status</span>
                                        </th>
                                        <th class="product-add-to-cart"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($wishes as $w)
                                    <tr>
                                        <td>
                                            <a href="{{url('buyer/wishlist/delete/'.$w->w_id."?page=".@$_GET["page"])}}" title="Delete"><i class="fa fa-trash-o text-danger"></i></a>
                                        </td>
                                        <td class="product-thumbnail">
                                            <a href="{{url('product/detail/'.$w->p_id)}}"><img width="180" height="180" alt="1" class="wp-post-image" src="{{asset('uploads/products/featured_images/250/'.$w->featured_image)}}"></a>
                                        </td>
                                        <td class="product-name">
                                            <a href="{{url('product/detail/'.$w->p_id)}}">{{$w->name}}</a>
                                        </td>
                                        <td class="product-price">
                                            <span class="electro-price"><span class="amount">$ @if($w->discount > 0)  {{$w->price - ($w->price / 100 * $w->discount) }} @else {{$w->price}}@endif</span></span>
                                        </td>
                                        <td class="product-stock-status">
                                        @if($w->quantity > 0 )<span class="text-success">In stock </span> @else<span class="text-danger"> Out Stock </span> @endif</span>
                                        </td>
                                        <td width="170" class="product-add-to-cart ">
                                            <a href="#" class="button" > Add to Cart</a>
                                        </td>
                                    </tr>
                                    @endforeach
                            </table>
                            <div class="shop-control-bar-bottom">
                                <nav class="woocommerce-pagination">
                                    <ul class="page-numbers">
                                        <li>
                                            {{$wishes->links()}}
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </form>
                    </div>
                </article>
            </main>
        </div>
    </div>
</div>
@endsection