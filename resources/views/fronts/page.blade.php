@extends('layouts.page')
@section('content')
<div id="content" class="site-content" tabindex="-1">
	<div class="container">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<article class="has-post-thumbnail hentry">
					<header class="entry-header header-with-cover-image" style="background-image: url({{asset('/uploads/pages/'.$page->photo)}}">
						<div class="caption">
							<h1 class="entry-title" itemprop="name">{{$page->title}}</h1>
							<p class="entry-subtitle">{!!$page->description!!}</p>
						</div>
					</header><!-- .entry-header -->
					<?php 
						$sub_page = DB::table('sub_pages')->where('active', 1)->where('page_id', $page->id)->get();
					?>
					<div class="entry-content">
						<div class="row about-features inner-top-md inner-bottom-sm">
							@foreach($sub_page as $p)
							<div class="col-xs-12 col-md-12">
								<div class="text-content">
									<h2 class="align-top">{{$p->title}}</h2>
									<p>
									{!!$p->description!!}
									</p>

								</div>
							</div><!-- .col -->
							@endforeach
						</div><!-- .row -->
					</div><!-- .entry-content -->

				</article><!-- #post-## -->
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- .col-full -->
</div><!-- #content -->
@endsection