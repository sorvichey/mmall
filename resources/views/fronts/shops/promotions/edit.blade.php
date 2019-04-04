@extends('layouts.owner')
@section('content')
<div class="container">
    <div class="row">
        <br>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Create Promotion  &nbsp;&nbsp;&nbsp;<a class="" href="{{ URL::previous() }}"><i class="fa fa-chevron-left "></i>Go Back</a>
                </div>
                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="col-md-12">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

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
                                <form action="{{url('/owner/product/promotion/update')}}" method="post" id="form">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" value="{{request()->route('id')}}">
                                  <div class="form-group">
                                    <label for="Product_Name">Product Name (Selected Product):</label>
                                    <input type="text" class="form-control"  value="{{$promotion->name}}" required>
                                  </div>

                                  <div class="form-group">
                                    <label for="promotion_type">Promotion Type:</label>
                                    <select name="promotion_type" id="promotion_type" class="form-control" required>
                                        <option value="">Please select one</option>
                                         @foreach($promotion_types as $promo_t)
                                        <option value="{{$promo_t->id}}" <?php echo ($promo_t->id==$promotion->discount_type)?'selected':''; ?>>{{$promo_t->name}}</option>
                                        @endforeach
                                    </select>
                                  </div>

                                   <div class="form-group">
                                    <label for="number_product">Quantity (Number of product to discount) :</label>
                                    <input type="number" min="1" class="form-control" id="number_product" name="number_product" value= "{{$promotion->number_product}}" required>
                                  </div>

                                  <div class="form-group">
                                    <label for="discount">Discount(%) :</label>
                                    <input type="number" step="0.01" min="1" class="form-control" id="discount" name="discount" value="{{$promotion->discount}}" required>
                                  </div>

                                  <div class="form-group">
                                    <label>Promotion Date:</label>
                                    <div class="input-group input-daterange">
                                        <input type="text" class="form-control" name="start_date" id="start_date" value="{{date('Y-m-d', strtotime($promotion->start_date))}}" required>
                                        <div class="input-group-addon">to</div>
                                        <input type="text" class="form-control" name="end_date" id="end_date" value="{{date('Y-m-d', strtotime($promotion->end_date))}}" required>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                      <label for="description">Description:</label>
                                      <input class="form-control" type="text" name="description" id="description" value="{{old('description')}}" placeholder="Short description">
                                  </div>

                                  <button type="submit" class="btn btn-success">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
    <script type="text/javascript">
        $.fn.datepicker.defaults.format = "yyyy-mm-dd";
        $('.input-daterange input').each(function() {
            $(this).datepicker(function(){
            });
        });

        $(document).ready(function () {
            $("#shop-menu li a").removeClass("active");
            $("#my-promotion").addClass("active");
        });
       
    </script>
@endsection