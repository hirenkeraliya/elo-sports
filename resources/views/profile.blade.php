<!-- This view show profile of the user 
	also this page has purchase elo button this allow user purchase elo using paypal
-->

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
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://www.paypal.com/sdk/js?client-id={{ \Crypt::decryptString($setting->client_id)}}&currency=USD"></script>
	<!--<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" /> 

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

        .menu-tag {
            border: 1px solid #ffffff;
        }

        .menu-tag,
        .menu-tag:hover {
            color: #ffffff;
            text-decoration: none;
        }

    </style>
</head>
<body>

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-left text-center p-1 py-1">

                    @if(auth()->user()->profile)
                    <img src="{{url('/')}}/images/{{auth()->user()->profile}}" class="rounded-circle mt-3" width="100px" height="100px" class="font-weight-bold">
                    @else
                    <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle mt-3" width="100px" height="100px" class="font-weight-bold" />
                    @endif
                </div>
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile </h4>
                        <hr>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">
                                <h6 class="text-right">Username
                                    : {{$profile->username}}</h6>
                            </label></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">
                                <h6 class="text-right">Email
                                    : {{$profile->email}} </h6>
                            </label></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">
                                <h6 class="text-right">Phone
                                    : {{$profile->phone}} </h6>
                            </label></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">
                                <h6 class="text-right">Business Info
                                    : {{$profile->business_info}} </h6>
                            </label></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">
                                <h6 class="text-right">Address
                                    : {{$profile->address}} </h6>
                            </label></div>
                    </div>
					
					
					
                    {{-- <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div> --}}
                </div>
            </div>
            <div class="col-md-6 border-right">
				 <div class="col-md-12">
<div class="alert alert-success alert-dismissible"  @if(@strlen((Session::get('status')))) style="display:block"  @else style="display:none"  @endif >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
                 {{ Session::get('status') }}
                </div>
				
<div class="alert alert-danger alert-dismissible"   @if(@strlen((Session::get('error')))) style="display:block"  @else  style="display:none"  @endif >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
                 {{ Session::get('error') }}
                </div>
			

	
<div class="alert alert-danger alert-dismissible"  @if(( count($errors->all()))) style="display:block"  @else  style="display:none"  @endif >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
                 @foreach ($errors->all() as $error)
                        {{ $error }} <br>
                    @endforeach
                </div>			
                </div>
				 
				 
                <div class="p-3 py-5">
                    <div class="col-md-12 d-flex justify-content-between align-items-center mb-3">
                        <h5 class="text-right">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter1">
                                Elo Balance
                            </button>
                            :{{$profile->elo_balance}}
							
@if($profile->elo_balance > $setting->min_wallet_trasfer_amount)
 
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#TransferwalletToPaypal">
                Transfer To Paypal
            </button>
			
@endif
							</h5>
                    </div>
                    <hr>
                    
					<div class="col-md-12 d-flex justify-content-between align-items-center mb-3">
					
					<h5  >Stream Key : {{$profile->stream_key}} </h5>
					<div style="display:none">
					<input type="text" id="myInputCopy" value="{{$profile->stream_key}}">
					</div>
					  <button onclick="myFunctionCopy()" class="btn btn-success">Copy Stream Key</button>
                    </div>
					
                    <div class="col-md-12 d-flex justify-content-between align-items-center mb-3">
                        <h5 class="text-right">List Of Deposits </h5>
                    </div>

                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Deposited Amount</th>
                                <th>Transaction Id</th>
                                <th>Status</th>
                                <th>Date</th>

                            </tr>
                        </thead>
                        @foreach($deposits as $k=>$deposite)
                        <tr>
                            <td>{{$deposite->transaction_amount}}</td>
                            <td>{{$deposite->transaction_id}}</td>
                            <td>{{$deposite->comment}}</td>
                            <td>{{$deposite->created_at}}</td>

                        </tr>
                        @endforeach
                    </table>
                    <hr>
                    <div class="col-md-12 d-flex justify-content-between align-items-center mb-3">
                        <h5 class="text-right">List Of Withdrawls </h5>
                    </div>

                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Withdrawl Amount</th>
                                <th>Email Id</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        @foreach($withdrawls as $withdrawl)
                        <tr>
                            <td>{{$withdrawl->transaction_amount}}</td>
                            <td>{{$withdrawl->email_id}}</td>
                            <td>{{$withdrawl->created_at}}</td>
                        </tr>
                        @endforeach
						 
                    </table>
