<?php $tab = "Working..."; 
if (env("APP_ENV")!="production") { 
	header("Location: /advisors/page/1");
}
?>
@extends('layouts.wait')

@section('box1')
<style>
	body {
		background-color:#000; color:#39B54A; 
		font-weight:bold; font-size:36px;
    	display: block; 
	}
</style>
@endsection

@section('box2')
<section>
	<div class="container">
		<br />
		<div class="row">
			<div class="col-sm-5"> </div>
			<div class="col-sm-2 wait">
				<img src='images/wait.gif' />
			</div>
			<div class="col-sm-5"> </div>
		</div>
		<div class="row">
			<div class="col-sm-2"> </div>
			<div class="col-sm-8" id="calculating"> <!-- style="background-image:url('images/wait.gif')"> -->
				Calculating Annual Fees
			</div>	
		</div>
	</div>
</section>

<script>
var calc = document.getElementById("calculating");
var myVar = setInterval(myTimer, 1000);
var clearVar = setInterval(clearTimer, 5000);

function myTimer() {
    calc.innerHTML = "\xa0" + calc.innerHTML + ".";
}

function clearTimer() {
	clearInterval(myVar);
	window.location.href = "{{ url('/advisors/page') }}/{{$page}}";
}

</script>
@endsection
