@extends('master')
 
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://www.paypal.com/sdk/js?client-id=AeGZhGGL1OHC1WAq9jmXBlWMgAjdOfwpVmo14E5HEu_Lm0_X4lrgUSitPZXxKeY2Srf_l8As6CNXtsbY&currency=USD"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    .menu-tag {
        border: 1px solid #ffffff;
    }

    .menu-tag,
    .menu-tag:hover {
        color: #ffffff;
        text-decoration: none;
    }

    #myBtn {
        position: fixed;
        bottom: 20px;
        right: 30px;
        z-index: 99;
        font-size: 18px;
        border: none;
        outline: none;
        background-color: red;
        color: white;
        cursor: pointer;
        padding: 15px;
        border-radius: 4px;
    }

</style>
@endsection
@section('content')



@if(session()->get('success'))
<div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>{{session()->get('success')}}</strong>
</div>
@endif

@if(session()->get('error'))
<div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>{{session()->get('error')}}</strong>
</div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="video">
            
            <script src="https://player.twitch.tv/js/embed/v1.js"></script>
            <div id="SamplePlayerDivID"></div>
        </div>
        <br>
    </div>
</div>

   
 </div>
    @endsection
        @section('js')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
 var options = {
                    width: 1100
                    , height: 380
                    , @if(isset($dataw['user_login']))
                    channel: "{{$dataw['user_login']}}"
                    , @endif
                    // Only needed if this page is going to be embedded on other websites
                    //parent: ["embed.example.com", "othersite.example.com"]
                };
             

                var player = new Twitch.Player("SamplePlayerDivID", options);
                player.setVolume(0.5);
  </script>
  @endsection


     