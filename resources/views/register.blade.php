<!-- This page allow user to register -->
@extends('master')
@section('css')
<style>
#register{
      
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
h1{
    text-align: center;
      color: #ffffff;
    padding: 20px;
}


</style>

@section('content')
 <div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="text-danger">Register</h1>
            <form id="register" action="/register" method="post" enctype="multipart/form-data">

                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="text-danger">{{ $error }}</div>
                    @endforeach
                @endif

                @if(session()->has('error'))
                    <div class="text-danger">{{ session()->get('error') }}</div>
                @endif

                @if(session()->has('error'))
                    <div class="text-danger">{{ session()->get('error') }}</div>
                @endif

                <div class="form-group mb-2">
                    <label for="email" class="text-white">Email: </label>
                    <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}">
                    <span style="color:red">@error('email'){{$message}}@enderror</span>
                </div>
                <div class="form-group mb-2">
                    <label for="firstname" class="text-white">First Name: </label>
                    <input type="text" name="firstname" id="firstname" class="form-control"
                           value="{{old('firstname')}}">
                    <span style="color:red">@error('firstname'){{$message}}@enderror</span>
                </div>
                <div class="form-group mb-2">
                    <label for="lastname" class="text-white">Last Name: </label>
                    <input type="text" name="lastname" id="lastname" class="form-control" value="{{old('lastname')}}">
                    <span style="color:red">@error('lastname'){{$message}}@enderror</span>
                </div>
                <div class="form-group mb-2">
                    <label for="username" class="text-white">Username: </label>
                    <input type="text" name="username" id="username" class="form-control" value="{{old('username')}}">
                    <span style="color:red">@error('username'){{$message}}@enderror</span>
                </div>
                <div class="form-group mb-2">
                    <label for="username" class="text-white">Phone Number: </label>
                    <input type="number" name="phone" id="phone" class="form-control" min="12" value="{{old('phone')}}">
                    <span style="color:red">@error('phone'){{$message}}@enderror</span>
                </div>
                {{-- <div class="form-group mb-2">
                    <label for="username" class="text-white">Business Info: </label>
                    <input type="text" name="business_info" id="business_info" class="form-control">
                </div> --}}
                <div class="form-group mb-2">
                    <label for="username" class="text-white">Address: </label>
                    <textarea type="text" name="address" id="address" class="form-control"></textarea>
                </div>
                <div class="form-group mb-2">
                    <label for="password" class="text-white">Password: </label>
                    <input type="password" name="password" id="password" class="form-control">
                    <span style="color:red">@error('password'){{$message}}@enderror</span>
                </div>
                <div class="form-group mb-2">
                    <label for="username" class="text-white">profile Image: (JPEG, JPG, PNG, GIF) </label>
                    <input accept="  image/jpeg, image/png, image/jpg, image/gif" type="file" name="profile"
                           id="profile"
                           class="form-control" value="{{old('profile')}}">
                    <span style="color:red">@error('profile'){{$message}}@enderror</span>
                </div>

                {{csrf_field()}}
                <button type="submit" class="btn btn-danger">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection
