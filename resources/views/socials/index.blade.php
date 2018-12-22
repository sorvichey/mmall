@extends("layouts.setting")
@section('content')
<div class="row">
    <div class="col-lg-12">
        <strong>Social List</strong>&nbsp;&nbsp;
        <a href="{{url('/admin/social/create')}}"><i class="fa fa-plus"></i> New</a>
        <hr>
        <table class="tbl">
            <thead>
            <tr>
                <th>&numero;</th>
                <th>Icon</th>
                <th>Name</th>
                <th>Link URL</th>
                <th>Order</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $pagex = @$_GET['page'];
            if(!$pagex)
                $pagex = 1;
            $i = 12 * ($pagex - 1) + 1;
            ?>
            @foreach($socials as $s)
                <tr>
                    <td>{{$i++}}</td>
                    <td><i class="{{$s->fa_fa_icon}}"></i></td>
                    <td>{{$s->name}}</td>
                    <td>{{$s->url}}</td>
                    <td>{{$s->order}}</td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="{{url('/admin/social/edit/'.$s->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-sm btn-danger" href="{{url('/admin/social/delete/'.$s->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$socials->links()}}
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_social").addClass("current");
        })
    </script>
@endsection