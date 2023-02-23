<div class="product-feed-tab" id="myposts-dd-ss">
    <div class="user-profile-ov">
        <h3>
            <a href="#" title="" class="overview-open">My Post</a>
            <!--<button type="button" title="" class="overview-open w-25 float-right form-control" ><i class="fa fa-plus"></i> Add Business Profile</button>-->
            <!-- <button type="button" class="btn w-25 float-right " data-toggle="modal" data-target=".mypost-modal" ><i class="fa fa-plus"></i> Add Post</button> -->
            <button type="button" class="btn w-25 float-right theme-bg text-light"><a class="post-jb active" href="#" title="">Add Post</a></button>
        </h3>
        <table class="table display responsive example" cellspacing="0" style="width: 100%;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Post</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $k => $post)
                <tr>
                    <th scope="row">{{++$k}}</th>
                    <td><a href="{{route('post_details',$post->slug)}}" target="_blank" class="theme-color">{{$post->title}}</a></td>
                    <td>
                        @if(!empty($post->image))
                        <a target="_blank" href="{{url('front/images/posts/'.$post->image)}}"><img src="{{asset('front/images/posts/'.$post->image)}}" width="50px" class="" alt="" /></a>
                        @else N/A @endif
                    </td>
                    <td>
                        <a href="{{route('post_details',$post->slug)}}"  type="button" target="_blank" class="btn btn-warning btn-sm mr-1" data-toggle="tooltip" data-placement="top" title="View" data-id="{{$post->id}}"><i class="fa fa-eye"></i></a>
                        <button class="btn btn-info btn-sm editPost mr-1" data-toggle="tooltip" data-placement="top" title="Edit" data-id="{{$post->id}}"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm deletePost" data-toggle="tooltip" data-placement="top" title="delete" data-id="{{$post->id}}"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
