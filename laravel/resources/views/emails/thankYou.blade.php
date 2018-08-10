<?php $tab = "Thanks | Email"; ?>
@extends('layouts.master')

@section('box1')
<div class="paddingForHeader">
</div>
@endsection

@section('box2')
<!-- Page Content -->
<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-2"> </div>
			<div class="col-sm-8">
				<p class="center">Thank You</p>
        		@foreach ($data as $key => $value)
					{{ $key }}: {{ $value }}<br />
				@endforeach
			</div>
		</div>
	</div>
<!-- /.container -->
</section>
@endsection

