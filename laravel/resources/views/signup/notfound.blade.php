<?php $tab = "Thanks | Token"; ?>
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
			<div class="col-md-2"> </div>
			<div class="col-md-8 py-md-5">
				<p>
					Sorry for the inconvenience, but that token is no longer valid.<br /> Please go to our home page and register again.  
				</p>
				<p>
					Token: {{ $token }}
				</p>
			</div>
		</div>
	</div>
</section>
@endsection

