@extends('layouts.owner')
@section('content')
<?php 
    $owner_id = session('shop_owner')->id;
    $owner = DB::table('shop_owners')
    ->join('shops', 'shops.shop_owner_id', 'shop_owners.id')
    ->select('shops.active as active')
    ->where('shop_owners.id', $owner_id)->first();
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
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
            <strong>Product List</strong>&nbsp;&nbsp;
            <a href="{{url('/owner/new-product')}}"><i class="fa fa-plus"></i> New</a> 
            <div class="float-right">
            <form action="{{url('/owner/my-product')}}" class="form-inline" method="get">
                <div class="form-group">
                    <label for="name">Search&nbsp;&nbsp;</label>
                    <input type="text" class="form-control" id="q" name="q" value="{{$query}}" >
                    <button type="submit"  style="padding:3px 8px 3px 8px;" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
                </div>
            </form>
            </div>
           
            <hr>
            <table class="tbl display table-bordered"  id="table_id">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Featured Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price ($)</th>
                    <th>Items</th>
                    <!-- <th>Best Deal</th>
                    <th>Best Seller</th> -->
                    <th>Actions</th>
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
                            <a href="{{url('/owner/detail-product/'.Crypt::encryptString($c->id))}}">{{$c->name}}</a>
                        </td>
                        <td>{{$c->cname}} </td>
                        <td>{{$c->price}} $</td>
                        <td>{{$c->quantity}} </td>
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

                            <a class="btn btn-primary btn-xs" style="background: #ff4d4d;" href="{{url('/owner/product/promotion/'.Crypt::encryptString($c->id))}}" title="Promotion"><i class="fa fa-tag"></i></a>
                            <a class="btn btn-info btn-xs" href="{{url('/owner/detail-product/'.Crypt::encryptString($c->id)) }}" title="Detail"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-warning btn-xs" href="{{url('/owner/edit-product/'.Crypt::encryptString($c->id))}}" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-danger btn-xs" href="{{url('/owner/delete-product/'.Crypt::encryptString($c->id) ."?page=".@$_GET['page'])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
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