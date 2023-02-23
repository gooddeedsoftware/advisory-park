<div class="product-feed-tab" id="advisory-report-dd-ss">	
    
    <div class="user-profile-ov">
          
            <h3>
            <a href="#" title="" class="overview-open">Advisory Report</a> 
            </h3>
            
            
        
        
      
        <table class="table display responsive" id="example-adv-rep" cellspacing="0" style="width: 100%;">
            <thead>
                <tr>
                      <th> # </th>
                      <th> Date </th>
                      <th> Advisory / Requirement </th>
                      <th> Advisory Type </th>
                      <th> Advisory Fees</th> 
                      <th> Portal Charge</th> 
                      <th> Final Amount</th>
                      <!--<th> Advisors </th>-->
                      <th>Status</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($advReport as $k=>$data)
                <tr>
                    <td> {{++$k}} </td>
                    <td>  {{date('d-m-Y h:i A',strtotime($data->created_at))}} </td>
                    <td> <a href="{{$data->advisory_link ?? '#'}}" target="_blank" >{{$data->requirement ?? ''}}</a> </td>
                    <td> 
                        {{$data->lead_type}}
                    </td>
                    <td> 
                        {{$data->fees}}
                    </td>
                    <td> 
                        {{portalCharge($data->fees)}}
                    </td>
                    <td> 
                        {{$data->fees - portalCharge($data->fees)}}
                    </td>
                    {{--<td> 
                        {{$data->advisors->advisory_park_id}} 
                    </td--}}
                    <td>
                        <!--<span class="badge @if($data->status == 'TXN_SUCCESS') badge-success @else badge-danger @endif " >{{$data->status}}</span>-->
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
                    </td>
                   
                </tr>
                @endforeach
                
            </tbody>
        </table>
      
    </div>	
    

</div>