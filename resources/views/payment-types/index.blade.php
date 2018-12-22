@extends("layouts.setting")
@section('content')
<div class="row">
    <div class="col-lg-12">
        <strong>Payment Type List</strong>&nbsp;&nbsp;
        <a href="{{url('/admin/payment-type/create')}}"><i class="fa fa-plus"></i> New</a>
        <hr>
        <table class="tbl">
            <thead>
            <tr>
                <th>&numero;</th>
                <th>Photo</th>
                <th>Name</th>
                <th>URL</th>
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
            @foreach($payment_types as $p)
                <tr>
                    <td>{{$i++}}</td>
                    <td><img src="{{asset('uploads/payment_types/'.$p->photo)}}" alt="" width="40"></td>
                    <td>{{$p->name}}</td>
                    <td>{{$p->url}}</td>
                    <td>{{$p->order}}</td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="{{url('/admin/payment-type/edit/'.$p->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-sm btn-danger" href="{{url('/admin/payment-type/delete/'.$p->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$payment_types->links()}}
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_payment_type").addClass("current");
        })
    </script>
@endsection