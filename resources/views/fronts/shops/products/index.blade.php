@extends('layouts.shop-admin')
@section('content')
<?php 
    $owner_id = session('shop_owner')->id;
    $owner = DB::table('shop_owners')
    ->join('shops', 'shops.shop_owner_id', 'shop_owners.id')
    ->select('shops.active as active')
    ->where('shop_owners.id', $owner_id)->first();
?>
<!-- Page Heading -->
<h3>Products</h3>
<hr style="border: 1px solid blue;">
    <div class="row">
        <div class="col-md-12">
            @if($owner==null)
            <br>
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        Please create your shop first!
                    </div>
                </div>
            @elseif($owner->active==0)
            <br>
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        Before you can post your product(s)!
                        <br>
                        You have to wait 24 hours or less than 24 hours for us to evaluate your store.
                    </div>
                </div>
            @else
            
            <a href="{{url('/owner/new-product')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> New</a> 
            <div class="float-right">
            <form action="{{url('/owner/my-product')}}" class="form-inline" method="get">
                <div class="form-group">
                    <label for="name">Search&nbsp;&nbsp;</label>
                    <input type="text" class="form-control" id="q" name="q" value="{{$query}}" >
                    <button type="submit"   class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
                </div>
            </form>
            </div>
           
            <hr>
            <table class="tbl display table-bordered"  id="table_id">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>IMAGE</th>
                    <th>NAME</th>
                    <th>CATEGORY</th>
                    <th>PRICE</th>
                    <th>SELL PRICE</th>
                    <th>QUANTITY</th>
                    <!-- <th>Best Deal</th>
                    <th>Best Seller</th> -->
                    <th>ACTIONS</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $pagex = @$_GET['page'];
                    if(!$pagex)
                        $pagex = 1;
                    $i = 18 * ($pagex - 1) + 1;
                ?>
                @foreach($products as $c)
                    <tr>
                        <td width="20">{{$i++}}</td>
                        <td width="100"><img src="{{asset('uploads/products/featured_images/180/'.$c->featured_image)}}" alt="" width="50"></td>
                        <td>
                            <a href="{{url('/owner/detail-product/'.base64_encode($c->id))}}">{{$c->name}}</a>
                        </td>
                        <td>{{$c->cname}} </td>
                        <td>{{$c->price}} $</td>
                        <td>{{$c->price}} $</td>
                        <td width="10">{{$c->quantity}} </td>
                        <!-- <td width="30">@if($c->best_deal== 0)
                            <a class="btn btn-danger btn-xs" href="{{url('owner/product/best-deal/'.$c->id ."?page=".@$_GET["page"])}}" onclick="return confirm('Add to best deal?')" title="your want to add to best deal?"><i class="fa fa-star-o"></i></a>
                            @else
                            <a class="btn btn-success btn-xs" href="{{url('owner/product/best-deal/return/'.$c->id ."?page=".@$_GET["page"])}}" onclick="return confirm('you want to return to best deal?')" title="return to best deal"><i class="fa fa-star-o"></i></a>
                            @endif </td>
                        
                        <td width="30"> 
                            @if($c->best_seller == 0)
                                <a class="btn btn-danger btn-xs" href="{{url('owner/product/best-seller/'.$c->id ."?page=".@$_GET["page"])}}" onclick="return confirm('you want to add to best detail?')" title="add to best seller"><i class="fa fa-check"></i></a>
                            @else
                                <a class="btn btn-success btn-xs" href="{{url('owner/product/best-seller/return/'.$c->id ."?page=".@$_GET["page"])}}" onclick="return confirm('you want to return simple seller?')" title="add to best seller"><i class="fa fa-check"></i></a>
                            @endif </td> -->
                        <td width="150">
                        <div class="dropdown">
                            <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Actions
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('/owner/product/promotion/'.base64_encode($c->id))}}">Promotion</a></li>
                                <li><a href="{{url('/owner/detail-product/'.base64_encode($c->id)) }}">Detail</a></li>
                                <li><a href="{{url('/owner/edit-product/'.base64_encode($c->id))}}">Edit</a></li>
                                <li><a href="{{url('/owner/delete-product/'.base64_encode($c->id) ."?page=".@$_GET['page'])}}" onclick="return confirm('You want to delete?')">Delete</a></li>
                            </ul>
                            </div>
                           
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                {{$products->links()}}
            </nav>
          
            @endif
        </div>
    </div>
@endsection

@section('js')
   <script type="text/javascript">

        $(document).ready(function () {
            $("#shop-menu li a").removeClass("active");
            $("#my-product").addClass("active");
        });
    
    </script>
@endsection