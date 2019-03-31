@extends("layouts.product")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>Brand List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/brand/create')}}"><i class="fa fa-plus"></i> New</a>
            <hr>
            <table class="tbl">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Name</th>
                    <th>Icon</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $pagex = @$_GET['page'];
                if(!$pagex)
                    $pagex = 1;
                $i = 18 * ($pagex - 1) + 1;
                ?>
                @foreach($product_brands as $c)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$c->name}}</td>
                        <td><img src="{{asset('uploads/products/brands/'.$c->icon)}}" width="60" alt=""></td>
                        <td>
                            @if($c->top_brand== 0)
                                <form action="{{url('/admin/brand/top')}}"  method="post" id="frm" class="form-horizontal">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" value="{{$c->id}}">
                                        <button class="btn btn-primary btn-sm" type="submit" title="Add To Top Brand"><i class="fa fa-arrow-up"></i></button>
                                    </div>
                                </form>
                            @else
                                <form action="{{url('/admin/brand/down')}}"  method="post" id="frm" class="form-horizontal">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" value="{{$c->id}}">
                                    <button class="btn btn-success btn-sm" type="submit" title="Add To Simple Brand"><i class="fa fa-arrow-down"></i> </button> <i class="fa fa-bookmark-o float-right"> Top Brand</i>
                                    </div>
                                </form>
                            @endif
                        </td>
                        <td>
                            <a class="btn-sm btn btn-warning" href="{{url('/admin/brand/edit/'.$c->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn-sm btn btn-danger"  href="{{url('/admin/brand/delete/'.$c->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                {{$product_brands->links()}}
            </nav>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_product_brand").addClass("current");
        })
    </script>
@endsection