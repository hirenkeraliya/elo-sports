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
    <title>ELO SPORTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
    .menu-tag{
    border:1px solid #ffffff;
 }
  .menu-tag,
  .menu-tag:hover{
    color:#ffffff;
     text-decoration: none;
  }
    </style>
    @yield('css')
  
</head>
<body style=" @if(request()->segment(1) == 'login' || request()->segment(1) == 'register') background-image:url('{{ asset('background/1533129.png')}}');no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  @else
  background-color:black;
  @endif
  "
  >
@include('header')


<div class="container" >
    @yield('content')
</div>


<script>
@if(auth()->check())
    window.USER = {!! auth()->user() !!};
    @endif
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

@yield('js')



</body>
</html>
