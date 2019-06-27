@extends('layouts.shop-admin')
@section('content')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="container">
    <div class="row">
        <br>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Create Promotion
                </div>
                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="col-md-12">
                                @if($promotion_exist[0]==1)
                                    <div class="alert alert-danger">
                                        <ul>
                                            Promotion is running on this product. If you want to edit this promotion [<a href='{{url("/owner/product/promotion/edit/".$promotion_exist[1])}}'>click this link</a>].
                                        </ul>
                                        <ul>
                                            If you want to add new promotion, you have to wait until end of the promotion.
                                        </ul>
                                    </div>
                                @endif
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
                                <form action="{{url('/owner/product/promotion/save')}}" method="post" id="form">
                                    {{csrf_field()}}
                                  <div class="form-group">
                                    <label for="Product_Name">Product Name (Selected Product):</label>
                                    <input type="text" class="form-control" style="background:#fff;"  value="{{$product->name}}" required readonly>
                                    <input type="hidden" id="product_id" name="product_id" value="{{base64_encode($product->id)}}" required>
                                 
                                  </div>

                                  <div class="form-group">
                                    <label for="promotion_type">Promotion Type:</label>
                                    <select name="promotion_type" id="promotion_type" class="form-control" required>
                                        <option value="">Please select one</option>
                                         @foreach($promotion_types as $promo_t)
                                        <option value="{{$promo_t->id}}">{{$promo_t->name}}</option>
                                        @endforeach
                                    </select>
                                  </div>

                                   <div class="form-group">
                                    <label for="number_product">Quantity (Number of product to discount) :</label>
                                    <input type="number" min="1" max="{{$product->quantity}}" class="form-control" id="number_product" name="number_product" value="{{old('number_product')}}" required>
                                  </div>

                                  <div class="form-group">
                                    <label for="discount">Discount(%) :</label>
                                    <input type="number" step="0.01" min="1" class="form-control" id="discount" name="discount" value="{{old('discount')}}" required>
                                  </div>

                                  <div class="form-group">
                                    <label>Promotion Date:</label>
                                    <!-- <div class="input-group input-daterange">
                                        <input type="text" class="form-control" name="start_date" id="start_date" value="{{old('start_date')}}" required>
                                        <input type="text" class="form-control" name="start_date" id="start_date" value="" required>
                                        <div class="input-group-addon">to</div>
                                        <input type="text" class="form-control" name="end_date" id="end_date" value="{{old('end_date')}}" required>
                                    </div> -->
                                    <input type="text" name="datetimes" class="form-control" required/>
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

<script>
$(function() {
  $('input[name="datetimes"]').daterangepicker({
    timePicker: true,
    timePicker24Hour: true,
    startDate: moment().startOf('hour'),
    endDate: moment().startOf('hour').add(24, 'hour'),
    locale: {
      format: 'YYYY-MM-DD HH:MM'
    }
  });
});
</script>
@endsection