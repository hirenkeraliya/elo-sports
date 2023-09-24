<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #13143e;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Purchase ELO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="close_modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" id="model_body">
                <div class="mb-3">
                    <label for="purchase_elo" class="form-label">Enter ELO</label>
                    <input type="number" class="form-control" id="purchase_elo"
                        placeholder="How much ELO you want to purchase?">
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