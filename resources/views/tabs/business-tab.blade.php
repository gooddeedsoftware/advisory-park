<div class="product-feed-tab" id="business-dd-ss">
    <div class="user-profile-ov">
        <h3>
            <a href="#" title="" class="overview-open">Business Profile</a> 
            <!--<button type="button" title="" class="overview-open w-25 float-right form-control" ><i class="fa fa-plus"></i> Add Business Profile</button>-->
            <button type="button" class="btn w-25 float-right business-profile-jb theme-bg text-light" data-toggle="modal" data-target=".business-profile-modal" ><i class="fa fa-plus text-light"></i> Add Business Profile</button>
        </h3>
        <table class="table table-responsive display responsive" id="example-business" cellspacing="0" style="width:100%;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name of the Organization</th>
                    <th scope="col">State</th>
                    <th scope="col">City</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($business_profile as $k=>$data)
                    <tr>
                        <td scope="row">{{++$k}}</td>
                        <td>{{$data->org_name}}</td>
                        <td>{{$data->state}}</td>
                        <td>{{$data->city}}</td>
                        <td>
                            <li class="list-inline-item">
                                <button class="btn btn-primary btn-sm rounded-0 editbp" type="button" data-toggle="tooltip" data-placement="top" title="Edit" data-id="{{$data->id}}"><i class="fa fa-edit"></i></button>	
                            </li>
                            <li class="list-inline-item">
                                <button class="btn btn-danger btn-sm rounded-0 deletebp" type="button" data-toggle="tooltip" data-placement="top" title="Delete" data-id="{{$data->id}}" ><i class="fa fa-trash"></i></button>
                            </li>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        
        </table>	
    </div>	
</div>