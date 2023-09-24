<!-- This page allow user to login -->
@extends('master')
@section('css')
<style>

.login{
      
    width: 429px;
    overflow: hidden;
    margin: auto;
    margin: 20 0 0 450px;
    padding: 80px;
    background: #120e14;
    border-radius: 15px;
    font-family: auto;
    font-style: unset;


}
.login button{
        width: 100%;
    background: darkkhaki;
    color: #fff;
    border-radius: 0px;
    border:0px;
}
h2{
    text-align: center;
      color: #ffffff;
    padding: 20px;
}
label{
    font-weight: 800;
      color: #ffffff;
    font-size: 24px;
    font-family: auto;
    font-style: unset;
}
{{-- #Uname{
    width: 300px;
    height: 30px;
    border: none;
    border-radius: 3px;
    padding-left: 8px;
}
#Pass{
    width: 300px;
    height: 30px;
    border: none;
    border-radius: 3px;
    padding-left: 8px;

}
#log{
    width: 300px;
    height: 30px;
    border: none;
    border-radius: 17px;
    padding-left: 7px;
    color: blue;


}
span{
    color: white;
    font-size: 17px; --}}
}

</style>

@endsection

@section('content')

    {{-- <div class="row">
        <div class="col-sm-6">
            <h1 class="text-danger">Login</h1>
            <form action="{{url('/login')}}" method="post">

                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="text-danger">{{ $error }}</div>
                    @endforeach
                @endif

                @if(session()->has('error'))
                    <div class="text-danger">{{ session()->get('error') }}</div>
                @endif

                <div class="form-group mb-2">
                    <label for="email" class="text-white">Username: </label>
                    <input required type="text" name="username" id="username" class="form-control" value="{{ old('email') }}">
                </div>

                <div class="form-group mb-2">
                    <label for="password" class="text-white">Password: </label>
                    <input required type="password" name="password" id="password" class="form-control">
                </div>

                {{csrf_field()}}

                <button type="submit" class="btn btn-danger">Login</button>
            </form>
        </div>
    </div> --}}

    <div class="container">
        <div class="row">
                    <h2>Login Page</h2><br>
                <div class="login">
                <form id="login" method="post" action="{{ url('') }}/login">
                @csrf
                 <div class="form-group">
                    <label>User Name
                   
                    </label>
                    <input class="form-control" type="text" name="username"  placeholder="Username">
                   
                    </div>
                    <br>
                     <div class="form-group">
                    <label>Password
                    </label>
                    <input type="Password"  class="form-control" name="password" id="Pass" placeholder="Password">
                    </div>
                      <br>
                     <div class="form-group">
                       {{-- <input class="btn btn-lg" type="button" name="log" id="log" value="Login"> --}}
                        <button type="submit" class="btn btn-danger">Login</button>
                    </div>
                    <br><br>
                    {{-- <input type="checkbox" id="check">
                    <span>Remember me</span>
                    <br><br>
                    Forgot <a href="#">Password</a> --}}
                </form>
            </div>

        </div>
    </div>

@endsection
