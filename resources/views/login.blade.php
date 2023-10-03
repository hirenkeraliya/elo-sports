@extends('guest')

@section('content')
    <div class="card-body">
        <div class="border p-4 rounded">
            <div class="text-center">
                <h4 class="text-dark">Log in to {{ config('app.name') }}</h4>
                <p class="mt-4 mb-4 fs-6">
                    Please enter your ELO Esports<br> account details below
                </p>
            </div>

            <div class="form-body">
                @if (session()->has('error'))
                    <div class="text-danger">{{ session()->get('error') }}</div>
                @endif

                <form id="login" class="row g-3" method="post" action="{{ route('login') }}">
                    @csrf

                    <div class="col-12">
                        <label for="username" class="form-label">
                            Enter Username
                        </label>

                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        <span style="color:red">@error('username'){{$message}}@enderror</span>
                    </div>

                    <div class="col-12">
                        <label for="password" class="form-label">
                            Enter Password
                        </label>

                        <div class="input-group" id="show_hide_password">
                            <input type="password" class="form-control border-end-0" id="password" name="password" placeholder="Enter Password" required>

                            <a href="javascript:;" class="input-group-text bg-transparent text-primary fs-10" onclick="togglePassword()">
                                <i class="bx bx-hide1">SHOW</i>
                            </a>
                        </div>

                        <span style="color:red">@error('password'){{$message}}@enderror</span>
                    </div>

                    <div class="col-12">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-light bg-primary text-muted1">
                                Log in
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card-footer text-center">
        <p class="fs-6 pt-3"> Don't have {{ config('app.name') }} account?
            <a href="{{ route('register') }}" class="text-primary">
                Sign up Now
                <i class="bx bx-chevron-right1"></i>
            </a>
        </p>
    </div>
@endsection

@section('js')
    <script>
        function togglePassword() {
            if (document.getElementById('password').type == "text") {
                document.getElementById('password').type = "password";
                return;
            }

            document.getElementById('password').type = "text";
        }
    </script>
@endsection
