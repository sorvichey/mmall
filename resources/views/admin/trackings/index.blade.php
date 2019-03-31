@extends("layouts.tracking")
@section('content')
<div class="row">
    <div class="col-lg-12">
        <strong>Tracking List</strong>&nbsp;&nbsp;
        <a href="{{url('/admin/tracking/create')}}"><i class="fa fa-plus"></i> New</a>
        <hr>
        <table class="tbl">
            <thead>
            <tr>
                <th>&numero;</th>
                <th>Waybill</th>
                <th>Origin</th>
                <th>Destination</th>
                <th>PCS</th>
                <th>Date Time</th>
                <th>Status</th>
                <th>Receiver</th>
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
            @foreach($trackings as $t)
                <tr>
                    <td>{{$i++}}</td>
                    <td><a href="{{url('admin/tracking/detail/'.$t->id)}}">{{$t->waybill}}</a></td>
                    <td>{{$t->origin}}</td>
                    <td>{{$t->destination}}</td>
                    <td>{{$t->pcs}}</td>
                    <td>{{$t->datetime}}</td>
                    <td>{{$t->status}}</td>
                    <td>{{$t->receiver}}</td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="{{url('/admin/tracking/edit/'.$t->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-sm btn-danger" href="{{url('/admin/tracking/delete/'.$t->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$trackings->links()}}
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_tracking").addClass("current");
        })
    </script>
@endsection