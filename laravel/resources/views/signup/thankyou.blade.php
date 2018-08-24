<?php $tab = "Thanks | Signup"; ?>
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
					Hello {{ $name }},<br />
					An email will be sent in a few moments to {{ $email }} with a link to verify your email address to grant access to advisor fee information.
				</p>
			</div>
		</div>
	</div>
</section>
@endsection

