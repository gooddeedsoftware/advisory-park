@extends('layout.app')

@section('content')
	
<main>
	<div class="main-section">
		<div class="container">
			<div class="main-section-data">
				<div class="row">
					<div class="col-lg-3 col-md-4 pd-left-none no-pd suggestion navWrap">
						<div class="main-left-sidebar no-margin">
							<div class="suggestions full-width">
								<div class="sd-title">
									<h3>Top Advisory Listings</h3>
									<!--<i class="la la-ellipsis-v"></i>-->
								</div>
								<div class="suggestions-list">
									@foreach($listings as $l) 
									<div class="suggestion-usd">
										<img src='{{asset("front/images/advisory_listing/$l->image")}}' alt="" style="height:40px;width:40px">
										<div class="sgt-text">
											<a href="{{route('advisory-details',$l->slug)}}" target="_blank" class="text-dark">
												<h6 class="mt-2">{{Str::limit($l->listing_name,25)}}</h6>
											</a><br>
											<!--<p class="mb-0">{{\Str::limit($l->about_listing,30)}}</p>-->
										</div>
										
									</div>
									@endforeach	
									<div class="view-more">
										<a href="{{route('advisory')}}" title="">View More</a>
									</div>
								</div>
							</div>
							<div class="tags-sec full-width">
								<ul>
									<li><a href="#" title="">Help Center</a></li>
									<!--<li><a href="#" title="">About</a></li>-->
									<li><a href="#" title="">Privacy Policy</a></li>
									<!--<li><a href="#" title="">Community Guidelines</a></li>-->
									<!--<li><a href="#" title="">Cookies Policy</a></li>-->
									<!--<li><a href="#" title="">Career</a></li>-->
									<!--<li><a href="#" title="">Language</a></li>-->
									<li><a href="#" title="">Copyright Policy</a></li>
								</ul>
								<div class="cp-sec">
									<!--<img src="{{asset('front/images/logo2.png')}}" alt="">-->
									<p><img src="{{asset('front/images/cp.png')}}" alt="">Copyright @php echo date('Y'); @endphp</p>
								</div>
							</div><!--tags-sec end-->
						</div><!--main-left-sidebar end-->
					</div>
					<div class="col-lg-6 col-md-8 no-pd">
						<div class="main-ws-sec">
							@auth
								@if(\Session::get('type') == 'Advisor')
								<div class="post-topbar">
									<div class="user-picy">
										<img src="http://via.placeholder.com/100x100" alt="">
									</div>
									<div class="post-st">
										<ul>
										<li><a class="post-jb active" href="javascript:void(0)" title="">Post</a></li>
										</ul>
									</div>
								</div>
								@else
								<div class="post-topbar">
									
									<div class="search-bar">
										<form action="{{route('field-wise-advisory')}}">
											<input type="text" name="search" placeholder="Search Advisory...">
											<button class="btn theme-bg text-light" type="submit"><i class="la la-search text-light"></i></button>
										</form>
									</div>
								</div>
								@endif
							@else
								<div class="post-topbar">
									<div class="search-bar w-50">
										<form action="{{route('login')}}">
											<!--<button class="btn theme-bg text-light" type="submit"><i class="la la-search text-light"></i></button>-->
											<input type="text" name="search" placeholder="Search Advisory...">
										</form>
									</div>
									<div class="post-st">
										<ul>
										<li><a class="post-jb1 active" href="{{route('login')}}" title="">Create Post</a></li>
										</ul>
									</div>
								</div>
							
								
							@endauth
							<div class="posts-section" id="post-data">
								
								@include('post-data')

								<div class="ajax-load text-center" style="display:none">
									<i class="fa fa-48px fa-spin fa-spinner"></i> Loading ...
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-lg-3 pd-right-none no-pd navWrap">
						<div class="right-sidebar">
							<div class="widget widget-jobs">
								<div class="sd-title">
									<h3>Top Advisors</h3>
									<!--<i class="la la-ellipsis-v"></i>-->
								</div>
								@if(count($business_profile) > 0)
									@foreach($business_profile as $b)
									<div class="jobs-list">
										<div class="job-info">
											<div class="user-picy mr-2">
												@if(empty($b->users->image))
													<img class="rounded-circle" src="http://via.placeholder.com/50x50" alt="">
												@else
													<img class="rounded-circle" src='{{asset("front/images/users")}}/{{$b->users->image}}' alt="">
												@endif
											</div>
											<div class="job-details">
												
												<div class="sgt-text">
													<a href="{{route('user_profile',$b->users->id)}}" target="_blank" class="text-dark">{{$b->users->name}} @auth <i class="user_status_{{$b->users->id}} user_active_status fa fa-circle {{($b->users->is_active == '1') ? 'text-success' : 'text-danger' }} " aria-hidden="true"></i>@endauth</a><br>
													<span>{{$b->advisory_park_id}}</span>
												</div>
												
												@auth
													@if($b->users->id != Auth::user()->id)
													@if(App\Models\Following::where('auth_id',Auth::user()->id)->where('user_id',$b->users->id)->where('status',1)->exists() == true)
													<a class="btn btn-theme btn-sm float-right" href="{{route('following')}}?auth_id={{Auth::user()->id}}&user_id={{$b->users->id}}">
														<i class="fa fa-check"></i> <!-- Following -->
													</a>
													@else
													<a class="btn btn-outline-theme btn-sm float-right" href="{{route('following')}}?auth_id={{Auth::user()->id}}&user_id={{$b->users->id}}">
														<i class="fa fa-plus"></i> <!-- Follow -->
													</a>
													@endif
													@endif
													@else
													<a class="btn btn-outline-success btn-sm float-right" href="{{route('login')}}">
														<i class="fa fa-plus"></i> <!-- Follow -->
													</a>
												@endauth
											</div>
											<!--<div class="hr-rate">
												<span>₹500/hr</span>
											</div>-->
										</div>
										
									</div>
									@endforeach
								@else
									Advisor Not Found!
								@endif
							</div>
							<div class="widget widget-jobs">
								<div class="sd-title">
									<h3>Latest Requirements</h3>
									<!--<i class="la la-ellipsis-v"></i>-->
								</div>
								<div class="suggestions-list">
									@foreach($requirements as $r) 
									<div class="suggestion-usd">
										<div class="sgt-text">
											<a href="{{route('requirements_details',$r->slug)}}" target="_blank" class="text-dark">
												<h6 class="mt-2">{{Str::limit($r->title,25)}}</h6>
											</a><br>
											<!--<p class="mb-0">{{\Str::limit($r->about_listing,30)}}</p>-->
										</div>
										
									</div>
									@endforeach	
									<div class="view-more">
										<a href="{{route('requirements')}}" title="">View All</a>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div> 
	</div>
