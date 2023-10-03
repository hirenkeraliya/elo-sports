@extends('master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <section class="pt-md-5 pt-sm-3 ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 border-right" style="background-color:#090d55">
                            <div class="d-flex flex-column align-items-left text-center p-1 py-1">
                                @if(auth()->user()->profile)
                                    <img src="{{url('/')}}/images/{{auth()->user()->profile}}" class="rounded-circle mt-3" width="100px" height="100px">
                                @else
                                    <img src="{{ asset('assets/front/images/avatar.jpg') }}" class="rounded-circle mt-3" width="100px" height="100px"/>
                                @endif
                            </div>

                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Profile </h4>
                                    <hr>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label class="labels">
                                            <h6 class="text-right">
                                                Username:
                                                {{ $profile->username }}
                                            </h6>
                                        </label>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label class="labels">
                                            <h6 class="text-right">
                                                Email: {{ $profile->email }}
                                            </h6>
                                        </label>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label class="labels">
                                            <h6 class="text-right">
                                                Phone:
                                                {{ $profile->phone}}
                                            </h6>
                                        </label>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label class="labels">
                                            <h6 class="text-right">
                                                Business Info:
                                                {{ $profile->business_info }}
                                            </h6>
                                        </label>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label class="labels">
                                            <h6 class="text-right">
                                                Address:
                                                {{ $profile->address }}
                                            </h6>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 border-right" style="background-color:#090d4d">
                            <div class="col-md-12">
                                <div class="p-3 py-5">
                                    <div class="col-md-12 d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="text-right">
                                            <button type="button" class="btn btn-success mt-1" data-bs-toggle="modal" data-bs-target="#exampleModalCenter1">
                                                Elo Balance
                                            </button>
                                            : {{ $profile->elo_balance }}

                                            @if ($profile->elo_balance > $setting->min_wallet_trasfer_amount)
                                                <button type="button" class="btn btn-danger mt-1" data-bs-toggle="modal"
                                                    data-bs-target="#TransferwalletToPaypal">
                                                    Transfer To Paypal
                                                </button>
                                            @endif
                                        </h5>
                                    </div>
                                    <hr>

                                    <div class="col-md-12 d-flex1 justify-content-between align-items-center mb-3">
                                        <div class="row">
                                            <div class="col-md-8 bg-light pt-2 mt-1">
                                                <h5 class="fs-6">
                                                    Stream Key: {{ $profile->stream_key }}

                                                    <div style="display:none">
                                                        <input type="text" id="myInputCopy" value="{{ $profile->stream_key }}">
                                                    </div>
                                                </h5>
                                            </div>
                                            <div class="col-md-4 mt-1">
                                                <button onclick="myFunctionCopy()" class="btn btn-success">
                                                    Copy Stream Key
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="text-right">List Of Deposits </h5>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-responsive">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Deposited Amount</th>
                                                    <th>Transaction Id</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($deposits as $k => $deposite)
                                                    <tr>
                                                        <td>{{ $deposite->transaction_amount }}</td>
                                                        <td>{{ $deposite->transaction_id }}</td>
                                                        <td>{{ $deposite->comment }}</td>
                                                        <td>{{ $deposite->created_at }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>

                                    <div class="col-md-12 d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="text-right">List Of withdrawals</h5>
                                    </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Withdrawal Amount</th>
                                                        <th>Email Id</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($withdrawls as $withdrawl)
                                                        <tr>
                                                            <td>{{ $withdrawl->transaction_amount }}</td>
                                                            <td>{{ $withdrawl->email_id }}</td>
                                                            <td>{{ $withdrawl->created_at }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <a href="{{ route('my_transactions') }}" title="View All Transaction">View All</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="p-3 py-5">
                                    <button type="button" class="btn btn-success purchase_elo_btn"
                                        data-bs-toggle="modal" data-bs-target="#exampleModalCenter1">
                                        Purchase ELO
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    @include('purchase_elo')

    @include('transfer_elo')
@endsection

@section('js')
    <script src="https://www.paypal.com/sdk/js?client-id={{ \Crypt::decryptString($setting->client_id) }}&currency=USD"></script>
    <script type="text/javascript">
        $('#completion-block').hide();

        $('#trasfer_submit').click(function () {
            var wallet_balace = parseFloat($('#wallet_balace').val());
            var amount = parseFloat($('#amount').val());
            var paypal_email = $('#paypal_email').val();
            if (!Number.isNaN(amount)) {
                if (paypal_email.length) {
                    if (amount > wallet_balace) {
                        alert('You can withdrawal - ' + wallet_balace + ' ');
                    } else {
                        $('#create_bet2_frm').submit();
                    }
                } else {
                    alert('Please enter paypal email id')
                }
            } else {
                alert('Please enter amount')
            }
        });

        $("#purchase_elo").keyup(function () {
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
                return actions.order.capture().then(function (orderData) {
                    const transaction = orderData.purchase_units[0].payments.captures[0];

                    transaction_id = transaction.id;
                    status = transaction.status;
                    console.log("inside COMPLETED status");

                    $('#completion-block').show();

                    payment_success = 1;
                    if (transaction.status == 'COMPLETED')
                        $('#completion-text').text("Your payments processed successfully, Payment Status: " + transaction.status);
                    else
                        $('#completion-text').text("Your payments is on hold, Payment Status: " + transaction.status);

                    $('#model_body').hide();
                    $('#paypal-button-container').hide();

                    var purchase_elo = $('#purchase_elo').val();

                    var usd_amount = purchase_elo * conversion;

                    var param = "?status=" + transaction.status + "&transaction_id=" + transaction.id + "&elo_amount=" + purchase_elo + "&usd_amount=" + usd_amount + "&user_name=" + username;

                    $.ajax({
                        type: "POST",
                        url: "{{url('/transfer_paypal_to_wallet')}}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            status: transaction.status,
                            transaction_id: transaction.id,
                            elo_amount: purchase_elo,
                            usd_amount: usd_amount
                        },
                        dataType: 'JSON',
                        success: function (data) {
                            window.location.href = "{{url('/profile')}}"
                        }
                    });
                });

            }
        }).render('#paypal-button-container');

        var is_open_popup = "{{$open_popup}}";
        if (is_open_popup == "1") {
            $('.purchase_elo_btn').trigger("click");
        }

        function myFunctionCopy() {
            var copyText = document.getElementById("myInputCopy");

            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);
            alert("Copied the text: " + copyText.value);
        }
    </script>
@endsection
