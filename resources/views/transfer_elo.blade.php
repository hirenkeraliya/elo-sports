<div class="modal fade" id="TransferwalletToPaypal" tabindex="-1" role="dialog"
    aria-labelledby="TransferwalletToPaypalTitle" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <form action="{{ url('/transfer_to_paypal') }}" method="post" id="create_bet2_frm">@csrf
        @method('POST')
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: #13143e;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Money Withdrawal</h5>
                </div>

                <div class="modal-body">
                    <p>
                        <label>Enter Amount</label>
                        <input type="number" required name="amount" min="1"
                            max="{{ round($profile->elo_balance,PHP_ROUND_HALF_DOWN) }}" id="amount"
                            class="form-control" placeholder="Enter Amount" maxlength="">
                    </p>

                    <p>
                        <label>Enter Paypal Email Id</label>
                        <input type="email" required name="paypal_email" id="paypal_email" class="form-control"
                            placeholder="Enter Paypal Email Id" maxlength="200" value="{{ $profile->paypal_email }}">
                    </p>
                </div>

                <div class="modal-footer">
                    <input type="hidden" id="wallet_balace" value="{{ $profile->elo_balance }}">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" value="Submit" class="btn btn-primary" id="trasfer_submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>