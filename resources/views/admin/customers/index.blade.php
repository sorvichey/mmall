@extends('layouts.customer')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <strong>Buyer List</strong>&nbsp;&nbsp;
        <hr>
        <table class="tbl">
            <thead>
                <tr>
                    <th>&numero;</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $pagex = @$_GET['page'];
                    if(!$pagex)
                        $pagex = 1;
                    $i = 18 * ($pagex - 1) + 1;
                ?>
                @foreach($buyers as $c)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$c->first_name}}</td>
                        <td>{{$c->last_name}}</td>
                        <td>{{$c->email}}</td>
                        <td>{{$c->phone}}</td>
                        <td>{{$c->gender}}</td>
                        <td>
                        <a class="btn btn-sm btn-info" href="{{url('admin/buyer/detail/'.$c->id)}}" title="Detail"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-sm btn-secondary" href="{{url('admin/buyer/reset-password/'.$c->id)}}" title="Reset Password"><i class="fa fa-key"></i></a>
                            <a class="btn btn-sm btn-warning" href="{{url('admin/buyer/edit/'.$c->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger" href="{{url('/admin/buyer/delete/'.$c->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_buyer").addClass("current");
        })
    </script>
@endsection