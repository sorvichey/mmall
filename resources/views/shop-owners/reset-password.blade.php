@extends("layouts.customer")
@section('content')
<div class="row">
    <div class="col-lg-12">
    <strong>Reset Password</strong>&nbsp;&nbsp;
        <a href="{{url('/admin/shop-owner')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif
        <form action="{{url('/admin/shop-owner/change-password')}}" method="post" id="frm" class="form-horizontal" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$owner->id}}">

                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="new_password" class="control-label col-sm-4 lb">New Password<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="confirm_password" class="control-label col-sm-4 lb">Confirm Password<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="control-label col-sm-4 lb"></label>
                            <div class="col-sm-9">
                                <p></p>
                                <button class="btn btn-warning btn-flat" type="submit">Reset Password</button>
                                <button class="btn btn-danger btn-flat" type="reset" id="btnCancel">Cancel</button>
                            </div>
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
            $("#menu_shop_owner").addClass("current");
        });
    </script>
@endsection