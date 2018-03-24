<!DOCTYPE html>
<html lang="en">
<head>
	<title>Working...</title>
	<style>
	body {
		background-color:#000; color:#39B54A; 
		font-family: arial; font-weight:bold; font-size:36px;
    	display: block; 
	}
	#calculating { 
		text-align:center; margin:40px auto; 
/*
		-webkit-background-size: contain;
    	   -moz-background-size: contain;
    	     -o-background-size: contain;
    	        background-size: contain;
*/
    	background-repeat: no-repeat;
    	background-position: center; 
    	width:600px; height:200px;
	}
</style>
</head>
<body>
	<div id="calculating" style="background-image:url('images/wait.gif')">
		Calculating Annual Fees
	</div>	
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

</body>
</html>