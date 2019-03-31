@extends('layouts.career')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <strong>New Career</strong>&nbsp;&nbsp;
        &nbsp;&nbsp;
        <a href="{{url('/admin/career')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
        <form action="{{url('admin/career/save')}}" enctype="multipart/form-data" class="form-horizontal" method="post">
            {{csrf_field()}}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="position" class="control-label col-sm-3 lb">Position <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="position" value="{{old('name')}}" name="position" class="form-control" autofocus required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gender" class="control-label col-sm-3 lb">Gender <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="gender" value="{{old('gender')}}" name="gender" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hire" class="control-label col-sm-3 lb">Hire <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" id="hire" value="{{old('hire')}}"  step="1" value="1" required name="hire" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dateline" class="control-label col-sm-3 lb">Dateline <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="date" id="dateline" value="" name="dateline" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="control-label col-sm-3 lb">Type <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="type" class="form-control">
                                <option value="full-time">full-part</option>
                                <option value="part-time">part-time</option> 
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category" class="control-label col-sm-3 lb">Category <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="category" class="form-control">
                                @foreach($career_categories as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="department" class="control-label col-sm-3 lb">Department <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="department" class="form-control">
                                @foreach($department_categories as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="short_description" class="control-label col-sm-3 lb">Short Description <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <textarea name="short_description" class="form-control" id="short_description" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="document" class="control-label col-sm-3 lb">Document</label>
                        <div class="col-sm-9">
                            <input type="file" name="document" id="document" class="form-control" >
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-12 px-0">
                <div class="form-group row"> 
                    <label for="location" class="control-label col-sm-9 lb"><hr>    Location <span class="text-danger">*</span></label>
                    <div class="col-sm-9 lb">
                    @foreach($career_locations as $c)
                        <input type="checkbox" id="location" name="location[]" value="{{$c->name}}"/> {{$c->name}}
                    @endforeach
                    <hr>
                    </div>
                </div>
            </div>
            <div class="col-md-12 px-0">
                <div class="form-group row">
                    <label for="description" class="control-label col-sm-12 lb"> Description <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <textarea name="description" class="form-control ckeditor" id="description" required></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-12 px-0">
                <div class="form-group row">
                    <label for="requirement" class="control-label col-sm-12 lb"> Requirement <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <textarea name="requirement" class="form-control ckeditor" id="requirement" required></textarea>
                    </div>
                </div>
            </div>
              
            <p></p>
            <div class="row">
                <div class="col-sm-6">    
                    <div class="form-group row">
                    
                        <div class="col-sm-9">
                            <button class="btn btn-primary btn-flat" type="submit">Save</button>
                            <button class="btn btn-danger btn-flat" type="reset" id="btnCancel">Cancel</button>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
      var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 
     CKEDITOR.replace( 'description',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});
                CKEDITOR.replace( 'requirement',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_career").addClass("current");
        });
       
                               
            
    </script>
@endsection