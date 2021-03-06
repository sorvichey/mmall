@extends("layouts.product")
@section('content')
<div class="row">
    <div class="col-lg-12">
        <strong>Edit Product Status</strong>&nbsp;&nbsp;
        <a href="{{url('/admin/product-status')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
        <form action="{{url('/admin/product-status/update')}}" enctype="multipart/form-data" method="post" id="frm" class="form-horizontal">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$product_status->id}}">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="name" class="control-label col-sm-3 lb">Name <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="name" name="name" class="form-control" value="{{$product_status->name}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="icon" class="control-label col-sm-3 lb">Order</label>
                        <div class="col-sm-9">
                            <input type="number" name="order" id="order" class="form-control" value="{{$product_status->order}}">
                        </div>
                    </div>
                    <div class="form-group row">
                    <label class="control-label col-sm-3 lb"></label>
                        <div class="col-sm-9">
                            <p></p>
                            <button class="btn btn-primary btn-flat" type="submit">Save Change</button>
                            <button class="btn btn-danger btn-flat" type="reset" id="btnCancel">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_product_status").addClass("current");
        })
    </script>
@endsection