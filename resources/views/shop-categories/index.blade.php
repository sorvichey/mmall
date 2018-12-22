@extends("layouts.product")
@section('content')
<div class="row">
    <div class="col-lg-12">
        <strong>Shop Category List</strong>&nbsp;&nbsp;
        <a href="{{url('/admin/shop-category/create')}}"><i class="fa fa-plus"></i> New</a>
        <hr>
        <table class="tbl">
            <thead>
            <tr>
                <th>&numero;</th>
                <th>Name</th>
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
            @foreach($categories as $c)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$c->name}}</td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="{{url('/admin/shop-category/edit/'.$c->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a  class="btn btn-danger btn-sm" href="{{url('/admin/shop-category/delete/'.$c->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <nav>
            {{$categories->links()}}
        </nav>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_shop_category").addClass("current");
        })
    </script>
@endsection