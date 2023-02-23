
<div class="modal fade" id="complainModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Complain(Report)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" action="{{route('complain')}}">
            @csrf
                <input type="hidden" name="lead_id" id="lead_id">
            <div class="modal-body">
              <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject">
              </div>
              <div class="form-group">
                <label for="desc">Description</label>
                <textarea class="form-control" id="desc" placeholder="Explain in Brief...." name="description" rows="6" aria-describedby="emailHelp"></textarea>
              </div>
              
              <small id="emailHelp" class="form-text text-muted">Your information is safe with us.</small>
            </div>
            <div class="modal-footer border-top-0 d-flex">
              <button type="submit" class="btn btn-primary theme-bg theme-border mt-2 float-right">Submit</button>
            </div>
        </form>
    </div>
  </div>
</div>