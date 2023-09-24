<!-- This page shows user Bet list with details -->
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
		<h2 style="color:#fff">My Bet List</h2>
            <table class="table table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Stream Name</th>
                    <th scope="col">Started On</th>
                    <th scope="col">Bet Description</th>
                    <th scope="col">For Text</th>
                    <th scope="col">Against Text</th>
                    <th scope="col">Bet On</th>
                    <th scope="col">Bet Amount</th>
                    <th scope="col">Vig Amount</th>
                    <th scope="col">Won Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Bet Date</th> 
					<th></th>
                </tr>
                </thead>
                	<tbody>
                                     @php 
                                        $winAmount=0;
                                       $vigAmount =0;
                                        $amount=0;
                                     @endphp
									 @foreach (@$records as $key=>$result)   
									<tr  >
									   
										 
										<td>{{ $key+1 }} </td>
										
										<td>{{ $result->livestreams->name }}</td> 
										<td>{{ date('Y-m-d h:i:s A',strtotime($result->livestreams->created_at)) }}</td> 
										<td>{{ $result->betmain->description }}</td> 
										<td>{{ $result->betmain->for_text }}</td> 
										<td>{{ $result->betmain->against_text }}</td> 
										<td>{{ ucfirst($result->bet_on) }}</td> 
										<td>{{ $result->amount }}</td> 
										<td>{{ $result->vig_amount }}</td> 
										<td>{{ $result->win_amount }}</td> 
                                        @php $winAmount +=$result->win_amount @endphp
                                         @php $vigAmount +=$result->vig_amount @endphp
                                          @php $amount +=$result->amount @endphp
										<td>
										@if($result->betmain->is_declared_result)   
											@if($result->is_win == 1)   
												<label class="  btn-success btn-sm"> Won </label>
											@elseif($result->is_win == '-4')
                                            <label class="  btn-danger btn-sm">Abandoned</label>
                                            @else
												<label class="  btn-danger btn-sm">Lost</label>
											@endif
										@else	
											@if($result->is_claimed)   
												<label class="  btn-primary btn-sm"> Claimed </label> 
											@else
												<label class="  btn-warning btn-sm">Pending</label>
											@endif
										@endif</td>
										<td>{{ date('Y-m-d h:i:s A',strtotime($result->created_at)) }}</td>
										<td>
                                         @if(!$result->livestreams->type)
                                        <a href="{{ url('stream/'.$result->livestreams->id)}}">View</a>
                                        @else
                                            <a href="javascript:void(0)">End</a>
                                        @endif
                                        </td> 
									</tr>
									@endforeach
                                    <tr>
                                     <td colspan="7"></td>
                                     <td colspan="">
                                     {{ $amount }}</td>
                                     <td colspan="">{{ $vigAmount}}</td>
                                     <td colspan="">{{ $winAmount}}</td>
                                     <td colspan="3"></td>
                                    <tr> 

								</tbody>
								<tfooter>
								  {{ $records->links() }}
								  </tfooter>
            </table>
        </div>
    </div>
</div>

</body>
</html>
@endsection
