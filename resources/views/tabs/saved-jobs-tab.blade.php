<div class="product-feed-tab" id="saved-jobs-ss">
    <div class="posts-section">
        @if(count($saved_post) > 0)
        @foreach($saved_post as $data)
        <div class="post-bar">
            <div class="post_topbar">
                <div class="usy-dt">
                    <img src="http://via.placeholder.com/50x50" alt="">
                    <div class="usy-name">
                        @php 
                       
                            $post_creator =	App\Models\User::whereId($data->posts->created_by)->first();
                        @endphp
                        <h3>{{$post_creator->name}}</h3>
                        <span><i class="fa fa-clock-o theme-color"></i> {{$data->posts->created_at->diffForHumans()}}</span>
                    </div>
                </div>
                
            </div>
            <div class="epi-sec">
                <ul class="descp">
                    <li><span><i class="fa fa-globe theme-color"></i> {{$post_creator->designation}}</span></li>
                    <li><span><i class="fa fa-map-marker theme-color"></i> {{$post_creator->address}}</span></li>
                </ul>
                <ul class="bk-links">
                    <!--<li><a href="#" title=""><i class="la la-bookmark"></i></a></li>-->
                    <!--<li><a href="#" title=""><i class="la la-envelope"></i></a></li>-->
                </ul>
            </div>
            <div class="job_descp">
               {{-- 
                @php
                    $cats = getPostCategories($data->posts->category);
                    $skills = getPostSkills($data->posts->skill);
                    $tags = getPostTags($data->posts->tag);
                @endphp

                @foreach($cats as $id => $name)
                    <span class="badge badge-info float-right mr-1">{{$name}}</span>
                @endforeach
              --}}
                <h3>{{$data->posts->title}}</h3>
                <!--<ul class="job-dt">
                    <li><a href="#" title="">Full Time</a></li>
                    <li><span>$30 / hr</span></li>
                </ul>-->
                <p class="more">{{$data->posts->description}}</p>
                {{--
                <ul class="skills">
                    @foreach($skills as $name)
                    <li><a href="javascript:void(0);" title="">{{$name}}</a></li>
                    @endforeach
                </ul>

                
                <ul class="skill-tags">
                    @foreach($tags as $name)
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
                        <a href="javascript:void(0)" onclick="openComment({{$data->id}})" class="comment p-0"> <i class="la la-comment"></i> Comment {{ count($data->comments) }}</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="share"> <i class="la la-share"></i> Share </a>
                    </li>

                    <li class="social-media-icons" style="display: none;">
                        <a target="_blank" href="https://api.whatsapp.com/send?text={{route('post_details',$data->posts->slug)}}" data-action="share/whatsapp/share">
                            <i class="la la-whatsapp"></i>
                        </a>
                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{route('post_details',$data->posts->slug)}}">
                            <i class="la la-facebook"></i>
                        </a>
                        <a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url={{route('post_details',$data->posts->slug)}}">
                            <i class="la la-linkedin"></i>
                        </a>
                        <a target="_blank" href="https://telegram.me/share/url?url={{route('post_details',$data->posts->slug)}}">
                            <i class="la la-telegram"></i>
                        </a>
                        <a target="_blank" href="https://twitter.com/intent/tweet?text={{route('post_details',$data->posts->slug)}}">
                            <i class="la la-twitter"></i>
                        </a>
                    </li>

                    @else
                    <li>
                        <a href="{{route('login')}}"> <i class="la la-heart-o"></i> Like {{App\Models\Like::where('blog_type','post')->where('blog_id',$data->id)->where('status',1)->count()}}</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" onclick="openComment({{$data->id}})" class="comment p-0"> <i class="la la-comment"></i> Comment {{ count($data->comments) }}</a>
                    </li>
                    <li>
                        <a href="{{route('login')}}" class="share"> <i class="la la-share"></i> Share</a>
                    </li>
                    @endauth
                </ul>
                <!--<a><i class="la la-eye"></i>Views</a>-->
            </div>
            <div class="bg-light p-2 comment-box" id="comment-box-{{$data->id}}" style="display: none;">
                <form action="{{route('comment')}}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="@auth {{Auth::user()->id}} @endif" />
                    <input type="hidden" name="blog_type" value="post" />
                    <input type="hidden" name="blog_id" value="{{$data->id}}" />
                    <div class="">
                        <textarea class="form-control ml-1 shadow-none textarea" placeholder="write a comment..." name="comment"></textarea>
                    </div>
                    <div class="mt-2 text-right">
                        <button class="btn btn-sm shadow-none theme-bg text-light" type="submit">
                            Post comment
                        </button>
                    </div>
                </form>

                @foreach($data->comments as $cm)
                <div class="commented-section m-2">
                    <div class="d-flex flex-row align-items-center commented-user">
                        <h5 class="mr-2">{{$cm->user_name}}</h5>
                        <span class="dot mb-1"></span>
                        <span class="mb-1 ml-2">{{$cm->created_at->diffForHumans()}}</span>
                    </div>
                    <div class="comment-text-sm offset-1">
                        <p>{{$cm->comment}}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <!--<div class="job-status-bar">
                <ul class="like-com">
                    <li>
                        <a href="#"><i class="la la-heart"></i> Like</a>
                        <img src="images/liked-img.png" alt="">
                        <span>25</span>
                    </li> 
                    <li><a href="#" title="" class="com"><img src="#" alt=""> Comment 15</a></li>
                </ul>
                <a><i class="la la-eye"></i>Views 50</a>
            </div>-->
        </div>
        @endforeach
        @else
            <h5 class="text-center">No Post Found.</h5>
        @endif
        <div class="process-comm">
            <a href="#" title=""><img src="#" alt=""></a>
        </div>
    </div>
</div>