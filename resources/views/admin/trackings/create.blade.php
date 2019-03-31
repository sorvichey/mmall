@extends("layouts.tracking")
@section('content')
<div class="row">
    <div class="col-lg-12">
        <strong>Create New Tracking</strong>&nbsp;&nbsp;
        <a href="{{url('/admin/tracking')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
        <form action="{{url('/admin/tracking/save')}}"  method="post" id="frm" class="form-horizontal">
            {{csrf_field()}}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="waybill" class="control-label col-sm-3 lb">Waybill<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="waybill" autocomplete="off" name="waybill" value="{{old('waybill')}}" class="form-control" autofocus required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="origin" class="control-label col-sm-3 lb">Origin<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="origin" class="form-control" id="origin">
                                @foreach($origin as $o)
                                    <option value="{{$o->name}}">{{$o->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="url" class="control-label col-sm-3 lb">Destination<span class="text-danger">*</span></label>

                        <div class="col-sm-9">
                            <select name="destination" class="form-control" id="destination">
                                @foreach($destination as $d)
                                    <option value="{{$d->name}}">{{$d->name}}</option>
                                @endforeach
                            </select>
              
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="url" class="control-label col-sm-3 lb">Status<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="status" class="form-control" id="status">
                                @foreach($status as $s)
                                    <option value="{{$s->name}}">{{$s->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pcs" class="control-label col-sm-3 lb">PCS<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <input type="number" id="pcs" name="pcs" value="{{old('datetime')}}" class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="datetime" class="control-label col-sm-3 lb">Date Time<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <input type="text" id="datetime" name="datetime" value="{{old('datetime')}}" class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="receiver" class="control-label col-sm-3 lb">Receiver</label>
                        <div class="col-sm-9">
                        <input type="text" id="receiver" name="receiver" value="{{old('receiver')}}" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                    <label class="control-label col-sm-3 lb"></label>
                        <div class="col-sm-9">
                            <p></p>
                            <button class="btn btn-primary btn-flat" type="submit">Save</button>
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
            $("#menu_tracking").addClass("current");
        })
    </script>
@endsection