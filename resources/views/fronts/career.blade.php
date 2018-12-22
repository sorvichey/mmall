@extends('layouts.page')
@section('content')
<div id="content" class="site-content" tabindex="-1">
    <div class="container">
        <nav class="woocommerce-breadcrumb">
            <a href="{{url('/')}}">Home</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>Career List
        </nav>
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <table class="tbl table-hover">
            <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Position</th>
                    <th>Short Description</th>
                    <th>hire</th>
                    <th>Category</th>
                   
                </tr>
            </thead>
            <tbody>
            <?php
                $pagex = @$_GET['page'];
                if(!$pagex)
                    $pagex = 1;
                $i = 18 * ($pagex - 1) + 1;
            ?>
                @foreach($careers as $c)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
                            <a href="{{url('/career/detail/'.$c->id)}}" title="Detail">
                                {{$c->key_position}}
                            </a>
                        </td>
                        <td>{{$c->short_description}}</td>
                        <td>{{$c->hire}}</td>
                        <td>{{$c->category}}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table><br>
        {{$careers->links()}}
                </main>
            </div>
        </div>
    </div> 
</div>
@endsection