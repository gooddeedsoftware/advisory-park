<div class="product-feed-tab" id="payment-dd-ss">
    <div class="user-profile-ov">
        <h3>
            <a href="#" title="" class="overview-open">Transaction History</a> 
            <!--<button type="button" title="" class="overview-open w-25 float-right form-control" ><i class="fa fa-plus"></i> Add Business Profile</button>-->
        </h3>
        <div class="card border-0">
            <div class="card-body" style="padding: 20px 20px 10px 20px;">
                
                 <form action="{{route('profile')}}">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <!--<label class="form-label">Start Date</label>-->
                                <input class="form-control " type="date"  id="start_date" name="start_date" value="{{ Request::get('start_date') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <!--<label class="form-label">End Date</label>-->
                                <input class="form-control " type="date"  id="end_date" name="end_date" value="{{ Request::get('end_date') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn theme-bg text-light btn-sm" type="submit"><i class="mdi mdi-filter"></i> Filter</button>
                        </div>
                        <div class="col-md-2">
                            <a type="button" href="{{route('profile')}}" class="btn btn-secondary btn-sm" type="submit"><i class="mdi mdi-refresh"></i> Refresh</a>
                        </div>
                    </div>
                  </form>
                  
                 <div class="row">
                    <!--<button type="button" class="btn theme-bg text-light mb-2 mr-2 float-right btn-sm " >Total Advisory Fees : {{$advSum}}</button> -->
                    <!--<button type="button" class="btn theme-bg text-light mb-2 mr-2 float-right btn-sm " >Total Portal Charge : {{portalCharge($advSum)}}</button> -->
                    <button type="button" class="btn theme-bg text-light mb-2 mr-2 float-right btn-sm " >Total Advisor Amount : {{$advSum - portalCharge($advSum)}}</button> 
                        @php 
                            $due = App\Models\Paytm::where('advisor_id',Auth::user()->id)->where('status','TXN_SUCCESS')->where('payment_type','From User Payment')->sum('amount');
                            $paid = App\Models\Paytm::where('advisor_id',Auth::user()->id)->where('status','TXN_SUCCESS')->where('payment_type','To Advisor Payment')->sum('amount');
                        @endphp
                    
                    <button type="button" class="btn theme-bg text-light mb-2 mr-2 float-right btn-sm " >Due Amount : {{$due - portalCharge($due)}}</button> 
                    
                    <button type="button" class="btn theme-bg text-light mb-2 mr-2 float-right btn-sm " >Paid Amount : {{$paid - portalCharge($paid)}}</button> 
                </div>
            </div>
        </div>
        <div class="table-responsive">
            @if($adv_payment->isNotEmpty())
            <table class="table display responsive" id="example-pay" cellspacing="0" style="width:100%;">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Transaction Id</th>
                        <th scope="col">Order Id</th>         
                        <th scope="col">Amount</th>         
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($adv_payment as $k => $data)
                    <tr>
                        <td>{{$data->transaction_date}}</td>
                        <td><a href="javascript:void(0)" target="_blank" class="theme-color">{{$data->transaction_id}}</a></td>
                        <td>{{$data->order_id}}</td>
                        <td>{{$data->amount}}</td>
                        <td><span class="badge {{$data->status == 'TXN_SUCCESS' ? 'badge-success' : 'badge-danger'}}"></span>{{$data->status == 'TXN_SUCCESS' ? 'SUCCESS' : 'FAILURE'}}</td>

                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <center>No Payment History Found!</center>
            @endif
        </div>	
    </div>
</div>