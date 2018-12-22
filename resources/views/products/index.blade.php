@extends("layouts.product")
@section('content')
<div class="row">
    <div class="col-lg-12">
        <strong>Product List</strong>&nbsp;&nbsp;
        <a href="{{url('/admin/product/create')}}"><i class="fa fa-plus"></i> New</a> 
        <div class="float-right">
        <form action="{{url('/admin/product')}}" class="form-inline" method="get">
            <div class="form-group">
                <label for="name">Search&nbsp;&nbsp;</label>
                <input type="text" class="form-control" id="q" name="q" value="{{$query}}" >
                <button type="submit"  style="padding:8px;" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
            </div>
        </form>
        </div>
       
        <hr>
        <table class="tbl display"  id="table_id">
            <thead>
            <tr>
                <th>&numero;</th>
                <th>Featured Image</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Best Deal</th>
                <th>Best Seller</th>
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
                    <td>{{$i++}}</td>
                    <td><img src="{{asset('uploads/products/featured_images/180/'.$c->featured_image)}}" alt="" width="50"></td>
                    <td>
                        <a href="{{url('/admin/product/detail/'.$c->id)}}">{{$c->name}}</a>
                    </td>
                    <td>{{$c->price}} $</td>
                    <td>@if($c->best_deal== 0)
                        <a class="btn btn-danger btn-sm" href="{{url('admin/product/best-deal/'.$c->id ."?page=".@$_GET["page"])}}" onclick="return confirm('Add to best seller?')" title="your want to add to best deal?"><i class="fa fa-star-o"></i></a>
                        @else
                        <a class="btn btn-success btn-sm" href="{{url('admin/product/best-deal/return/'.$c->id ."?page=".@$_GET["page"])}}" onclick="return confirm('you want to return to best deal?')" title="return to best deal"><i class="fa fa-star-o"></i></a>
                        @endif </td>
                    
                    <td width="50"> 
                        @if($c->best_seller == 0)
                            <a class="btn btn-danger btn-sm" href="{{url('admin/product/best-seller/'.$c->id ."?page=".@$_GET["page"])}}" onclick="return confirm('you want to add to best seller?')" title="add to best seller"><i class="fa fa-check"></i></a>
                        @else
                            <a class="btn btn-success btn-sm" href="{{url('admin/product/best-seller/return/'.$c->id ."?page=".@$_GET["page"])}}" onclick="return confirm('you want to return simple seller?')" title="add to best seller"><i class="fa fa-check"></i></a>
                        @endif </td>
                    <td width="95">
                        <a class="btn btn-info btn-sm" href="{{url('/admin/product/detail/'.$c->id)}}" title="Detail"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-warning btn-sm" href="{{url('/admin/product/edit/'.$c->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-sm" href="{{url('/admin/product/delete/'.$c->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <nav>
            {{$products->links()}}
        </nav>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_product").addClass("current");
        })
    </script>
@endsection