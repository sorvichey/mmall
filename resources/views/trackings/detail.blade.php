@extends("layouts.tracking")
@section('content')
<div class="row">
    <div class="col-lg-12">
        <strong>Tracking Detail</strong>&nbsp;&nbsp;
        <a href="{{url('/admin/tracking/create')}}"><i class="fa fa-plus"></i> New</a>
        <hr>
        <table class="tbl">
            <thead>
            <tr>
                <th>Waybill</th>
                <th>Origin</th>
                <th>Destination</th>
                <th>PCS</th>
                <th>Date Time</th>
                <th>Status</th>
                <th>Receiver</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$tracking->waybill}}</td>
                    <td>{{$tracking->origin}}</td>
                    <td>{{$tracking->destination}}</td>
                    <td>{{$tracking->pcs}}</td>
                    <td>{{$tracking->datetime}}</td>
                    <td>{{$tracking->status}}</td>
                    <td>{{$tracking->receiver}}</td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="{{url('/admin/tracking/edit/'.$tracking->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
<br>

            <form action="{{url('/admin/sub-tracking/save')}}"  method="post" class="form-inline">
            {{csrf_field()}}
                <input type="hidden" name="id" value="{{$tracking->id}}">
                <div class="col-md-3 p-0">
                Location <span class="text-danger">*</span>
                    <select name="location" id="location" class="form-control w-100">
                        <?php $locations = DB::table('tracking_locations')->orderBY('name')->get(); ?>
                        @foreach($locations as $l)
                        <option value="{{$l->name}}">{{$l->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                  Status <span class="text-danger">*</span>
                    <select name="status" id="status" class="form-control w-100">
                        <?php $status = DB::table('tracking_status')->orderBY('name')->get(); ?>
                        @foreach($status as $s)
                        <option value="{{$s->name}}">{{$s->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 pl-0">
                    Datetime <span class="text-danger">*</span>
                    <input type="text" name="datetime" required class="w-100 form-control">
                </div>
                <div class="col-md-3 pl-0">
                    Note 
                    <input type="text" name="note" class="w-100 form-control">
                </div>
                <div class="col-md-1 p-0">
                <label for=""> &nbsp;</label>
                <button class="btn btn-primary btn-flat" type="submit">Add More</button>
                </div>
            </form> 
            <?php $sub_tracking = DB::table('sub_tracking')->where('active',1)->where('tracking_id', $tracking->id)->get();?>
<br>
            <strong>Sub Tracking List</strong>&nbsp;&nbsp;
     
        <table class="tbl">
            <thead>
            <tr>
                <th>&numero;</th>
                <th>Location</th>
                <th>Status</th>
                <th>Datetime</th>
                <th>Note</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $pagex = @$_GET['page'];
            if(!$pagex)
                $pagex = 1;
            $i = 12 * ($pagex - 1) + 1;
            ?>
            @foreach($sub_tracking as $t)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$t->location}}</td>
                    <td>{{$t->status}}</td>
                    <td>{{$t->datetime}}</td>
                    <td>{{$t->note}}</td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="{{url('/admin/sub-tracking/edit/'.$t->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-sm btn-danger" href="{{url('/admin/sub-tracking/delete/'.$t->id.'?tracking_id='.$tracking->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
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