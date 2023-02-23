<div class="product-feed-tab" id="complain-dd-ss">
    <div class="user-profile-ov">
        <h3>
            <a href="#" title="" class="overview-open">Complain's</a> 
            <!--<button type="button" title="" class="overview-open w-25 float-right form-control" ><i class="fa fa-plus"></i> Add Business Profile</button>-->
        </h3>
        <div class="table-responsive">
            @if(count($complains) > 0)
            <table id="example-lets" class="table display responsive" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Advisory Lead</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created By</th>
                        <!--<th scope="col">Action</th>-->
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($complains as $k => $data)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>
                            <a href="{{route('advisory-details',$data->lead->id)}}" class="text-dark" target="_blank">{{$data->lead->requirement ?? ''}}</a>
                        </td>
                        <td>{{$data->subject}}</td>
                        <td>{{$data->description}}</td>
                        <td>{{$data->status}}</td>
                        <td>{{$data->users->name ?? ''}}</td>
                        
                       
                        <!--<td>{{date('M d,Y h:i A',strtotime($data->created_at))}}</td>-->
                        
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