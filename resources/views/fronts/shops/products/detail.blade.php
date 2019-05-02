@extends("layouts.owner")
@section('content')
<div class="container">
    <!-- <div class="row"> -->
    <div class="col-lg-12">
        <strong>Product Detail</strong>&nbsp;&nbsp;
        <a href="{{url('/owner/my-product')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>&nbsp;&nbsp;
        <a href="{{url('/owner/edit-product/'.Crypt::encryptString($product->id))}}" class="text-danger"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;
        <a href="{{url('/owner/new-product/')}}"><i class="fa fa-plus"></i> New</a>
        <hr>
        <form action="#" method="post" id="frm" class="form-horizontal">
            <input type="hidden" name="id" value="{{Crypt::encryptString($product->id)}}">
            <div class="col-md-12">
                 <div class="row">
                    <p class="bg-info">&nbsp;&nbsp;Basic info</p>                       
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="name" class="control-label col-sm-3 lb">Product Name</label>
                        <label class="control-label col-sm-9 lb">
                            : {{$product->name}}
                        </label>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="control-label col-sm-3 lb">Short Description</label>
                        <label class="control-label col-sm-9 lb">
                            : {{$product->short_description}}
                        </label>
                    </div>
                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Category</label>
                        <label class="control-label col-sm-9 lb">
                            : {{$product->cname}}
                        </label>
                    </div>
                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Brand</label>
                        <label class="control-label col-sm-9 lb">
                            : {{$product->brand}}
                        </label>
                    </div>
                    <div class="form-group row">
                        <label for="quantity" class="control-label col-sm-3 lb">Quantity</label>
                        <label class="control-label col-sm-9 lb">
                            : {{$product->quantity}}
                        </label>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="control-label col-sm-3 lb">Unit Price</label>
                        <label class="control-label col-sm-9 lb">
                            : {{$product->price}} $
                        </label>
                    </div>

                    @if($color->color == 1)
                    <div class="form-group row">
                        <label for="price" class="control-label col-sm-3 lb">Color(s)</label>
                        <label class="control-label col-sm-9 lb">: 
                         @foreach($colors as $co)
                         {{$co->name}},
                        @endforeach
                        </label>
                    </div>
                    @endif

                    @if($size->size == 1)
                    <div class="form-group row">
                        <label for="price" class="control-label col-sm-3 lb">Size(s)</label>
                        <label class="control-label col-sm-9 lb">: 
                         @foreach($sizes as $s)
                         {{$s->name}},
                        @endforeach
                        </label>
                    </div>
                    @endif

                   
                </div>
                <div class="col-sm-6">
                        <div class="form-group row">
                        <label for="discount" class="control-label col-sm-3 lb">Best Seller</label>

                        <label class="control-label col-sm-9 lb">
                            :   @if($product->best_seller== 0)
                                    Simple Seller
                            @else
                                <i class="fa fa-bookmark-o"> Best Seller</i>
                            @endif 
                        </label>
                    </div>
                    <div class="form-group row">
                        <label for="discount" class="control-label col-sm-3 lb">Condiction</label>
                        <label class="control-label col-sm-9 lb">
                            :  {{$product->condiction}}
                        </label>
                    </div>
                    <div class="form-group row">
                        <label for="photo" class="control-label col-sm-3 lb">Featured Image  (<span class="text-danger">600px <span style="color:#022;">x</span> 600px</span>)</label>
                        <div class="col-sm-9">
                            
                            <img src="{{asset('uploads/products/featured_images/600/'.$product->featured_image)}}" alt="" width="200" style="border:1px solid #ccc" id="preview">
                            <p><br>
                            <a class="btn btn-secondary" href="{{url('owner/product/detail/'.Crypt::encryptString($product->id).'/image')}}"><i class="fa fa-picture-o"></i> Add More Image</a>
                            @if($color->color == 1)
                            <a class="btn btn-secondary" href="{{url('owner/product/detail/'.Crypt::encryptString($product->id).'/color')}}"><i class="fa fa-paint-brush"></i> Add Color</a>
                           @endif

                           @if($size->size == 1)
                            <a class="btn btn-secondary" href="{{url('owner/product/detail/'.Crypt::encryptString($product->id).'/size')}}"><i class="fa fa-plus"></i> Add Size</a>
                           @endif


                            </p>
                        </div>
                    </div>
                    
                </div>

            </div>
            <div class="col-md-12">
                 <div class="row">
                    <p class="bg-info">&nbsp;&nbsp;Promotions</p>
                    <div class="col-md-12">
                        <a href="{{url('/owner/product/promotion/'.Crypt::encryptString($product->id))}}"><i class="fa fa-plus"></i>Click to add promotion</a>
                        <p class="">Promotion Code: {{$product->discount_code}}</p>
                        <p class="">Discount: {{$product->discount}}</p>
                        <p class="">Discount Quantity: {{$product->number_product}}</p>
                        <p class="">Promotion Date: {{$product->start_date}} to {{$product->end_date}}</p>
                    </div>

                    
                  

                  
                   
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <p class="bg-info"><strong>&nbsp;&nbsp;Description:</strong></p>
                    <p class="col-sm-12"> {!!$product->description!!}</p>
                </div>
               
            </div>
        </form>
           
             
        <br>
    </div>
<!-- </div> -->
</div>
@endsection
@section('js')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        function loadFile(e){
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(e.target.files[0]);
        }
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_product").addClass("current");
        });
       
    </script>
@endsection