</main>

<!--<div class="chatbox-list">
	<div class="chatbox">
		<div class="chat-mg">
			<a href="#" title=""><img src="http://via.placeholder.com/70x70" alt=""></a>
			<span>2</span>
		</div>
		<div class="conversation-box">
			<div class="con-title mg-3">
				<div class="chat-user-info">
					<img src="http://via.placeholder.com/34x33" alt="">
					<h3>John Doe <span class="status-info"></span></h3>
				</div>
				<div class="st-icons">
					<a href="#" title=""><i class="la la-cog"></i></a>
					<a href="#" title="" class="close-chat"><i class="la la-minus-square"></i></a>
					<a href="#" title="" class="close-chat"><i class="la la-close"></i></a>
				</div>
			</div>
			<div class="chat-hist mCustomScrollbar" data-mcs-theme="dark">
				<div class="chat-msg">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
					<span>Sat, Aug 23, 1:10 PM</span>
				</div>
				<div class="date-nd">
					<span>Sunday, August 24</span>
				</div>
				<div class="chat-msg st2">
					<p>Cras ultricies ligula.</p>
					<span>5 minutes ago</span>
				</div>
				<div class="chat-msg">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
					<span>Sat, Aug 23, 1:10 PM</span>
				</div>
			</div>
			<div class="typing-msg">
				<form>
					<textarea placeholder="Type a message here"></textarea>
					<button type="submit"><i class="fa fa-send"></i></button>
				</form>
				<ul class="ft-options">
					<li><a href="#" title=""><i class="la la-smile-o"></i></a></li>
					<li><a href="#" title=""><i class="la la-camera"></i></a></li>
					<li><a href="#" title=""><i class="fa fa-paperclip"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="chatbox">
		<div class="chat-mg">
			<a href="#" title=""><img src="http://via.placeholder.com/70x70" alt=""></a>
		</div>
		<div class="conversation-box">
			<div class="con-title mg-3">
				<div class="chat-user-info">
					<img src="http://via.placeholder.com/34x33" alt="">
					<h3>John Doe <span class="status-info"></span></h3>
				</div>
				<div class="st-icons">
					<a href="#" title=""><i class="la la-cog"></i></a>
					<a href="#" title="" class="close-chat"><i class="la la-minus-square"></i></a>
					<a href="#" title="" class="close-chat"><i class="la la-close"></i></a>
				</div>
			</div>
			<div class="chat-hist mCustomScrollbar" data-mcs-theme="dark">
				<div class="chat-msg">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
					<span>Sat, Aug 23, 1:10 PM</span>
				</div>
				<div class="date-nd">
					<span>Sunday, August 24</span>
				</div>
				<div class="chat-msg st2">
					<p>Cras ultricies ligula.</p>
					<span>5 minutes ago</span>
				</div>
				<div class="chat-msg">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
					<span>Sat, Aug 23, 1:10 PM</span>
				</div>
			</div>
			<div class="typing-msg">
				<form>
					<textarea placeholder="Type a message here"></textarea>
					<button type="submit"><i class="fa fa-send"></i></button>
				</form>
				<ul class="ft-options">
					<li><a href="#" title=""><i class="la la-smile-o"></i></a></li>
					<li><a href="#" title=""><i class="la la-camera"></i></a></li>
					<li><a href="#" title=""><i class="fa fa-paperclip"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="chatbox">
		<div class="chat-mg bx">
			<a href="#" title=""><img src="http://via.placeholder.com/34x33" alt=""></a>
			<span>2</span>
		</div>
		<div class="conversation-box">
			<div class="con-title">
				<h3>Messages</h3>
				<a href="#" title="" class="close-chat"><i class="la la-minus-square"></i></a>
			</div>
			<div class="chat-list">
				<div class="conv-list active">
					<div class="usrr-pic">
						<img src="http://via.placeholder.com/50x50" alt="">
						<span class="active-status activee"></span>
					</div>
					<div class="usy-info">
						<h3>John Doe</h3>
						<span>Lorem ipsum dolor <img src="{{asset('front/images/smley.png')}}" alt=""></span>
					</div>
					<div class="ct-time">
						<span>1:55 PM</span>
					</div>
					<span class="msg-numbers">2</span>
				</div>
				<div class="conv-list">
					<div class="usrr-pic">
						<img src="http://via.placeholder.com/50x50" alt="">
					</div>
					<div class="usy-info">
						<h3>John Doe</h3>
						<span>Lorem ipsum dolor <img src="{{asset('front/images/smley.png')}}" alt=""></span>
					</div>
					<div class="ct-time">
						<span>11:39 PM</span>
					</div>
				</div>
				<div class="conv-list">
					<div class="usrr-pic">
						<img src="http://via.placeholder.com/50x50" alt="">
					</div>
					<div class="usy-info">
						<h3>John Doe</h3>
						<span>Lorem ipsum dolor <img src="{{asset('front/images/smley.png')}}" alt=""></span>
					</div>
					<div class="ct-time">
						<span>0.28 AM</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>-->

