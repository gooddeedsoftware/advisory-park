<div class="product-feed-tab" id="myscorecard-dd-ss">
    <div class="user-profile-ov">
        <h3>
            <a href="#" title="" class="overview-open">Score Card</a>
        </h3>
        <div class="row">
            <div class="col-md-5">
                <ul>
                    <li>No. of Followers : {{$follower ??  0 }}</li>
                    <li>Total Request Completed: {{$completed_adv_req ?? 0}}</li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul>
                    <li>Total Requested : {{count($advisory_request) ?? 0}}</li> 
                    <li>Total Request Rejected : {{$rejected_adv_req ?? 0}}</li>
                    
                </ul>
            </div>
        </div>
    </div>
</div>
