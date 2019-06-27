@extends("layouts.product")
@section('content')
<div class="row">
    <div class="col-lg-12">
        <strong>Main Menu List</strong>&nbsp;&nbsp;
        <a href="{{url('/admin/menu-one/create')}}"><i class="fa fa-plus"></i> New</a>
        <hr>
        <table class="tbl">
            <thead>
            <tr>
                <th>&numero;</th>
                <th>Name</th>
                <th>Icon</th>
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
            @foreach($menu_ones as $c)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$c->name}}</td>
                    <td><img src="{{asset('uploads/menu-ones/'.$c->icon)}}" alt="" width="25"></td>
                    <td>
                        <a class="btn btn-success btn-sm" href="{{url('/admin/menu-one/edit/'.$c->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a  class="btn btn-danger btn-sm" href="{{url('/admin/menu-one/delete/'.$c->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <nav>
            {{$menu_ones->links()}}
        </nav>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_main_menu").addClass("current");
        })
    </script>
@endsection