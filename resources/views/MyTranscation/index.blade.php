<!--This page shows ledger of user transaction-->
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
		<h2 style="color:#fff">My Transcation List</h2>
            <table class="table table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Transcation Id / Email Id </th>
                    <th scope="col">Type</th> 
                    <th scope="col">On Date</th>  
                </tr>
                </thead>
                	<tbody> 
									 @foreach (@$records as $key=>$result)   
									<tr  >
									   
										 
										<td>{{ $key+1 }} </td> 
										<td>{{ $result->comment }}</td> 
										<td>{{ $result->transaction_amount }}</td> 
										@if($result->transaction_type=='credit')
										<td>{{ $result->transaction_id }}</td> 									
										@else
										<td>{{ $result->email_id }}</td> 
										@endif
										<td>{{ ucfirst($result->transaction_type) }}</td> 
										<td>{{ date('Y-m-d h:i:s A',strtotime($result->created_at)) }}</td>  
									</tr>
									@endforeach

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
