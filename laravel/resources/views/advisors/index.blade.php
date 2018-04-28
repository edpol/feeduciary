<?php $tab = "Display Advisor"; ?>
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
			<div class="col-lg-8 ml-auto">
				<div class="clearfix"></div>
				<h2 class="section-heading">Advisors Listing</h2>

				<table class='table table-striped table-hover pagination'>
				
					@if(auth()->check() && auth()->user()->isAdmin()) 
<?php						$link=url('/admin/advisors'); ?>
					@else
<?php						$link=url('/advisors'); ?>
					@endif
					@foreach( $advisors as $advisor )

						@if( auth()->check() && auth()->user()->isAdmin() || ($advisor->is_active) ) 
						<tr>
					 		<td style="text-align:left;" @if (!$advisor->is_active) class='alert alert-danger' @endif >
								<a href="{{ $link }}/{{ $advisor->id }}">
									{{ $advisor->name }}, {{ $advisor->st }}
								</a>
							</td>
						</tr>
						@endif
					@endforeach
				</table>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4 ml-auto">
				@if (session('status'))
					<div class="row alert alert-success">
						{{ session('status') }}
					</div>
				@endif
			</div>
			<div class="col-md-4 ml-auto">
				<div class="pagination pagination-lg">
					<?= $advisors->render(); ?>
				</div>
			</div>
			<div class="col-md-4">
				<form action="{{ url('/admin/create') }}" method="post">
					{{ csrf_field() }}
					<button type="submit" class="btn btn-primary"><b>+</b></button>
				</form>
			</div>
		</div>
	</div>
<!-- /.container -->
</section>

@endsection