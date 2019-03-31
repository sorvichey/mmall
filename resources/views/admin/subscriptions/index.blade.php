@extends('layouts.customer')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <strong>Subscription List</strong>&nbsp;&nbsp;
        <a href="{{url('/admin/subscription/create')}}" class="text-primary"><i class="fa fa-plus"></i> New</a>
        <hr>
        <hr>
        <table class="tbl">
            <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Product Post</th>
                    <th>Duration</th>
                    <th>Status</th>
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
                @foreach($subscriptions as $s)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$s->name}}</td>
                        <td>{{$s->price}}</td>
                        <td>{{$s->posted_product}}</td>
                        <td>{{$s->duration}}</td>
                        <td>@if($s->active==1) <i class="text-success">Active</i> @else <i class="text-warning">Unactive</i> @endif</td>
                        <td>
                            <a class="btn btn-sm btn-info" href="{{url('/admin/subscription/detail/'.$s->id)}}" title="Detail"><i class="fa fa-eye"></i></a>
                           
                            <a class="btn btn-sm btn-warning" href="{{url('/admin/subscription/edit/'.$s->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger" href="{{url('/admin/subscription/delete/'.$s->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
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
            $("#menu_subscription").addClass("current");
        })
    </script>
@endsection