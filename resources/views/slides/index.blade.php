@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>Slide List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/slide/create')}}"><i class="fa fa-plus"></i> New</a>
            <hr>
            <table class="tbl">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Photo</th>
                    <th>Title</th>
                    <th>Short Description</th>
                    <th>Discount %</th>
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
                @foreach($slides as $slide)
                    <tr>
                        <td>{{$i++}}</td>
                        <td><img src="{{asset('uploads/slides/'.$slide->photo)}}" alt="" width="100"></td>
                        <td>{{$slide->title}}</td>
                        <td>{{$slide->short_description}}</td>
                        <td>{{$slide->discount}} %</td>
                        <td>{{$slide->url}}</td>
                        <td>{{$slide->order}}</td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="{{url('/admin/slide/edit/'.$slide->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger" href="{{url('/admin/slide/delete/'.$slide->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$slides->links()}}
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_slide_show").addClass("current");
        })
    </script>
@endsection