@endsection
@push('js')

     <style>
        .morecontent span {
            display: none;
        }
        .morelink {
            display: block;
        }
        .availability-status{
            width: 50px;
            height: 50px;
            border-radius: 100%;
            border: 2px solid #ffffff;
            background: #1bcfb4;
        }
    </style>
    

    <script>
    
        /*----open comment box-------*/
    
        function openComment(id){
            console.log(id);
            $('#comment-box-'+id).slideToggle();
        }
        
          /*----show socialite on share click-------*/
        
        function share(id){
            $(".social-media-icons-"+id).fadeToggle();
        }
    
        

    
        $(document).ready(function(){
            
            /*----select2-------*/
            
            /*$(".multiple").select2({
                placeholder: "Select",
                allowClear: true,
                tags: true
            });*/
            
            $("#postSubmit").on('submit', function (event) {  
                   event.preventDefault();
                   var el = $(this);
                   el.prop('disabled', true);
                   setTimeout(function(){el.prop('disabled', false); }, 3000);
             });
            
            $('body').on('change','#category_r',function(){
                
                var category = $(this).text();
                console.log(category);
            })
            
             $('body').on('change','#skill_r',function(){
                var skill = $(this).attr('data-val');
                console.log(skill);
            })
            
            $('body').on('change','#tag_r',function(){
                var tag = $(this).attr('data-val');
                console.log(tag);
            })
            
            
             /*----success/error toastr-------*/
           /* toastr.options.timeOut = 3000;
            @if (Session::has('error'))
                toastr.error("{{ Session::get('error') }}");
            @elseif(Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
            @endif*/
            
            
            /*----show more/show less-------*/
            var showChar = 200;  
            var ellipsestext = "...";
            var moretext = "Read more";
            var lesstext = "Read less";
            
        
            $('.more').each(function() {
                var content = $(this).html();
         
                if(content.length > showChar) {
         
                    var c = content.substr(0, showChar);
                    var h = content.substr(showChar, content.length - showChar);
         
                    var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
         
                    $(this).html(html);
                }
         
            });
         
            $(".morelink").click(function(){
                if($(this).hasClass("less")) {
                    $(this).removeClass("less");
                    $(this).html(moretext);
                } else {
                    $(this).addClass("less");
                    $(this).html(lesstext);
                }
                $(this).parent().prev().toggle();
                $(this).prev().toggle();
                return false;
            });
            
        });
        
        setInterval(ajaxCall, 3000);
        
        function ajaxCall(){
            $.getJSON("{{route('check.status')}}", (data) => {
                
                console.log(data);
                
                // $(".user_active_status").addClass("text-danger");
                
                data.data.forEach((x)=>{
                    
                    // $(".user_status_"+x).removeClass("text-danger");
                    $(".user_status_"+x).addClass("text-danger");
                    
                })
            });
        }
        
        
    </script>

	<script>
        var page = 1;
    	$(window).scroll(function() {
    	    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
    	        page++;
    	        loadMoreData(page);
    	    }
    	});
    
    	function loadMoreData(page){
    	  $.ajax(
    	        {
    	            url: '?page=' + page,
    	            type: "get",
    	            beforeSend: function()
    	            {
    	                $('.ajax-load').show();
    	            }
    	        })
    	        .done(function(data)
    	        {	
					console.log(data.html);
    	            if(data.html == " "){
    	                $('.ajax-load').html("No more records found.");
    	                return;
    	            }
    	            $('.ajax-load').hide();
    	            $("#post-data").append(data.html);
    	        })
    	        .fail(function(jqXHR, ajaxOptions, thrownError)
    	        {
    	              toastr.error('server not responding...');
    	        });
    	}
    </script>
@endpush
