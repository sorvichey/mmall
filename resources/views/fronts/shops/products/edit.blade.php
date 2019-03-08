@extends("layouts.owner")
@section('content')
<div class="container">
    <div class="row">
    <div class="col-lg-12">
        <strong>Edit Product</strong>&nbsp;&nbsp;
        <a href="{{url('/owner/detail-product/'.$product->id)}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
        <form action="{{url('/owner/save-edit-product')}}" method="post" id="frm" class="form-horizontal" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$product->id}}">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="name" class="control-label col-sm-3 lb">Product Name<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="name" name="name" value="{{$product->name}}" class="form-control" autofocus required value="{{old('name')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="short_description" class="control-label col-sm-3 lb">Short Description</label>
                        <div class="col-sm-9">
                            <textarea name="short_description" id="" rows="3" class="form-control">{{$product->short_description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Category<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="category" id="category" class="form-control chosen-select">
                                @foreach($categories as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="quantity" class="control-label col-sm-3 lb">Quantity<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="quantity" min="0" value="{{$product->quantity}}" name="quantity" step="1" value="1" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="control-label col-sm-3 lb">Price $<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="price" name="price"  value="{{$product->price}}" step="0.1"  min="0" value="0" required>
                        </div>
                    </div>
                   
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="condition" class="control-label col-sm-3 lb">Condiction</label>
                        <div class="col-sm-9">
                            <select name="condiction" id="condiction" class="form-control">
                                <option value="New" {{$product->condiction=='New'?'selected':''}}>New</option>
                                <option value="Second Hand" {{$product->condiction=='Second Hand'?'selected':''}}>Sencond Hand</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brand" class="control-label col-sm-3 lb">Brand</label>
                        <div class="col-sm-9">
                            <select name="brand" id="brand" class="form-control chosen-select">
                                @foreach($brands as $c)
                                    <option value="{{$c->id}}" {{$product->brand_id==$c->id?'selected':''}}>{{$c->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="photo" class="control-label col-sm-3 lb">Featured Photo (<span class="text-danger">600px <span style="color:#022;">x</span> 600px</span>)</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" id="photo" name="photo" onchange="loadFile(event)"><p></p>
                            <div>
                                <img src="{{asset('uploads/products/featured_images/250/'.$product->featured_image)}}" alt="" width="87" style="border:1px solid #ccc" id="preview">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <p><strong>Description</strong></p>
                    <textarea name="description" id="description" cols="30" rows="10" required>{{$product->description}}</textarea>
                    <p></p>
                    <p>
                        <button class="btn btn-primary btn-flat" type="submit">Save Change</button>
                        <button class="btn btn-danger btn-flat" type="reset" id="btnCancel">Cancel</button>
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
@section('js')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('chosen/chosen.jquery.js')}}"></script>
    <script src="{{asset('chosen/chosen.proto.js')}}"></script>
    <script>
        function loadFile(e){
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(e.target.files[0]);
        }
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_product").addClass("current");
        });
        var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

  CKEDITOR.replace( 'description',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});
    </script>
@endsection