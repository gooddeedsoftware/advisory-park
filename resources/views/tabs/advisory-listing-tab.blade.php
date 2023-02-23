
<div class="product-feed-tab" id="advisory-listing-dd-ss">
    <div class="user-profile-ov">
        <h3>
            <a href="#" title="" class="overview-open">Advisory Listings</a> 
            <!--<button type="button" title="" class="overview-open w-25 float-right form-control" ><i class="fa fa-plus"></i> Add Business Profile</button>-->
            <button type="button" class="btn w-25 float-right advisory-listing-jb theme-bg text-light"  data-toggle="modal" data-target=".advisory-listing-modal" ><i class="fa fa-plus text-light"></i> Add Advisory Listing</button>
        </h3>
        <!--<table class="table">-->
        <div class="table-responsive row advisory_listing" style="overflow:scroll">
            <table class="table table-responsive display responsive" id="example-adv-list" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Listing Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Field</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Advisory Charges</th>
                        <th scope="col">Available</th>
                        <th scope="col">Created By</th>
                        <!--<th scope="col">Experience</th>-->
                        <th scope="col">Action</th>					
                    </tr>
                </thead>
                <tbody>
                    @foreach($advisory_listings as $k=>$data)
                        <tr >
                            <td>{{++$k}}</td>
                            <td>{{$data->listing_name}}</td>
                            <td>{{$data->types->name ?? ''}}</td>
                            <td>{{$data->field->name ?? ''}}</td>
                            <td>{{$data->duration_in_hours}} Hrs,{{$data->duration_in_minutes}} Mins</td>
                            <td>{{$data->fees}}</td>
                            <td>
                                @if(!empty($data->mode))
                                @php $mode = json_decode($data->mode)@endphp 
                                @foreach($mode as $v)
                                {{$v}},
                                @endforeach
                                @endif
                            </td>
                            <td>{{$data->users->advisory_park_id ?? ''}}</td>
                            <!--<td>{{substr($data->about_listing." ...", 0, 100)}}</td>-->
                            <!--<td>{{substr($data->experience." ...", 0, 100)}}</td>-->
                            <td>
                                <li class="list-inline-item">
                                    <button class="btn btn-info btn-sm edit-advisory mr-1 mb-1" type="button" data-toggle="tooltip" data-placement="top" title="Edit" data-id="{{$data->id}}"><i class="fa fa-edit"></i></button> 
                                </li>
                                <li class="list-inline-item">
                                    <button class="btn btn-danger btn-sm delete-advisory" type="button" data-toggle="tooltip" data-placement="top" title="Delete" data-id="{{$data->id}}" ><i class="fa fa-trash"></i></button>
                                </li>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>  	
    </div>	
</div>