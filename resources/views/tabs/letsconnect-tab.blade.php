<div class="product-feed-tab" id="letsconnect-dd-ss">
    <div class="user-profile-ov">
        <h3>
            <a href="#" title="" class="overview-open">Let's Connect</a> 
            <!--<button type="button" title="" class="overview-open w-25 float-right form-control" ><i class="fa fa-plus"></i> Add Business Profile</button>-->
        </h3>
        <div class="table-responsive">
            @if(count($request_sent) > 0)
            <table id="example-lets" class="table display responsive" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Requested Date</th>
                        <th scope="col">Request Sent To</th>
                        <th scope="col">My Requirement</th>
                        <!--<th scope="col">Type</th>-->
                        <th scope="col">Contact</th>
                        <th scope="col">Expiry Date</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Action</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($request_sent as $k => $data)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{date('M d,Y h:i A',strtotime($data->created_at))}}</td>
                        <td>
                            <a href="{{route('user_profile',$data->advisors->id)}}" class="text-dark" target="_blank">{{$data->advisors->advisory_park_id}}</a>
                        </td>
                        <td>{{$data->requirement}}</td>
                        <!--<td>{{$data->types->name ?? ''}}</td>-->
                        <td>
                          @if($data->status == '4' )
                            <a href="tel:{{$data->advisors->contact}}" type="button" class="btn btn-sm theme-color"><!--<i class="las la-phone"></i>--> {{$data->advisors->contact}}</a>
							<a href="https://wa.me/{{$data->advisors->contact}}" target="_blank" type="button" class="btn btn-sm theme-color"><i class="la la-whatsapp theme-color"></i></a>
                          @endif
                        </td>
                        
                        
                         <td>{{$data->lead_expire_date}}
                            @php $current_date = date('Y-m-d'); @endphp
                            @if($data->lead_expire_date <= $current_date && !empty($data->lead_expire_date) )
                                <button class="btn btn-outline-danger btn-sm btn-rounded" >Expired</i></button>
                            @endif
                        </td>
                        <td>
                            @if($data->status == '7')
                                {{$data->rating}}/5 
                            @endif
                        </td>
                       
                        <td>
                            @if($data->status == '2')

                                <!--<button class="btn btn-sm mb-1 payment theme-bg text-light" onclick="reqPayment(this, 4 ,'{{$data->listing_id}}', '{{Auth::user()->id}}' , '{{$data->advisors->id}}', '{{route("advisory-details",$data->listing_id) ?? "#"}}' , '{{$data->fees}}' , '{{$data->id}}');" data-toggle="tooltip" data-placement="top" title="Payment" >Payment</button>-->
                                <button class="btn btn-sm mb-1 payment theme-bg text-light" onclick="reqPayment(4 , '{{$data->id}}', '{{Auth::user()->id}}' , '{{$data->advisors->id}}' , '{{$data->fees}}' );" data-toggle="tooltip" data-placement="top" title="Payment" >Payment</button>
                            @elseif($data->status == '5' || $data->status == '6')
                                <a href="javascript:void(0)" type="button" class="btn btn-secondary btn-sm mb-1"  onclick="feedback(this,7,'{{$data->id}}');" data-toggle="tooltip" data-placement="top" title="Feedback(Rating)" >Feedback</a>                           
                                <!--<a href="javascript:void(0)" type="button" class="btn btn-danger btn-sm mb-1"  onclick="complain(this,'{{$data->id}}');" data-toggle="tooltip" data-placement="top" title="Complain(Report)" >Complain</a>  -->
                            @elseif($data->status !== '8') 
                                @if($data->status == '5' || $data->status == '6' || $data->status == '7' || ($data->lead_expire_date <= $current_date && !empty($data->lead_expire_date)))
                                  <!--<button class="btn btn-warning btn-sm mb-1" onclick="reRequest(this,'{{$data->advisor_id}}','{{$data->user_id}}','re-request','{{$data->type}}','{{$data->category}}');" data-toggle="tooltip" data-placement="top" title="Re-request" >Re-request</button>-->
                                  <button class="btn btn-warning btn-sm mb-1" onclick="talkToAdvisor('{{$data->advisor_id}}', '{{$data->user_id}}','re-request');" data-toggle="modal" data-toggle="tooltip" data-placement="top" title="Re-request" data-target="#talkToadvisorModal">
									Re-request
								  </button>
                               
                                @endif
                            @endif
                        </td>
                        <td>
                            <span class="badge @if($data->status == '1') badge-warning @elseif($data->status == '2') badge-success @elseif($data->status == '3') badge-danger @elseif($data->status == '4') badge-info @elseif($data->status == '5') badge-success @elseif($data->status == '6') badge-secondary @elseif($data->status == '7') badge-dark @elseif($data->status == '8') badge-light @endif">
                                @if($data->status == '1') 
                                    Pending 
                                @elseif($data->status == '2') 
                                    Accepted
                                @elseif($data->status == '3') 
                                    Rejected
                                @elseif($data->status == '4')
                                    Payment Done 
                                @elseif($data->status == '5')
                                    Completed
                                @elseif($data->status == '6') 
                                    Dismissed 
                                @elseif($data->status == '7') 
                                    Feedback Done
                                @elseif($data->status == '8') 
                                    Re-requested
                                @endif
                            </span>
                                @if($data->status == '3')
                                    ({{$data->reason_for_reject}}) 
                                @endif
                        </td>
                        
                    </tr>
                    @endforeach
                   
                </tbody>
            </table>
            @else
            <h5 class="text-center">No Request Found.</h5>
            @endif
        </div>	
    </div>	
</div>