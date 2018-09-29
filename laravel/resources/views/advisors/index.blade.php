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
			<div class="text-center col-sm-12">
				<div class="clearfix"></div>
				<h2 class="section-heading">Advisors Listing</h2>
				<div style=" margin: 0 auto; display: inline-block">
					<table class='table table-striped table-hover pagination'>
					
						@if (session('status'))
							<tr>
								<th class="text-left alert alert-success">
									{{ session('status') }}
								</th>
							</tr>
						@endif

						@if(auth()->check() && auth()->user()->isAdmin()) 
<?php						$link=url('/admin/advisor'); ?>
						@else
<?php						$link=url('/advisors'); ?>
						@endif
						@foreach( $advisors as $advisor )

							@if( auth()->check() && auth()->user()->isAdmin() || ($advisor->is_active) ) 
							<tr>
						 		<td class="text-left" @if (!$advisor->is_active) class='alert alert-danger' @endif >
									<a href="{{ $link }}/{{ $advisor->id }}">
										{!! $advisor->name !!}, {{ $advisor->st }}
									</a>
								</td>
<!--
						 		<td class="text-left" @if (!$advisor->is_active) class='alert alert-danger' @endif >
									<a href="{{ $advisor->url }}" target="_blank">
										{{ $advisor->company }}
									</a>
								</td>
-->
							</tr>
							@endif
						@endforeach
					</table>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="text-center col-sm-12">
				<div class="pagination pagination-sm" style="margin: 0 auto; display: inline-block">
					{{ $advisors->render() }}
				</div>
			</div>
		</div>

<!--
@if( auth()->check() && auth()->user()->isAdmin() )
		<div class="row">
			<div class="text-center col-sm-12">
				<div style="margin:0 auto; margin-top:6px; display:inline-block">
					<form action="{{ url('/admin/create') }}" method="get">
						{{ csrf_field() }}
						<button type="submit" class="btn btn-primary"><b>+</b></button>
					</form>
				</div>
			</div>
		</div>
@endif
-->
	</div>
<!-- /.container -->
</section>

@endsection