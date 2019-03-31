@extends('layouts.setting')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <strong>Phone Support List</strong>&nbsp;&nbsp;
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
                @foreach($phone_support as $p)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$p->phone}}</td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="{{url('admin/phone-support/edit/'.$p->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
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
            $("#menu_phone_support").addClass("current");
        })
    </script>
@endsection