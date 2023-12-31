@extends('guest')

@section('content')
 <div class="card-body">
    <div class="border p-4 rounded">
        <div class="text-center">
            <h4 class="text-dark">Sign up to {{ config('app.name') }}</h4>
            <p class="mt-4 mb-4 fs-6">
                Please enter your ELO Esports<br> account details below
            </p>
        </div>

        @if (session()->has('error'))
            <div class="text-danger">{{ session()->get('error') }}</div>
        @endif

        <form id="register" action="{{ route('register') }}" method="post" class="row g-3" enctype="multipart/form-data">
            @csrf

            <div class="col-sm-6">
                <label for="firstname" class="form-label">First Name: </label>
                <input type="text" name="firstname" id="firstname" class="form-control"
                        value="{{old('firstname')}}" required>
                <span style="color:red">@error('firstname'){{$message}}@enderror</span>
            </div>

            <div class="col-sm-6">
                <label for="lastname" class="form-label">Last Name: </label>
                <input type="text" name="lastname" id="lastname" class="form-control" value="{{old('lastname')}}" required>
                <span style="color:red">@error('lastname'){{$message}}@enderror</span>
            </div>

            <div class="col-sm-6">
                <label for="email" class="form-label">Email: </label>
                <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}" required>

                <span style="color:red">@error('email'){{$message}}@enderror</span>
            </div>

            <div class="col-sm-6">
                <label for="username" class="form-label">Username: </label>
                <input type="text" name="username" id="username" class="form-control" value="{{old('username')}}" required>
                <span style="color:red">@error('username'){{$message}}@enderror</span>
            </div>

            <div class="col-sm-6">
                <label for="username" class="form-label">Phone Number: </label>
                <input type="number" name="phone" id="phone" class="form-control" min="12" value="{{old('phone')}}">
                <span style="color:red">@error('phone'){{$message}}@enderror</span>
            </div>

            <div class="col-sm-6">
                <label for="inputChoosePassword" class="form-label">Password:</label>
                <div class="input-group" id="show_hide_password">
                    <input type="password" name="password" class="form-control border-end-0" id="inputChoosePassword" placeholder="Enter Password" required>
                    <a href="javascript:;" class="input-group-text bg-transparent text-primary fs-10" onclick="togglePassword()">SHOW</a>
                </div>

                <span style="color:red">@error('password'){{$message}}@enderror</span>
            </div>

            <div class="col-sm-12">
                <label for="username" class="form-label">Address: </label>
                <textarea type="text" name="address" id="address" class="form-control"></textarea>
            </div>

            <div class="col-12 mb-2">
                <label for="username" class="form-label">profile Image: (JPEG, JPG, PNG, GIF) </label>
                <input accept="  image/jpeg, image/png, image/jpg, image/gif" type="file" name="profile"
                        id="profile"
                        class="form-control" value="{{old('profile')}}">
                <span style="color:red">@error('profile'){{$message}}@enderror</span>
            </div>

            <button type="submit" class="btn btn-light bg-primary text-muted1">Sign up</button>
        </form>
    </div>
</div>

<div class="card-footer text-center">
    <p class="fs-6 pt-3">
        Already registered?
        <a href="{{ route('login') }}" class="text-primary">
            Login Now
            <i class="bx bx-chevron-right1"></i>
        </a>
    </p>
</div>
@endsection

@section('js')
    <script>
        function togglePassword() {
            if (document.getElementById('inputChoosePassword').type == "text") {
                document.getElementById('inputChoosePassword').type = "password";
                return;
            }

            document.getElementById('inputChoosePassword').type = "text";
        }
    </script>
@endsection