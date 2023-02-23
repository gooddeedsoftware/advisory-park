<div class="modal" id="fbModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ffeed">Feedback</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <div class="modal-body">
             <form id="fb-form">
                <div class="form-group mb-2 text-center" id="rating-ability-wrapper">
                    <input type="hidden" id="fbid" >
            	    <input type="hidden" id="selected_rating" name="selected_rating" value="">
            	 
            	    <!--<h2 class="bold rating-header" style="">
            	    <span class="selected-rating">0</span><small> / 5</small>
            	    </h2>-->
            	    <input type="hidden" class="rating" >
            	    <button type="button" class="btnrating btn btn-default btn-lg" data-attr="1" id="rating-star-1">
            	        <i class="fa fa-star" aria-hidden="true"></i>
            	    </button>
            	    <button type="button" class="btnrating btn btn-default btn-lg" data-attr="2" id="rating-star-2">
            	        <i class="fa fa-star" aria-hidden="true"></i>
            	    </button>
            	    <button type="button" class="btnrating btn btn-default btn-lg" data-attr="3" id="rating-star-3">
            	        <i class="fa fa-star" aria-hidden="true"></i>
            	    </button>
            	    <button type="button" class="btnrating btn btn-default btn-lg" data-attr="4" id="rating-star-4">
            	        <i class="fa fa-star" aria-hidden="true"></i>
            	    </button>
            	    <button type="button" class="btnrating btn btn-default btn-lg" data-attr="5" id="rating-star-5">
            	        <i class="fa fa-star" aria-hidden="true"></i>
            	    </button>
            	</div>
               
                <textarea name="feedback" class="form-control" id="feedback" cols="30" rows="3" placeholder="Give your feedback...."></textarea>
                
                <button type="button" class="btn btn-primary feedback_save theme-bg theme-border mt-2 float-right">Save</button>
            </form>
            </div>

            <!--<div class="modal-footer">
              
            </div>-->
        </div>
    </div>
</div>
