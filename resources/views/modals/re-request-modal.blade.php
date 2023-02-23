<!--Re-Request Advisory Modal-->
	<div class="modal fade" id="reRequestModal" tabindex="-1" role="dialog" aria-labelledby="reRequestModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="reRequestModalLabel">Re-request Advisory</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="request-form" method="post" action="{{route('advisory.re_request')}}">
                @csrf
                    <input type="hidden" value="" id="re_req_advisor_id" name="advisor_id">
                    <input type="hidden" value="" id="re_req_user_id" name="user_id">
                    <input type="hidden" value="" id="re_req_listing_name" name="listing_name">
                    <input type="hidden" value="" id="re_req_type" name="type">
                    <input type="hidden" value="" id="re_req_category" name="category">
                    <input type="hidden" value="Re-request"  id="re_req_source" name="lead_source" >
                
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Write about your advisory requirement</label>
                    <textarea class="form-control" id="message-text" name="requirement" placeholder="Write about your advisory requirement" required></textarea>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Lead Expire Date:</label>
                    <input type="date" class="form-control" id="lead_expire_date" min="@php echo date('Y-m-d',strtotime('now')) @endphp"  name="lead_expire_date" >
                </div>
            
          </div>
          <div class="modal-footer">
            <!--<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>-->
            <button type="submit" class="btn btn-sm" style="background-color:#008069;color:#fff;">Send Re-request</button>
          </div>
          </form>
        </div>
      </div>
    </div>
<!--Re-Request Advisory Modal-->