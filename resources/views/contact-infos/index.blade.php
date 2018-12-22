@extends('layouts.setting')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <strong>Contact Info List</strong>&nbsp;&nbsp;
        <a href="{{url('/admin/contact-info/create')}}"><i class="fa fa-plus"></i> New</a>
        <hr>
        <table class="tbl">
            <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php($i=1)
                @foreach($contact_infos as $c)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$c->address}}</td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="{{url('admin/contact-info/edit/'.$c->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger" href="{{url('/admin/contact-info/delete/'.$c->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
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
            $("#menu_contact_info").addClass("current");
        })
    </script>
@endsection