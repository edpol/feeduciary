<?php $tab = "Download"; ?>
@extends('signup.redirect')

@section('box1')
	<div class="paddingForHeader">
	</div>
@endsection

@section('box2')
<!-- Page Content -->
<section>
	<div class="container">
		<div class="row">
			<div class="pt-4 pb-2 col-12 text-center">
				<a href="{{ $back }}">Back to Downloads</a>
			</div>
			<div class="pt-2 pb-4 col-12 text-center">
				The download will begin in <span id="countdowntimer">5 </span> seconds
			</div>
		</div>
	</div>

</section>
@endsection
