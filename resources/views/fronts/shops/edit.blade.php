@extends('layouts.owner')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <br>
            <strong>Edit&nbsp;&nbsp;
            &nbsp;&nbsp;
            Shop owner profile:
            </strong>
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
            <form action="{{url('owner/update')}}" enctype="multipart/form-data" class="form-horizontal" method="post">
                {{csrf_field()}}
                <input type="hidden" id="id" name="id" value="{{$owner->id}}">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="first_name" class="control-label col-sm-3 lb">First Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="first_name" value="{{$owner->first_name}}" name="first_name" class="form-control" autofocus required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="control-label col-sm-3 lb">Last Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="last_name" value="{{$owner->last_name}}" name="last_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="gender" class="control-label col-sm-3 lb">Gender<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control option" name="gender">
                                    <option value="Male" {{$owner->gender=='Male'?'selected':''}}>Male</option>
                                    <option value="Female" {{$owner->gender=='Female'?'selected':''}}>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="control-label col-sm-3 lb">Phone <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="phone" value="{{$owner->phone}}" name="phone" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="control-label col-sm-3 lb">Email <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="email" value="{{$owner->email}}" name="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="control-label col-sm-3 lb">Address <span class="text-danger"></span></label>
                            <div class="col-sm-9">
                                <input type="text" id="address" value="{{$owner->address}}" name="address" class="form-control" placeholder="Your address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo" class="control-label col-sm-3 lb">Photo <span class="text-danger">(500x500)</span></label>
                            <div class="col-sm-9">
                                <input type="file" name="photo" id="photo" class="form-control" onchange="loadFile(event)">
                                <br>
                                @if($owner->photo == null)
                                <img src="{{asset('uploads/owner_profiles/profile-default.png')}}" alt="" width="120" id="preview">
                                @else 
                                    <img src="{{asset('uploads/owner_profiles/'.$owner->photo)}}" alt="" width="120" id="preview">
                                @endif
                            </div>
                            
                        </div>
                        <p></p>
                        <div class="form-group row">
                        <label class="control-label col-sm-3 lb"></label>
                            <div class="col-sm-9">
                                <button class="btn btn-primary btn-flat" type="submit">Save Change</button>
                                <button class="btn btn-danger btn-flat" type="reset" id="btnCancel">Cancel</button>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    function loadFile(e){
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(e.target.files[0]);
        }

</script> 
@endsection