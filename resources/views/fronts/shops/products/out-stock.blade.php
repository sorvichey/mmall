@extends('layouts.shop-admin')
@section('content')
<?php 
    $owner_id = session('shop_owner')->id;
    $owner = DB::table('shop_owners')
    ->join('shops', 'shops.shop_owner_id', 'shop_owners.id')
    ->select('shops.active as active', 'shops.id as s_id')
    ->where('shop_owners.id', $owner_id)->first();
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
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
            <strong>List of Product Out of Stock </strong>&nbsp;&nbsp;
            <a href="{{url('/owner/new-product')}}"><i class="fa fa-plus"></i> New</a> 
           
            <hr>
            <table class="tbl display table-bordered"  id="table_id">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Featured Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price ($)</th>
                    <th>Quantity (item)</th>
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
                        <td width="200"><img src="{{asset('uploads/products/featured_images/180/'.$c->featured_image)}}" alt="" width="50"></td>
                        <td>
                            <a href="{{url('/owner/detail-product/'.$c->id)}}">{{$c->name}}</a>
                        </td>
                        <td width="150">{{$c->cname}}</td>
                        <td width="150">{{$c->price}} $</td>
                        <td width="150">{{$c->quantity}} </td>
                        
                        <td width="150">
                            <a href="{{url('/owner/edit-product/'.base64_encode($c->id))}}" class="btn btn-xs btn-success"><span class="fa fa-plus-circle"></span></a>
                            <a class="btn btn-info btn-xs" href="{{url('/owner/detail-product/'.base64_encode($c->id))}}" title="Detail"><i class="fa fa-eye"></i></a>
                            <!-- <a class="btn btn-warning btn-xs" href="{{url('/owner/edit-product/'.$c->id)}}" title="Edit"><i class="fa fa-pencil"></i></a> -->
                            <!-- <a class="btn btn-danger btn-xs" href="{{url('/owner/delete-product/'.$c->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a> -->
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

<!-- Modal -->
<div class="modal fade" id="add_qty" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Quantities</h4>
        </div>
        <form action="{{url('/owner/product/add-qty')}}" method="post">
            {{csrf_field()}}
            <div class="modal-body">
            <input type="hidden" id="product_id" name="id">
            <input type="hidden" value="{{base64_encode(@$owner->s_id)}}" name="shop_id">
                <span>Quantity(add total quantity):</span>
                <input type="number" class="form-control" id="qty" name="qty" placeholder="100" require autofocus>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-default" name="btn_save_change">Save As</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
</div>

@endsection

@section('js')
   <script type="text/javascript">

        $(document).ready(function () {
            $("#shop-menu li a").removeClass("active");
            $("#out-stock").addClass("active");

            // add row id to modal add_qty
            $(document).on("click", ".open_modal", function () {
                //get product id form button "data-id" and add to modal
                var row_id = $(this).data('id');
                $(".modal-body #product_id").val( row_id );
            });
        });

        
    
    </script>
@endsection