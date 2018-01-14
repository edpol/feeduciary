<?php $tab="Display Advisor"; ?>
@extends('layouts.master')

@section('box1')
<div class="paddingForHeader">
</div>
@endsection

@section('box2')
<!-- Page Content -->
<section class="content-section-a">

	<div class="container">
		<div class="row">
			<div class="col-lg-5 ml-auto">
				<hr class="section-heading-spacer">
				<div class="clearfix"></div>
				<h2 class="section-heading">Advisors Listing</h2>
				<p class="lead">
					<ul>
				    	@foreach( $advisors as $advisor )
							@if($advisor->is_active || Auth::user()->isAdmin())

				        	<li @if (Auth::user()->isAdmin() && !$advisor->is_active) class="alert-danger" @endif>
				        		@if (Auth::user()->isAdmin())
				            		<a href="/admin/advisors/{{ $advisor->id }}"> 
				            	@else
				            		<a href="/advisors/{{ $advisor->id }}"> 
				            	@endif
				                {{ $advisor->name }}, {{ $advisor->st }} 				        			
				                <br />
			                	</a>
				            </li>
				        	@if (Auth::user()->isAdmin() && !$advisor->is_active) 
				        		</span>
				        	@endif
				            @endif
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