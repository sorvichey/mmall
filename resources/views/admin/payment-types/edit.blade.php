@extends("layouts.setting")
@section('content')
<div class="row">
    <div class="col-lg-12">
        <strong>Edit Payment Type</strong>&nbsp;&nbsp;
        <a href="{{url('/admin/payment-type')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
        <form action="{{url('/admin/payment-type/update')}}" enctype="multipart/form-data" method="post" id="frm" class="form-horizontal">
            {{csrf_field()}}
            <input type="hidden" value="{{$payment_type->id}}" name="id">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="name" class="control-label col-sm-3 lb">Name <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="name" value="{{$payment_type->name}}" name="name" class="form-control" autofocus required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="order" class="control-label col-sm-3 lb">Order</label>
                        <div class="col-sm-9">
                            <input type="number" id="order" name="order" value="{{$payment_type->order}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="url" class="control-label col-sm-3 lb">Link URL</label>
                        <div class="col-sm-9">
                            <input type="text" id="url" name="url" value="{{$payment_type->url}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="photo" class="control-label col-sm-3 lb">Photo <span class="text-danger">(139x100)</span></label>
                        <div class="col-sm-9">
                            <input type="file" value="" name="photo" id="photo" class="form-control" onchange="loadFile(event)">
                            <br>
                            <img src="{{asset('uploads/payment_types/'.$payment_type->photo)}}" alt="" width="139" id="preview">
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
        function loadFile(e){
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(e.target.files[0]);
        }
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_payment_type").addClass("current");
        })
    </script>
@endsection