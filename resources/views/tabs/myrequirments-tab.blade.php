<div class="product-feed-tab" id="myrequirments-dd-ss">
    <div class="user-profile-ov">
        <h3>
            <a href="#" title="" class="overview-open">My Requirements</a> 
            <!--<button type="button" title="" class="overview-open w-25 float-right form-control" ><i class="fa fa-plus"></i> Add Business Profile</button>-->
        </h3>
        <div class="table-responsive">
            <table id="example-myreq" class="table display responsive" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <!--<th scope="col">Category</th>-->
                        <th scope="col">Skills</th>
                        <!--<th scope="col">Tag</th>-->
                        <!--<th scope="col">Description</th>-->
                        <!--<th scope="col">Created by</th>-->
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requirements as $k => $data)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td><a href="{{route('requirements_details',$data->slug)}}" target="_blank" class="theme-color">{{$data->title}}</a></td>
                     
                        <?php 
                            // $cats = getPostCategories($data->category); 
                            // $tags = getPostTags($data->tag);
                            $skills = getPostFields($data->skill);
                        ?>
                     
                    {{--
                        <td> @if($data->category) @foreach($cats as $v) {{$v ?? 'N/A'}}, @endforeach @endif</td>
                        
                        <td>@if($data->tag) @foreach($tags as $v) {{$v ?? 'N/A'}}, @endforeach @endif</td>
                     --}}
                        
                        <td>@if($data->skill) @foreach($skills as $v) {{$v ?? 'N/A'}}, @endforeach @endif</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <!--<td>{{$data->description}}</td>-->
                        <!--<td>
                            <a href="{{route('user_profile',$data->users->id)}}" target="_blank" class="text-dark">{{$data->users->advisory_park_id ?? ''}}</a>
                        </td>-->
                        <td>
                            <a href="{{route('requirements_details',$data->slug)}}" target="_blank" type="button" class="btn btn-warning btn-sm mr-1" data-toggle="tooltip" data-placement="top" title="View" data-id="{{$data->id}}"><i class="fa fa-eye"></i></a>
                            <!--<button class="btn btn-info btn-sm editRequirement mr-1" data-toggle="tooltip" data-placement="top" title="Edit" data-id="{{$data->id}}"><i class="fa fa-edit"></i></button>-->
                            <button class="btn btn-danger btn-sm deleteRequirement" data-toggle="tooltip" data-placement="top" title="delete" data-id="{{$data->id}}"><i class="fa fa-trash"></i></button>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>	
    </div>
</div>