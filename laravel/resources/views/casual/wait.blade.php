<!DOCTYPE html>
<html lang="en">
<head>
	<title>Working...</title>
	<style>
	body {
		background-color:#191919; color:#86BCFC; 
		font-family: arial; font-zize:48px; font-weight:bold;
    	display: block; width: 100%; heigth: 100%;
	}
</style>
</head>
<body>
	<div align="center" style="margin:100px auto; display:block;">
		<img src="{{ asset('images/wait.gif') }}" alt="Working..."/><br />
		<div style="text-align: left; width:80px;" id="calculating">Calculating</div>
	</div>
<script>
var calc = document.getElementById("calculating");
var myVar = setInterval(myTimer, 1000);
var clearVar = setInterval(clearTimer, 5000);

function myTimer() {
    calc.innerHTML = calc.innerHTML + ".";
}

function clearTimer() {
	clearInterval(myVar);
	window.location.href = "{{ url('/advisors/page') }}/{{$page}}";
}
</script>

</body>
</html>