@extends('layouts.customer')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <strong>Rater List</strong>&nbsp;&nbsp;
        <hr>
        <table class="tbl">
            <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Product Name</th>
                    <th>Rate Number</th>
                    <th>Comment</th>
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
                @foreach($rate as $r)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$r->name}}</td>
                        <td>{{$r->rate}}</td>
                        <td>{{$r->description}}</td>
                        <td>@if($r->approve == 0 )Pending @else Approved @endif</td>
                        <td>
                            <a class="btn btn-sm @if($r->approve==0) btn-warning @else btn-success @endif" href="{{url('admin/rate/approve/'.$r->id ."?page=".@$_GET["page"])}}" title="@if($r->approve==0) Apprvoe @else De-Approve @endif"><i class="fa @if($r->approve==0) fa-eye-slash @else fa-eye @endif"></i></a>
                            <a class="btn btn-sm btn-danger" href="{{url('/admin/rate/delete/'.$r->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
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
            $("#menu_rate").addClass("current");
        })
    </script>
@endsection