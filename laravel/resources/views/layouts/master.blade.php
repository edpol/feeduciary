<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Feeduciary <?php if (isset($tab)) { echo " | {$tab}"; } ?></title>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" />
	<!-- Custom fonts for this template -->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" />
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" />
	<!-- Custom styles for this template -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/landing-page.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/feeduciary.css') }}" />

	<script type="text/javascript" src="{{ asset('js/analytics.js') }}"></script>

</head>
<body>

    @include('layouts.nav')

    @yield('box1')

    @yield('box2')

    @yield('box3')

    @yield('box4')

    @include('layouts.footer')

<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/myscript.js') }}"></script>
</body>
</html>