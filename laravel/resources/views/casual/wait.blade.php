<!DOCTYPE html>
<html lang="en">
<head>
	<title>Working...</title>
	<style>
	body {
		background-color:#191919; color:#86BCFC; 
		font-family: arial; font-weight:bold; font-size:36px;
    	display: block; 
	}
	#calculating {
		text-align:center; margin:40px auto; 
		height:500px; width:800px; 
		background-repeat: no-repeat;
	}
</style>
</head>
<body>
	<div id="calculating" style="background-image:url('images/wait.gif')">
		Calculating
	</div>	
	<p id="demo"></p>
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

function myFunction() {
    var w = window.innerWidth;
    var h = window.innerHeight;
    document.getElementById("demo").innerHTML = "Width: " + w + "<br>Height: " + h;
}
myFunction();
</script>

</body>
</html>