@extends('layouts.setting')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <strong>Edit Page</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/sub-page')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
            <form action="{{url('admin/sub-page/update')}}" enctype="multipart/form-data" class="form-horizontal" method="post">
                {{csrf_field()}}
                <input type="hidden" value="{{$sub_page->id}}" name="id">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="title" class="control-label col-sm-3 lb">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" id="title" value="{{$sub_page->title}}" name="title" class="form-control" autofocus required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="title" class="control-label col-sm-3 lb">Page Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" id="page_name" name="page_name" required>
                                    <option value="">--Pease select one--</option>
                                    @foreach($pages as $p)
                                    <option value="{{$p->id}}" @if($p->id==$sub_page->page_id) selected @endif >{{$p->title}}</option>
                                    @endforeach
                                </select>
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
                                    {{$sub_page->description}}
                                </textarea>
                            </div>
                        </div>    
                        <div class="form-group row">
                        <label class="control-label col-sm-3 lb"></label>
                            <div class="col-sm-12">
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
   
@endsection
@section('js')
<script src="{{asset('/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
   var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 
   $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_sub_page").addClass("current");
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