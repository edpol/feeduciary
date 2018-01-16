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
			
					@if(auth()->check() && auth()->user()->isAdmin()) 
							@php ($link="/admin/advisors")
						@else
							@php ($link="/advisors")
						@endif
				    	@foreach( $advisors as $advisor )

							@if (!$advisor->is_active)
								@php ($class="class='alert-danger'")
							@else
								@php ($class="")
							@endif
							
							<li <?= $class; ?>><a href="<?= $link; ?>/{{ $advisor->id }}">{{ $advisor->name }}, {{ $advisor->st }}</a></li>
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