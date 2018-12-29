@extends('layouts.page')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <p class="bg-info">Account Setting</p>
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
            <div class="row">
                <br>
                
                <div class="col-md-2">
                    <img src="{{asset('uploads/buyer_profiles/'.$buyer_account->photo)}}" alt="profile" class="img-rounded" >
                    <!-- onerror="this.src='uploads/buyer_profiles/profile-default.png'" -->
                </div>
                <div class="col-md-7">
                    <div class="pt-10 pb-10">
                        <H4>Hi, {{$buyer_account->last_name}} {{$buyer_account->first_name}} 
                            <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil"></i></button>
                            <!-- <a href="{{url('/my-account/setting/edit/'.$buyer_account->id)}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a></H4>  -->
                    </div>
                    <div>
                        Gender : {{$buyer_account->gender}}
                    </div>
                    <div>
                        E-mail : {{$buyer_account->email}}
                    </div>
                    <div>
                        Phone : {{$buyer_account->phone}}
                    </div>
                   
                </div>

                <div class="col-md-3">
                    <a href="#" class="btn btn-warning"  data-toggle="modal" data-target="#changePwd"><i class="fa fa-key"></i> Change Password</a>
                </div>

            </div>
        </div>
    </div>
</div>       
<br> 

<!-- Modal Change Profile-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="{{url('my-account/setting/save/'.$buyer_account->id)}}" enctype="multipart/form-data" method="POST">
            {{ csrf_field() }}
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id" value="{{$buyer_account->id}}">
            <div class="row">
                <div class="col-sm-12">
                    <label>First Name:</label>
                    <input type="text" name="first_name" value="{{$buyer_account->first_name}}" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label>Last Name:</label>
                    <input type="text" name="last_name" value="{{$buyer_account->last_name}}" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label>Gender:</label>
                    <select class="form-control" name="gender">
                        <option @if($buyer_account->gender == "Male") selected @endif >Male</option>
                        <option @if($buyer_account->gender == "Female") selected @endif >Female</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label>Phone:</label>
                    <input type="text" name="phone" value="{{$buyer_account->phone}}" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label>E-mail:</label>
                    <input type="text" name="email" value="{{$buyer_account->email}}" class="form-control" required">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label>Photo:</label>
                    <input type="file" name="photo">
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
    </div>
  </div>
</div>


<!-- Modal Change Password-->
<div class="modal fade" id="changePwd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="{{url('my-account/setting/pwd/'.$buyer_account->id)}}" enctype="multipart/form-data" method="POST">
            {{ csrf_field() }}
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <label>New Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <label>Re-Password:</label>
                    <input type="password" name="re_password" class="form-control" required>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
    </div>
  </div>
</div>
@endsection