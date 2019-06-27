@extends("layouts.product")
@section('content')
<div class="row">
    <div class="col-lg-12">
        <strong>New Main Menu </strong>&nbsp;&nbsp;
        <a href="{{url('/admin/menu-one')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
        <hr>
        @if(Session::has('sms'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div>
                    {{session('sms')}}
                </div>
            </div>
        @endif
        @if(Session::has('sms1'))
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div>
                    {{session('sms1')}}
                </div>
            </div>
        @endif
        <form action="{{url('/admin/menu-one/update')}}" enctype="multipart/form-data" method="post" id="frm" class="form-horizontal">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$menu_one->id}}">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Shop Category<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="category" id="category" class="form-control chosen-select">
                                @foreach($categories as $c)
                                    <option value="{{$c->id}}" {{$c->id==$menu_one->shop_category_id?'selected':''}}>{{$c->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="control-label col-sm-3 lb">Name <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="name" name="name" class="form-control" value="{{$menu_one->name}}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="icon" class="control-label col-sm-3 lb">Icon <span class="text-danger">(64 x 64)</span></label>
                        <div class="col-sm-9">
                            <input type="file" value="" name="icon" id="icon" class="form-control" onchange="loadFile(event)">
                            <br>
                            <img src="" alt="" width="72" id="preview">
                        </div>
                    </div>
                    <div class="form-group row">
                    <label class="control-label col-sm-3 lb"></label>
                        <div class="col-sm-9">
                            <p></p>
                            <button class="btn btn-primary btn-flat" type="submit">Update</button>
                            <button class="btn btn-danger btn-flat" type="reset" id="btnCancel">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <strong>Sub Menu 1 List</strong>&nbsp;&nbsp;
        <hr>
        @if(Session::has('sms2'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div>
                    {{session('sms2')}}
                </div>
            </div>
        @endif
        <form action="{{url('/admin/menu-two/save')}}" method="post" id="frm" class="form-horizontal">
            {{csrf_field()}}
            <input type="hidden" name="menu_one_id" value="{{$menu_one->id}}">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="name" class="control-label col-sm-3 lb">Name <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-primary btn-flat" type="submit">Add</button>
                    <button class="btn btn-danger btn-flat" type="reset" id="btnCancel">Cancel</button>
                </div>
            </div>
        </form>
        <table class="tbl">
            <thead>
            <tr>
                <th>&numero;</th>
                <th>Name</th>
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
            @foreach($menu_twos as $c)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$c->name}}</td>
                    <td>
                        <a class="btn btn-success btn-sm" href="{{url('/admin/menu-two/edit/'.$c->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a  class="btn btn-danger btn-sm" href="{{url('/admin/menu-two/delete/'.$c->id ."?main_menu=".$c->menu_one_id)}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <nav>
            {{$menu_twos->links()}}
        </nav>
    </div>
</div>
@endsection
@section('js')
    <script>
        function loadFile(e){
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(e.target.files[0]);
        }
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_main_menu").addClass("current");
        })
    </script>
@endsection