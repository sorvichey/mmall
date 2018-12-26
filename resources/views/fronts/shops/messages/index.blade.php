@extends('layouts.owner')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3">
        	<ul class="list-group">
			  <li class="list-group-item active">User's messages</li>
			  <li class="list-group-item">User 1</li>
			  <li class="list-group-item">User 2</li>
			  <li class="list-group-item">User 3</li>
			  <li class="list-group-item">User 4</li>
			</ul>
        </div>

        <div class="col-lg-9">

        </div>
    </div>
</div>
@endsection

@section('js')
   <script type="text/javascript">

        $(document).ready(function () {
            $("#shop-menu li a").removeClass("active");
            $("#my-message").addClass("active");
        });
    
    </script>
@endsection