<a href="{{url('/my_transcation')}}" title="View All Transaction">View All</a>

                </div>
            </div>
            <div class="col-md-2">
                {{-- <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><h4 class="text-right">General info </h4></div><br>
                <div class="col-md-12"><label class="labels">Elo Balance</label><input type="text" class="form-control" placeholder="experience" value="  &#8377 110" readonly></div> <br>
                <hr>
                <div class="col-md-12"><label class="labels"><h5 class="text-right">List of Past Bets </h5></label><input type="text" class="form-control" placeholder="additional details" value=""></div>
            </div> --}}

                <div class="p-3 py-5">

                    <button type="button" class="btn btn-success purchase_elo_btn" data-toggle="modal" data-target="#exampleModalCenter1">
                        Purchase ELO
                    </button>

                    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Purchase ELO</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal" id="close_modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body" id="model_body">
                                    <div class="mb-3">
                                        <label for="purchase_elo" class="form-label">Enter ELO</label>
                                        <input type="number" class="form-control" id="purchase_elo" placeholder="How luch ELO you want to purchase?">
                                        <small id="calcELO" class="text-muted"></small>
                                    </div>
                                </div>
                                <div class="modal-footer d-inline-block">
                                    <div id="paypal-button-container"></div>
                                    <div class="col-md-12" id="completion-block" style="margin-bottom: 10px;display: none;">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <p class="card-text text-success font-weight-bold" id="completion-text"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="TransferwalletToPaypal" tabindex="-1" role="dialog" aria-labelledby="TransferwalletToPaypalTitle" aria-hidden="true">
    <form action="{{ url('/transfer_to_paypal') }}" method="post" id="create_bet2_frm">@csrf
        @method('POST')
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Money Withdrawl</h5>
                </div>

                <div class="modal-body">
                     
                    <p>
                        <label>Enter Amount</label>
                        <input type="number" required name="amount" min="1" max="{{ round($profile->elo_balance,PHP_ROUND_HALF_DOWN) }}" id="amount" class="form-control" placeholder="Enter Amount" maxlength="">

                    </p>  
					<p>
                        <label>Enter Paypal Email Id</label>
                        <input type="email" required name="paypal_email"   id="paypal_email" class="form-control" placeholder="Enter Paypal Email Id" maxlength="200" value="{{ $profile->paypal_email }}">

                    </p> 
                </div>
                <div class="modal-footer">
				<input type="hidden" id="wallet_balace"value="{{ $profile->elo_balance }}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">X</button>
                    <button type="button" value="Submit" class="btn btn-primary" id="trasfer_submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>



    <script type="text/javascript"> 
        $('#completion-block').hide();
		
		  $('#trasfer_submit').click(function() {  
			  var wallet_balace=parseFloat($('#wallet_balace').val());
			  var amount=parseFloat($('#amount').val());
			  var paypal_email=$('#paypal_email').val();
			  if(!Number.isNaN(amount)){
				  if(paypal_email.length){
					  if(amount>wallet_balace){
						  alert('You can withdrawal - '+wallet_balace+' ');
					  }else{
							$('#create_bet2_frm').submit();
					  }
				  }else{
					  alert('Please enter paypal email id')
				  }
			  }else{
				  alert('Please enter amount')
			  }
		  });
		
        $("#purchase_elo").keyup(function() {
            var conversion = "1";
            var val = this.value + ' ELO = ' + conversion * this.value + ' USD';
            $("#calcELO").text(val);
        });


        var payment_success = 0;
        var transaction_id = 0;
        var status = 0;
        var base_url = "{{url('/')}}";
        var conversion = "1";
        var username = "{{Cookie::get('username')}}";
        var purchase_elo = $('#purchase_elo').val();


        console.log("USD:" + purchase_elo);
        console.log("username:" + username);
        var usd_amount = purchase_elo * conversion;

        paypal.Buttons({
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: $('#purchase_elo').val() * conversion // Can also reference a variable or function
                        }
                    }]
                });
            },
            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {
                return actions.order.capture().then(function(orderData) {
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    const transaction = orderData.purchase_units[0].payments.captures[0];
                    //alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);

                    //if (transaction.status=='COMPLETED' or ) {
                    transaction_id = transaction.id;
                    status = transaction.status;
                    console.log("inside COMPLETED status");
                    // var completion_block = document.getElementById("completion-block");
                    // completion_block.style.display = completion_block.style.display === 'none' ? 'block' : 'none';

                    $('#completion-block').show();
                    
                    payment_success = 1;
if (transaction.status == 'COMPLETED')
                        $('#completion-text').text("Your payments processed successfully, Payment Status: " + transaction.status);
                    else
                        $('#completion-text').text("Your payments is on hold, Payment Status: " + transaction.status);

                    $('#model_body').hide();
                    $('#paypal-button-container').hide();

                    // console.log("APP-URL:"+url('/'));
                    var purchase_elo = $('#purchase_elo').val();

                    console.log("purchase_elo:" + purchase_elo);

                    var usd_amount = purchase_elo * conversion;

                    var param = "?status=" + transaction.status + "&transaction_id=" + transaction.id + "&elo_amount=" + purchase_elo + "&usd_amount=" + usd_amount + "&user_name=" + username;
 
					
					$.ajax({
						type: "POST", 
						url: "{{url('/transfer_paypal_to_wallet')}}",
						data:{
							_token:"{{ csrf_token() }}",
							status: transaction.status
                        , transaction_id: transaction.id
                        , elo_amount: purchase_elo
                        , usd_amount: usd_amount
						},
						dataType:'JSON',
						success: function (data) { 
						window.location.href="{{url('/profile')}}"
					}
					});
			
				 

                   /* setTimeout(function() {
                        location.reload();
                    }, 5000); */

                    // }

                });

            }
        }).render('#paypal-button-container');

var is_open_popup = "{{$open_popup}}";
if(is_open_popup=="1"){ 
	$('.purchase_elo_btn').trigger("click");
}


function myFunctionCopy() {
  // Get the text field
  var copyText = document.getElementById("myInputCopy");

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

   // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);

  // Alert the copied text
  alert("Copied the text: " + copyText.value);
} 
    </script>
</body>
</html>
@endsection
