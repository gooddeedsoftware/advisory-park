@foreach($posts as $data)
<div class="post-bar">
    <div class="post_topbar">
        <div class="usy-dt row">
            <div class="col-md-10">
                @if(empty($data->users->image))
                    <img  src="http://via.placeholder.com/50x50" style="width:17%" alt="">
                @else
                    <img  src='{{asset("front/images/users")}}/{{$data->users->image}}' style="width:10%" alt="">
                @endif
                <div class="usy-name">
                    
                    <a href="{{route('user_profile',$data->users->id)}}" target="_blank" class="text-dark">
                        <h3 class="mb-0">
                            {{$data->users->name}} <span class="text-success">{{$data->users->advisory_park_id}}</span>
                            @auth <i class="user_status_{{$data->users->id}} user_active_status fa fa-circle {{($data->users->is_active == '1') ? 'text-success' : 'text-danger' }} " aria-hidden="true"></i>@endauth
                        </h3> 
                    </a>
                    @php
                        $followers = App\Models\Follower::where('auth_id',$data->users->id)->where('status',1)->count();
                    @endphp
                    <span> {{$followers}} Followers</span><br>
                    <span> Joined since {{$data->users->created_at->diffForHumans()}}</span>
                    
                </div>
            </div>
            <div class="col-md-2">
                @auth
                    @if($data->users->id != Auth::user()->id)
                        <!-- @if(App\Models\Following::where('auth_id',Auth::user()->id)->where('user_id',$data->users->id)->where('status',1)->exists() == true)
                        <a class="btn btn-success btn-sm rounded" href="{{route('following')}}?auth_id={{Auth::user()->id}}&user_id={{$data->users->id}}" style="margin-left:6rem">
                            <i class=" fa fa-check"></i> Following
                        </a>
                        @else
                        <a class="btn btn-outline-success btn-sm rounded" href="{{route('following')}}?auth_id={{Auth::user()->id}}&user_id={{$data->users->id}}" >
                            <i class=" fa fa-plus"></i> Follow
                        </a>
                        @endif -->
                    
                        <a  class="float-right" href="{{route('save')}}?user_id={{Auth::user()->id}}&blog_type=post&blog_id={{$data->id}}" style="font-size:24px;margin-left:190px;">
                            {!! App\Models\Save::where('user_id',Auth::user()->id)->where('blog_type','post')->where('blog_id',$data->id)->where('status',1)->exists() == true ? '<i class="fa fa-bookmark" style="color:#008069;" ></i>' : '<i class="fa fa-bookmark-o" style="color:#000;" ></i>' !!}
                        </a>
                    @endif
                @else
                    <!-- <a href="{{route('login')}}" class="btn btn-outline-success btn-sm" title="" style="margin-left:8rem;">
                        <i class=" fa fa-plus"></i> Follow
                    </a> -->
                    <a href="{{route('login')}}" title="" style="font-size:24px;margin-left:190px;">
                        <i class="fa fa-bookmark-o" style="color:#000;"></i> 
                    </a>
                @endauth
            </div>
        </div>
    
    </div>
    <div class="epi-sec">
        <!--<ul class="descp">
            <li><span><i class="fa fa-globe theme-color"></i> {{$data->users->designation ?? ''}}</span></li>
            <li><span><i class="fa fa-map-marker theme-color"></i> {{$data->users->city ?? ''}}</span></li>
        </ul>-->
        
    </div>
    <div class="job_descp">
        <?php
            /*$cats = getPostCategories($data->category);
            $skills = getPostSkills($data->skill);
            $tags = getPostTags($data->tag);*/
            $fields = getPostFields($data->skill);
        ?>
        
        @if($data->image)
            
            <a data-fancybox data-type="image" href='{{asset("front/images/posts/$data->image")}}'>
                <img src='{{asset("front/images/posts/$data->image")}}' alt="" width="120" height="120" style="border-radius: 3px;box-shadow: 0 0 8px rgb(0 0 0 / 63%);margin-right:15px;" />
            </a>
        @else
            <a data-fancybox data-type="image" href='{{asset("front/images/empty.png")}}'>
                <img src='{{asset("front/images/empty.png")}}' alt="" width="120" height="120" style="border-radius: 3px;box-shadow: 0 0 8px rgb(0 0 0 / 63%);margin-right:15px;" />
            </a>
            
        @endif
        
        @foreach($fields as $id => $name)
            <span class="badge badge-info float-right mr-1">{{$name}}</span>
        @endforeach
        <a href="{{route('post_details',$data->slug)}}" target="_blank"><h3>{{$data->title}}</h3></a>
        <!--<ul class="job-dt">
            <li><a href="#" title="">Full Time</a></li>
            <li><span>$30 / hr</span></li>
        </ul>-->
        <p class="more">{{$data->description}}</p> 
        <!--<p>{{Str::limit($data->description,200)}} <a href="#" title="">view more</a></p>-->
        {{--
        <ul class="skills">
            @foreach($skills as $id => $name)
            <li><a href="javascript:void(0);" title="">{{$name}}</a></li>
            @endforeach
        </ul>
        
        <ul class="skill-tags">
            @foreach($tags as $id => $name)
            <li><a href="javascript:void(0);" title="">{{$name}}</a></li>
            @endforeach
        </ul>
        --}}
    </div>
    <div class="job-status-bar">
        <ul class="like-com">
            @auth
                <li>
                <a href="{{route('like')}}?user_id={{Auth::user()->id}}&blog_type=post&blog_id={{$data->id}}" {!! App\Models\Like::where('user_id',Auth::user()->id)->where('blog_type','post')->where('blog_id',$data->id)->where('status',1)->exists() == true ? 'style="color:#008069"' : '' !!}>
                    <i class="la la-heart" ></i> Like {{App\Models\Like::where('blog_type','post')->where('blog_id',$data->id)->where('status',1)->count()}} 
                    </a>
                </li>
                <li>
                <a href="javascript:void(0)" onclick="openComment({{$data->id}})" class="comment p-0">
                    <i class="la la-comment"></i> Comment {{ count($data->comments) }}</a>
                </li>
                <li>
                <a href="javascript:void(0)" onclick="share({{$data->id}})">
                    <i class="la la-share"></i> Share </a>
                </li>
                
                <li class="social-media-icons-{{$data->id}}" style="display: none;">
                <a target="_blank" href="https://api.whatsapp.com/send?text={{route('post_details',$data->slug)}}" data-action="share/whatsapp/share">
                    <i class="la la-whatsapp"></i>
                </a> 
                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{route('post_details',$data->slug)}}">
                    <i class="la la-facebook"></i>
                </a> 
                <a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url={{route('post_details',$data->slug)}}">
                    <i class="la la-linkedin"></i>
                </a>
                <a target="_blank" href="https://telegram.me/share/url?url={{route('post_details',$data->slug)}}">
                    <i class="la la-telegram"></i>
                </a> 
                <a target="_blank" href="https://twitter.com/intent/tweet?text={{route('post_details',$data->slug)}}">
                    <i class="la la-twitter"></i>
                </a> 
                </li>
                
                @else
                <li>
                <a href="{{route('login')}}">
                    <i class="la la-heart-o"></i> Like {{App\Models\Like::where('blog_type','post')->where('blog_id',$data->id)->where('status',1)->count()}}</a>
                </li>
                <li>
                <a href="javascript:void(0)" onclick="openComment({{$data->id}})" class="comment p-0">
                    <i class="la la-comment"></i> Comment {{ count($data->comments) }}</a>
                </li>
                <li>
                <a href="{{route('login')}}" class="share">
                    <i class="la la-share"></i> Share</a>
                </li>
                @endauth
        </ul>
        <!-- <a><i class="la la-eye"></i>Views</a> -->
    </div>
    <div class="bg-light p-2 comment-box" id="comment-box-{{$data->id}}" style="display:none;">
        <form action="{{route('comment')}}" method="post">
            @csrf
            <input type="hidden" name="user_id" value="@auth {{Auth::user()->id}} @endif">
            <input type="hidden" name="blog_type" value="post">
            <input type="hidden" name="blog_id" value="{{$data->id}}">
            <div class="">
                <textarea class="form-control ml-1 shadow-none textarea" placeholder="write a comment..." name="comment"></textarea>
            </div>
            <div class="mt-2 text-right">
                <button class="btn btn-sm shadow-none" type="submit" style="background:#008069;color:#fff">
                    Post comment
                </button>
            </div>
        </form>
            
        @foreach($data->comments as $cm)
        <div class="commented-section m-2">
            <div class="d-flex flex-row align-items-center commented-user">
                <span class="mr-2"> {{$cm->user_name}}</span>
                <span class="dot mb-1"></span>
                <span class="mb-1 ml-2" style="font-size:11px;height:7px;">{{$cm->created_at->diffForHumans()}}</span>
            </div>
            <div class="comment-text-sm offset-1">
                <p>{{$cm->comment}}</p>
            </div>
        </div>
        @endforeach 
    </div>
</div>
@endforeach
