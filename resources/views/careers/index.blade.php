@extends('layouts.career')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <strong>Career List</strong>&nbsp;&nbsp;
        <a href="{{url('/admin/career/create')}}"><i class="fa fa-plus"></i> New</a>
        <hr>
        <table class="tbl">
            <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Position</th>
                    <th>Gender</th>
                    <th>Dateline</th>
                    <th>Type</th>
                    <th>Hire</th>
                    <th>Category</th>
                    <th>Department</th>
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
                @foreach($careers as $c)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
                            <a href="{{url('admin/career/detail/'.$c->id)}}" title="Detail">
                                {{$c->key_position}}
                            </a>
                        </td>
                        <td>{{$c->gender}}</td>
                        <td>{{$c->dateline}}</td>
                        <td>{{$c->type}}</td>
                        <td>{{$c->hire}}</td>
                        <td>{{$c->category}}</td>
                        <td>{{$c->department}}</td>

                        <td>
                            <a class="btn btn-sm btn-warning" href="{{url('admin/career/edit/'.$c->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger" href="{{url('/admin/career/delete/'.$c->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table><br>
        {{$careers->links()}}
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_career").addClass("current");
        })
    </script>
@endsection