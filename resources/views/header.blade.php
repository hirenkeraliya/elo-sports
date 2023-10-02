<div class="header-wrapper bg-dark-1 ">
    <div class="primary-menu border-top bg-dark-blue">
        <div class="container d-lg-none">
            <nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg">
                <div class="offcanvas-header">
                    <button class="btn-close float-end"></button>
                    <h5 class="py-2 text-white">Menu</h5>
                </div>

                <ul class="navbar-nav">
                    <li class="nav-item active">
						<a class="nav-link" href="/">Home</a>
                    </li>
					@if (auth()->check())
						@if (auth()->check() && count(auth()->user()->roles) > 0)
							<li class="nav-item">
								<a class="nav-link" href="{{ route('dashboard') }}">Go To Admin</a>
							</li>
						@endif

						<li class="nav-item">
							<a class="nav-link" href="{{ route('profile') }}">
								<span>Profile</span>
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="{{ route('my_streams.index') }}">
								<span>My Streams</span>
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="{{ route('my_bettings') }}">
								<span>My Betting</span>
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="{{ route('my_transactions') }}">
								<span>My Transcation</span>
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="{{ route('logout') }}">
								<span>Logout</span>
							</a>
						</li>
					@else
						<li class="nav-item">
							<a class="nav-link" href="{{ route('login') }}">Log in</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('register') }}">Sign up</a>
						</li>
					@endif
                    <li class="nav-item">
						<a class="nav-link" href="{{ route('stream.form.index') }}">Start Stream</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

	<div class="header-content p-2 bg-dark-blue2">
		<div class="container">
			<div class="row align-items-center">
				<div class="col col-md-auto">
					<div class="d-flex align-items-center">
						<div class="mobile-toggle-menu d-lg-none px-lg-2" data-trigger="#navbar_main">
							<i class='bx bx-menu'></i>
						</div>

						<div class="logo d-none d-lg-flex">
							<a href="/">
								<h3>
									<img src="{{ asset('assets/front/images/logo.png') }}" class="logo" alt="Logo">
								</h3>
							</a>
						</div>
					</div>
				</div>

				<div class="col-12 col-md order-4 order-md-2"></div>

				@if (auth()->check())
					<div class="col col-md-auto order-3 d-none d-xl-flex align-items-center">
						<ul class="navbar-nav">
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
									<div class="lang d-flex gap-1">
										<div>
											@if (auth()->user()->profile)
												<img src="{{url('/')}}/images/{{auth()->user()->profile}}" class="rounded-circle" width="30px" height="30px" alt="{{ auth()->user()->username }}">
											@else
												<img src="{{ asset('assets/front/images/avatar.jpg') }}"
													class="rounded-circle" width="30px" height="30px" alt="{{ auth()->user()->username }}" />
											@endif
										</div>

										<div></div>
									</div>
								</a>

								<div class="dropdown-menu dropdown-menu-lg-end">
									<a class="dropdown-item d-flex allign-items-center"
										href="{{ route('profile') }}">
										<span>Profile</span>
									</a>

									<a class="dropdown-item d-flex allign-items-center" href="{{ route('my_streams.index') }}">
										<span>My Streams</span>
									</a>

									<a class="dropdown-item d-flex allign-items-center" href="{{ route('my_bettings') }}">
										<span>My Betting</span>
									</a>

									<a class="dropdown-item d-flex allign-items-center" href="{{ route('my_transactions') }}">
										<span>My Transaction</span>
									</a>

									<a class="dropdown-item d-flex allign-items-center" href="{{ route('logout') }}">
										<span>Logout</span>
									</a>
								</div>
							</li>
						</ul>
					</div>
				@endif

				<div class="col col-md-auto order-2 order-md-4">
					<div class="logo d-lg-none d-lg-flex">
						<a href="index.php">
							<img src="{{ asset('assets/front/images/logo.png') }}" class="logo" alt="Logo">
						</a>
					</div>

					<nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg">
						<div class="offcanvas-header">
							<button class="btn-close float-end"></button>
							<h5 class="py-2 text-white">Menu</h5>
						</div>

						<ul class="navbar-nav">
							<li class="nav-item active">
								<a class="nav-link" href="/">Home</a>
							</li>

							@if (auth()->check() && count(auth()->user()->roles) > 0)
								<li class="nav-item">
									<a class="nav-link" href="{{ route('dashboard') }}">Go To Admin</a>
								</li>
                        	@endif

							@if(! auth()->check())
								<li class="nav-item">
									<a class="nav-link" href="{{ route('login') }}">Login</a>
								</li>

								<li class="nav-item">
									<a class="nav-link" href="{{ route('register') }}">Signup</a>
								</li>
							@endif

							<li class="nav-item">
								<a class="nav-link" href="{{ route('stream.form.index') }}">Start Stream</a>
							</li>
						</ul>
					</nav>

					@if(! auth()->check())
						<a href="{{ route('login') }}" class="btn text-white bg-primary btn-ecomm radius-30 d-none">
							Login
						</a>

						<a href="{{ route('register') }}" class="btn text-white bg-success btn-ecomm radius-30 d-none">
							Signup
						</a>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
