<div class="modal" id="reqPayModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Advisor's Amount(Advisory Fees)</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form id="request-form" method="post" action="{{route('paytm.payment')}}">
                    @csrf
                    <input type="hidden" value="" id="user_id_x" name="user_id">
                    <input type="hidden" value="" id="advisor_id_x" name="advisor_id">
                    <input type="hidden" value="" id="advisory_request_id_x" name="advisory_request_id">
                    <input type="hidden" value="" id="status_x" name="status">
                  <div class="form-group">
                    <label for="total-fees" class="col-form-label">Amount:</label>
                    <input type="text"  value="" class="form-control" id="fees_x" name="fees" readonly>
                  </div>
                  
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary payment_save theme-bg">Payment</button>
            </div>
            </form>
        </div>
    </div>
</div>
