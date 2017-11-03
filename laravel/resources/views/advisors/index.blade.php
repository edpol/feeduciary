@extends('layouts.master')

@section('box1')

 <!-- Page Content -->
<section class="content-section-a">

	<div class="container">
		<div class="row">
			<div class="col-lg-5 ml-auto">
				<hr class="section-heading-spacer">
				<div class="clearfix"></div>
				<h2 class="section-heading">Death to the Stock Photo:<br>Special Thanks</h2>
				<p class="lead">
					<ul>
				    	@foreach( $advisors as $advisor )
				        	<li>
				            	<a href="/advisors/{{ $advisor->id }}"> 
				                	{{ $advisor->name }}, {{ $advisor->st }} <br />
				                </a>
				            </li>
						@endforeach
				    </ul>
				</p>
			</div>
		<div class="col-lg-5 mr-auto">
			<img class="img-fluid" src="{{ asset('img/ipad.png') }}" alt="">
		</div>
	</div>

	</div>
<!-- /.container -->
</section>
@endsection