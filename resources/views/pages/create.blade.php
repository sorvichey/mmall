@extends('layouts.setting')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <strong>New Page</strong>&nbsp;&nbsp;
        &nbsp;&nbsp;
        <a href="{{url('/admin/page')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
        <form action="{{url('admin/page/save')}}" enctype="multipart/form-data" class="form-horizontal" method="post">
            {{csrf_field()}}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="title" class="control-label col-sm-3 lb">Title <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="title" value="{{old('title')}}" name="title" class="form-control" autofocus required>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="photo" class="control-label col-sm-3 lb">Photo <span class="text-danger">(1920x1391)</span></label>
                        <div class="col-sm-9">
                            <input type="file" value="" name="photo" id="photo" class="form-control" onchange="loadFile(event)">
                            <br>
                            <img src="{{asset('uploads/pages/default.jpg')}}" alt="" width="400" id="preview">
                        </div>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label for="description" class="control-label col-sm-3 lb">
                            Description
                        </label>
                        <div class="col-sm-12">
                            <textarea name="description" id="description" rows="6" class="form-control ckeditor">
                            </textarea>
                        </div>
                    </div>    
                    <div class="form-group row">
                    <label class="control-label col-sm-3 lb"></label>
                        <div class="col-sm-12">
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
<script src="{{asset('/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
   var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 
   $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_page").addClass("current");
        });
    function loadFile(e){
        var output = document.getElementById('preview');
        output.src = URL.createObjectURL(e.target.files[0]);
    }
  CKEDITOR.replace( 'description',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});
</script> 
@endsection