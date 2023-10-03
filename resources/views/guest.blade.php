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

    <link href="{{ asset('assets/front/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;1,300;1,500&display=swap" rel="stylesheet">
	<link href="{{ asset('assets/front/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/front/css/icons.css') }}" rel="stylesheet">
</head>

<body class="bg-theme bg-theme1">
	<b class="screen-overlay"></b>

	<div class="wrapper">
		<div class="page-wrapper">
			<div class="page-content">
				<section class="pt-5 mt-5 pb-5 mb-5">
					<div class="container">
						<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
							<div class="row row-cols-1 row-cols-xl-2">
								<div class="col mx-auto">
									<center>
								        <img src="{{ asset('assets/front/images/logo.png') }}" class="logo" alt="logo" />

 								    	<h6 class="mt-4 mb-4">
											Bringing you the best live and
											<br>
											on-demand sport and racing content
										</h6>
									</center>
									<div class="card" style="background-color: white; color:black">
										@yield('content')
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>

		@include('footer')
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

    @yield('js')
</body>
</html>
