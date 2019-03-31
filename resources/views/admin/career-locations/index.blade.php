@extends('layouts.career')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <strong>Career Location List</strong>&nbsp;&nbsp;
        <a href="{{url('/admin/career-location/create')}}"><i class="fa fa-plus"></i> New</a>
        <hr>
        <table class="tbl">
            <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php($i=1)
                @foreach($career_locations as $c)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$c->name}}</td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="{{url('admin/career-location/edit/'.$c->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger" href="{{url('/admin/career-location/delete/'.$c->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table><br>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_career_location").addClass("current");
        })
    </script>
@endsection