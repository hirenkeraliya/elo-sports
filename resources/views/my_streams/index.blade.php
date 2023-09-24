<!-- This page shows   Stream   list created by user  -->
@extends('master')
@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}
    <script
        src="https://www.paypal.com/sdk/js?client-id=AeGZhGGL1OHC1WAq9jmXBlWMgAjdOfwpVmo14E5HEu_Lm0_X4lrgUSitPZXxKeY2Srf_l8As6CNXtsbY&currency=USD"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <style>
        body {
            background: rgb(99, 39, 120)
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .profile-button {
            background: rgb(99, 39, 120);
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }
        .menu-tag{
    border:1px solid #ffffff;
 }
  .menu-tag,
  .menu-tag:hover{
    color:#ffffff;
     text-decoration: none;
  }
    </style>
</head>
<body>

<div class="container rounded mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
		<h2 style="color:#fff">My Stream   List </h2>
            <table class="table table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Stream Name</th>
                    <th scope="col">Started Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Vig Amount</th>
                    <th scope="col">Steamer Fees</th>
					<th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($streams as $key=>$stream)
                    <tr>
					<td>{{ $key+1;}}</td>
                        <td>
                            
                            <span>{{ $stream->name }}</span>
                        </td> 
                        <td><span>{{ $stream->created_at }}</span></td>
                        <td><span>@if($stream->status=='stopped'){{ $stream->updated_at }} @endif</span></td>
                        <td><span>@if($stream->bets()->sum('vig_amount')){{  $stream->bets()->sum('vig_amount')  }} @else {{ 0.00 }} @endif</span></td>
                        <td><span>@if($stream->betMain()->sum('streamer_fee')){{  $stream->betMain()->sum('streamer_fee')  }} @else {{ 0.00 }} @endif</span></td>
						<td><a href="{{ url('/stream_bet/'.$stream->id) }}">Details</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
@endsection
