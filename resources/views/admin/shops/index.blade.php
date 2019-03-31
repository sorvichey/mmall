@extends("layouts.customer")
@section('content')
<div class="row">
    <div class="col-lg-12">
        <strong>Shop Category List</strong>&nbsp;&nbsp;
        <hr>
        <table class="tbl">
            <thead>
            <tr>
                <th>&numero;</th>
                <th>Name</th>
                <th>Shop Category</th>
                <th>phone</th>
                <th>Email</th>
                <th>Active</th>
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
            @foreach($shops as $s)
                <tr>
                    <td>{{$s->id}}</td>
                    <td>{{$s->name}}</td>
                    <td>{{$s->category}}</td>
                    <td>{{$s->phone}}</td>
                    <td>{{$s->email}}</td>
                    <td>
                        @if($s->active==1)
                        <span class="text-success">Approved</span>
                        @else
                        <span class="text-danger">Pendding</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{url('admin/shops/approve/'.$s->id)}}" class="btn btn-sm btn-success" onclick="return confirm('Are you sure want to approve this shop?')" title="Approve"><i class="fa fa-check"></i></a>
                        <a href="{{url('admin/shops/disable/'.$s->id."?page=".@$_GET["page"])}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to disable this shop?')" title="Disabl"><i class="fa fa-times"></i></a>
                        <a href="{{url('/admin/shops/detail/'.$s->id)}}" class="btn btn-sm btn-primary" title="Approve"><i class="fa fa-eye"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <nav>
            {{$shops->links()}}
        </nav>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_shop").addClass("current");
        })
    </script>
@endsection