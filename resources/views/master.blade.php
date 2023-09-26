<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if (Auth::check())
    	<meta name="user" content="{{ Auth::user() }}">
    @endif

	<title>{{ config('app.name') }}</title>

	<link rel="icon" href="{{ asset('assets/front/images/favicon-32x32.png') }}" type="image/png" />
	<!--plugins-->
	<link href="{{ asset('assets/front/css/owl.carousel.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/front/css/simplebar.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/front/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/front/css/metisMenu.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/front/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;1,300;1,500&display=swap" rel="stylesheet">
	<link href="{{ asset('assets/front/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/front/css/icons.css') }}" rel="stylesheet">
	@yield('css')
</head>

<body class="bg-theme bg-theme1">
	<b class="screen-overlay"></b>

	<div class="wrapper">
    	@include('header')

		@yield('content')

		@include('footer')

		<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
	</div>

	<script src="{{ asset('assets/front/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/owl.carousel2.thumbs.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/front/js/app.js') }}"></script>
    <script src="{{ asset('assets/front/js/index.js') }}"></script>

	@if (auth()->check())
		<script>
			window.USER = {!!auth()->user() !!};
		</script>
	@endif

    @yield('js')
</body>
</html>
