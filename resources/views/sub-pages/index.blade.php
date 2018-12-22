@extends('layouts.setting')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <strong>Page List</strong>&nbsp;&nbsp;
        <a href="{{url('/admin/sub-page/create')}}"><i class="fa fa-plus"></i> New</a>
        <hr>
        <table class="tbl">
            <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Title</th>
                    <th>Page Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php($i=1)
                @foreach($sub_pages as $pag)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$pag->title}}</td>
                        <td>{{$pag->page_name}}</td>
                        <td>
                            <a class="btn btn-sm btn-info" href="{{url('admin/sub-page/detail/'.$pag->id)}}" title="Detail"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-sm btn-warning" href="{{url('admin/sub-page/edit/'.$pag->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger" href="{{url('/admin/sub-page/delete/'.$pag->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table><br>
        {{ $sub_pages->links() }}
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_sub_page").addClass("current");
        })
    </script>
@endsection