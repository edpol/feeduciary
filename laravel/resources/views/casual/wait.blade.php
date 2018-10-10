<?php $tab = "Working..."; 
if (env("APP_ENV")!="production") { 
//	header("Location: /advisors/page/1");
	$timeout=500;
} else {
	$timeout=5000;
}
?>
@extends('layouts.wait')

@section('box1')
@endsection

@section('box2')
<section>
	<div class="container">
		<br />
		<div class="row">
			<div class="col-12 col-sm-12 text-center wait">
				<img src="{{ asset('images/wait.gif') }}" alt="Wait Image" />
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-sm-12 text-center font18" id="calc" >
				Calculating Annual Fees
			</div>
		</div>
	</div>
</section>

<script>
var calc = document.getElementById("calc");
var myVar = setInterval(myTimer, 1000);
var clearVar = setInterval(clearTimer, <?= $timeout ?>);

//	add a blank space left, add a period right, stays centered
function myTimer() {
    calc.innerHTML = "\xa0" + calc.innerHTML + ".";
}

function clearTimer() {
	clearInterval(myVar);
	clearInterval(clearVar);
	window.location.href = "{{ url('/advisors/results') }}";
}

</script>
@endsection
