
@extends("layouts.owner")
@section('content')  
    <div class="container">
        <div class="col-sm-12">
            <strong>List product colors</strong>&nbsp;&nbsp;
            <a href="{{url('/owner/detail-product/')}}/{{request()->route('id')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>&nbsp;&nbsp;
            <hr>
                <div>
                    @if(Session::has('sms3'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                {{session('sms3')}}
                            </div>
                        </div>
                    @endif
                    @if(Session::has('sms4'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                {{session('sms4')}}
                            </div>
                        </div>
                    @endif
                </div>
                <div>
                    <form action="{{url('/owner/product-color/photo/save')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <p></p>
                        <div class="row">   
                        <div class="col-md-12">                   
                        <input type="hidden" name="product_id" value="{{request()->route('id')}}">
                        <div class="form-group row">
                            <label for="name" class="control-label col-sm-2 lb">Color Name <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" required id="name" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo" class="control-label col-sm-2 lb">Image  (<span class="text-danger">600px <span style="color:#022;">x</span> 600px</span>)</label>
                            <div class="col-sm-5">
                                <input type="file" class="form-control"​ required id="photo" name="photo">
                            </div>
                            <div class="col-sm-1">
                                <button class="btn btn-success" type="submit">Upload</button>
                            </div>
                        </div>
                        <br>
                        <table class="tbl table-bordered">
                    <thead>
                        <tr>
                            <th>&numero;</th>
                            <th>Color Name</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach($colors as $p)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$p->name}}</td>
                            <td>
                                <img src="{{asset('uploads/products/colors/180/'.$p->photo)}}" alt="" width="100">
                            </td>
                            <td>
                                <a href="{{url('owner/product-color/photo/delete/'.Crypt::encryptString($p->id) . '?pid='.Crypt::encryptString($p_id))}}" onclick="return confirm('You want to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>   
            </form>
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#shop-menu li a").removeClass("active");
            $("#my-product").addClass("active");
        });
    </script>
@endsection