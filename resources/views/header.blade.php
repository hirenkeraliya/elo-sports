<style>
     .dropdown {
        position: relative;
        display: inline-block;
        padding-right: 80px;
    }
  
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #ffffff;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        padding: 12px 16px;
        z-index: 1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .navbar {
        background-color: #212529 !important;
    }

    .bg-dark {
        background-color: #212925 !important;
    }
 .menu-tag{
    border:1px solid #ffffff !important;
 }
  .menu-tag,
  .menu-tag:hover{
    color:#ffffff !important;
     text-decoration: none !important;
  }
</style>

<nav class="navbar navbar-expand-lg bg-light"  style="background-color:#dc3545 !important">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{route('/')}}" style="color:#ffffff;">ELO Esports</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
     <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        {{-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Link
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Link</a>
        </li> --}}
      </ul>
      {{-- <form class="d-flex" role="search"> --}}
        {{-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> --}}
        {{-- <button class="btn btn-outline-success" type="submit">Search</button> --}}
           <ul class="navbar-nav  mb-2 mb-lg-0" style="color:#ffffff;float:right;">
  @if(auth()->check()) 
        <li class="nav-item">
        

                {{-- <a class="nav-brand menu-tag" href="/logout">Logout</a> --}}

               @if(count(auth()->user()->roles) > 0)
                    <a class="menu-tag btn " href="{{url('/dashboard')}}">Go To Admin</a>
                @endif
                <div class="dropdown">

                    <a class="nav-brand text-danger" href="#">
                        @if(auth()->user()->profile)
                            <img src="{{url('/')}}/images/{{auth()->user()->profile}}" alt="not found" height='40px'
                                 width="40px" style="border-radius: 50%;">
                        @else
                            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                 class="rounded-circle user_img_msg" style="width:40px;height:40px;"/>
                        @endif
                    </a>
                    <a class="nav-brand menu-tag btn ">{{auth()->user()->username}} </a>
                    <div class="dropdown-content">
                        <p class="text-danger">
                         <a  href="{{url('/profile/1')}}" class="btn btn-success"  >   Elo Balance  </a>
				
                        
                            : {{preg_replace('#[^\w()/.%\-&]#','',auth()->user()->elo_balance)}}</p>
                        <p><a class="nav-brand text-danger" href="{{route('profile')}}">Profile</a></p>
                        <p><a class="nav-brand text-danger" href="{{route('my_streams.index')}}">My Streams</a></p>
                        <p><a class="nav-brand text-danger" href="{{url('/my_bettings')}}">My Bettings</a></p>
					    <p><a class="nav-brand text-danger" href="{{url('/my_transcation')}}">My Transcation</a></p> 
                        <p><a class="nav-brand text-danger" href="{{route('logout')}}">Logout</a></p>
                    </div>
                </div>
            
                {{-- <a class="menu-tag" href="{{url('/login')}}">Login</a>/
                <a class="menu-tag" href="{{url('/register')}}">Register</a> --}}

     
        </li>
        @else
       
        <li class="nav-item" style="margin-right:10px;">
          {{-- <a class="nav-link" href="#">Link</a> --}}
           <a class="btn menu-tag" href="{{url('/login')}}">Login</a>
        </li>
        <li class="nav-item">
          <a class="btn menu-tag" href="{{url('/register')}}">Register</a>
          {{-- <a class="nav-link disabled">Disabled</a> --}}
        </li>
            @endif
      </ul>
      {{-- </form> --}}
    </div>
  </div>
</nav>
{{-- <nav class="navbar navbar-expand-lg" style="background-color:hotpink !important;">
{{-- <nav class="navbar navbar-expand-lg navbar-dark"> --}}
   {{-- <div class="container"> --}}
    {{-- <a class="navbar-brand text-danger" href="{{url('/')}}">ELO Esports</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <meta name="csrf_token" content="{{csrf_token()}}"/>
        <span class="navbar-toggler-icon"></span>
    </button> --}}

    {{-- <div class="container-fluid">

        <li class="ms-auto">
            @if(auth()->check()) --}}

                {{-- <a class="nav-brand text-danger" href="/logout">Logout</a> --}}

                {{-- @if(auth()->user()->canAccessFilament())
                    <a class="btn btn-primary" href="{{url('/backend')}}">Admin</a>
                @endif
                <div class="dropdown">

                    <a class="nav-brand text-danger" href="#">
                        @if(auth()->user()->profile)
                            <img src="{{url('/')}}/images/{{auth()->user()->profile}}" alt="not found" height='40px'
                                 width="40px" style="border-radius: 50%;">
                        @else
                            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                 class="rounded-circle user_img_msg" style="width:40px;height:40px;"/>
                        @endif
                    </a>
                    <a class="nav-brand text-danger">{{auth()->user()->username}}</a>
                    <div class="dropdown-content">
                        <p class="text-danger">Elo Balance
                            : {{preg_replace('#[^\w()/.%\-&]#','',auth()->user()->elo_balance)}}</p>
                        <p><a class="nav-brand text-danger" href="{{route('profile')}}">Profile</a></p>
                        <p><a class="nav-brand text-danger" href="{{route('my_streams.index')}}">My Streams</a></p>
                        <p><a class="nav-brand text-danger" href="{{url('/my_bettings')}}">My Bettings</a></p>
						<p><a class="nav-brand text-danger" href="{{url('/my_transcation')}}">My Transcation</a></p>  
                        <p><a class="nav-brand text-danger" href="/logout">Logout</a></p>
                    </div>
                </div>
            @else
                <a class="menu-tag" href="{{url('/login')}}">Login</a>/
                <a class="menu-tag" href="{{url('/register')}}">Register</a>

        @endif --}}


    {{-- </div>  --}}
{{-- </div> --}}

</nav>
