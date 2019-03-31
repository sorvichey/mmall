@extends("layouts.product")
@section('content')
<div class="row">
    <div class="col-lg-12">
        <strong>Product Stutus List</strong>&nbsp;&nbsp;
        <a href="{{url('/admin/product-status/create')}}"><i class="fa fa-plus"></i> New</a>
        <hr>
        <table class="tbl">
            <thead>
            <tr>
                <th>&numero;</th>
                <th>Name</th>
                <th>Order</th>
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
            @foreach($product_status as $c)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$c->name}}</td>
                    <td>{{$c->order}}</td>
                    <td>
                        <a class="btn-sm btn btn-warning" href="{{url('/admin/product-status/edit/'.$c->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a class="btn-sm btn btn-danger"  href="{{url('/admin/product-status/delete/'.$c->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <nav>
            {{$product_status->links()}}
        </nav>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_product_status").addClass("current");
        })
    </script>
@endsection