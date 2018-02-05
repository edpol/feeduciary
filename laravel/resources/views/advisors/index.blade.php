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
			<div class="col-lg-8 ml-auto">
				<div class="clearfix"></div>
				<h2 class="section-heading">Advisors Listing</h2>

                <table class='table table-striped table-hover pagination'>
				
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

						<tr <?= $class; ?>>
							<td style="text-align:left;">
								<a href="<?= $link; ?>/{{ $advisor->id }}">{{ $advisor->name }}, {{ $advisor->st }}</a>
							</td>
						</tr>
					@endforeach
				</table>

		        <div class="row pagination pagination-lg">
        			<?= $advisors->render(); ?>
				</div>
				@if (session('status'))
				    <div class="row alert alert-success">
				        {{ session('status') }}
				    </div>
				@endif
    		</div>
		</div>
	</div>
<!-- /.container -->
</section>

@endsection