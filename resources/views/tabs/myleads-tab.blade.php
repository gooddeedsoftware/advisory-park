<div class="product-feed-tab" id="myleads-dd-ss">							
    <div class="user-profile-ov">
            <h3>
            <a href="#" title="" class="overview-open">Leads</a> 
            <!--<button type="button" title="" class="overview-open w-25 float-right form-control" ><i class="fa fa-plus"></i> Add Business Profile</button>-->
        </h3>
        @if(count($advisory_request) > 0)
        <table id="example-mylead" class="table display responsive" cellspacing="0" style="width: 100%;text-overflow: ellipsis;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Requester </th>
                    <th scope="col">Requirement</th>
                    <th scope="col">Source</th>
                    <th scope="col">Field</th>
                    <th scope="col">Expiry Date</th>
                    <th scope="col">Action</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($advisory_request as $k => $data)
                <tr>
                    <th scope="row">{{++$k}}</th>
                    <td>{{date('M d,Y h:i A',strtotime($data->created_at))}}</td>
                    <td>
                        <a href="{{route('user_profile',$data->users->id)}}" class="text-dark">{{$data->users->advisory_park_id}}</a>
                    </td>
                    <td>{{$data->requirement}}</td>
                    <td>{{$data->lead_source}}</td>
                    <td>{{$data->categories->name ?? ''}}</td>
                    
                    <td>{{$data->lead_expire_date}}
                        @php $current_date = date('Y-m-d'); @endphp
                        @if($data->lead_expire_date <= $current_date && !empty($data->lead_expire_date) )
                            <button class="btn btn-outline-danger btn-sm btn-rounded" >Expired</i></button>
                        @endif
                    </td>
                    <td>
                        @if($data->status == '1')
                            <button class="btn btn-sm mb-1 theme-bg text-light" onclick="reqAccept(this,2,'{{$data->id}}');" data-toggle="tooltip" data-placement="top" title="Accept" >Accept</i></button>
                            <button class="btn btn-danger btn-sm " onclick="reqClose(this,3,'{{$data->id}}');" data-toggle="tooltip" data-placement="top" title="Reject" >Reject</i></button>
                        
                        @elseif($data->status == '4')
                            <button class="btn btn-success btn-sm mb-1" onclick="completed(this,5,'{{$data->id}}');" data-toggle="tooltip" data-placement="top" title="Complete" >Complete</button>
                            <button class="btn btn-danger btn-sm mb-1" onclick="dismiss(this,6,'{{$data->id}}');" data-toggle="tooltip" data-placement="top" title="Dismiss" >Dismiss</button>
                        @endif
                        
                    </td>
                    <td>
                        <span class="badge @if($data->status == '1') badge-warning @elseif($data->status == '2') badge-success @elseif($data->status == '3') badge-danger @elseif($data->status == '4') badge-info @elseif($data->status == '5') badge-success @elseif($data->status == '6') badge-secondary @elseif($data->status == '7') badge-dark @elseif($data->status == '8') badge-light @endif">
                        @if($data->status == '1') 
                            Pending 
                        @elseif($data->status == '2') 
                            Accepted
                        @elseif($data->status == '3') 
                            Rejected By Me 
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
                            @if($data->status == '7' && $data->feedback != null) 
                                ({{$data->feedback}})
                            @endif
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
        @else
        <h5 class="text-center">No Lead Found.</h5>
        @endif
    </div>	

</div>