@extends('layout.app')

@section('content')
	
		<main>
			<div class="main-section">
				<div class="container">
					<div class="main-section-data">
						<div class="row">
						    
						    <div class="col-lg-3 col-md-4 pd-left-none no-pd">
							
							</div>
							<div class="col-lg-6 col-md-8 no-pd">
								<div class="main-ws-sec">
									<div class="posts-section">
									  
										<div class="post-bar">
											<div class="post_topbar">
												<div class="usy-dt">
													<img src="http://via.placeholder.com/50x50" alt="">
													<div class="usy-name">
														<a href="{{route('user_profile',$post->users->id ?? '')}}" target="_blank" class="text-dark"><h3>{{$post->users->name ?? ''}}</h3></a>
														<span><i class="fa fa-clock-o theme-color"></i> {{$post->created_at->diffForHumans()}}</span>
													</div>
													@auth
												    <a href="{{route('save')}}?user_id={{Auth::user()->id}}&blog_type=post&blog_id={{$post->id}}" style="font-size:30px;margin-left:18rem;">
												     {!! App\Models\Save::where('user_id',Auth::user()->id)->where('blog_type','post')->where('blog_id',$post->id)->where('status',1)->exists() == true ? '<i class="fa fa-bookmark" style="color:#008069;" ></i>' : '<i class="la la-bookmark" style="color:#000;" ></i>' !!}
												    </a>
												    @else
												    <a href="{{route('login')}}" title="" style="font-size:30px;margin-left:18rem;">
												     <i class="la la-bookmark" ></i> 
												    </a>
												    @endauth
												</div>
											
											</div>
											
											<div class="job_descp">
												
												@auth
												  @if(!$interest)
												 	@if(\Session::get('type') == 'Advisor' && $post->created_by != Auth::user()->id)  

													<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">Interested ?</button>
													<button class="btn btn-danger btn-sm" onclick="interestedOrNot({{$post->id}},'{{route('post_details',$post->slug)}}','{{App\Models\Notification::activity_post}}',2)">Not Interested ?</button>
													@endif
												  @endif
												@endauth

												<?php
												// 	$cats = getPostCategories($post->category);
												// 	$skills = getPostSkills($post->skill);
												// 	$tags = getPostTags($post->tag);
													$skills = getPostFields($post->skill);
												?>
												
												@if($post->image)
										            <img src='{{asset("front/images/posts/$post->image")}}' alt="" width="120" height="120" style="border-radius: 3px;box-shadow: 0 0 8px rgb(0 0 0 / 63%);margin-right:15px;margin-bottom:10px;">
										        @else
										            <img src='{{asset("front/images/empty.png")}}' alt="" width="120" height="120" style="border-radius: 3px;box-shadow: 0 0 8px rgb(0 0 0 / 63%);margin-right:15px;margin-bottom:10px;">
												@endif

												@foreach($skills as $id => $name)
											    	<span class="badge badge-info float-right mr-1">{{$name}}</span>
												@endforeach
												<h3>{{$post->title}}</h3>
												<!--<ul class="job-dt">
													<li><a href="#" title="">Full Time</a></li>
													<li><span>$30 / hr</span></li>
												</ul>-->
												<p class="more">{{$post->description}}</p> 
												<!--<p>{{Str::limit($post->description,200)}} <a href="#" title="">view more</a></p>-->
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
													    <a href="{{route('like')}}?user_id={{Auth::user()->id}}&blog_type=post&blog_id={{$post->id}}" {!! App\Models\Like::where('user_id',Auth::user()->id)->where('blog_type','post')->where('blog_id',$post->id)->where('status',1)->exists() == true ? 'style="color:#008069"' : '' !!}>
    													   <i class="la la-heart" ></i> Like {{App\Models\Like::where('blog_type','post')->where('blog_id',$post->id)->where('status',1)->count()}} 
    													 </a>
													 </li>
													 <li>
													    <a href="javascript:void(0)" onclick="openComment({{$post->id}})" class="comment p-0">
													     <i class="la la-comment"></i> Comment {{ count($post->comments) }}</a>
													 </li>
													 <li>
													    <a href="javascript:void(0)" class="share">
													     <i class="la la-share"></i> Share </a>
													 </li>
													 
													 <li class="social arrow-left social-edia-icons" style="display: none;">
                                                        <a target="_blank" href="https://api.whatsapp.com/send?text=https://www.hrlabindia.com/blog_details/94" data-action="share/whatsapp/share">
                                                            <i class="la la-whatsapp"></i>
                                                        </a> 
                                                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://www.hrlabindia.com/blog_details/94">
                                                            <i class="la la-facebook"></i>
                                                        </a> 
                                                        <a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url=https://www.hrlabindia.com/blog_details/94">
                                                            <i class="la la-linkedin"></i>
                                                        </a>
                                                        <a target="_blank" href="https://telegram.me/share/url?url=https%3A%2F%2Fwww.hrlabindia.com%2Fblog_details%2F94">
                                                            <i class="la la-telegram"></i>
                                                        </a> 
                                                        <a target="_blank" href="https://twitter.com/intent/tweet?text=https%3A%2F%2Fwww.hrlabindia.com%2Fblog_details%2F94">
                                                            <i class="la la-twitter"></i>
                                                        </a> 
                                                     </li>
													 
													 @else
													 <li>
													    <a href="{{route('login')}}">
													     <i class="la la-heart-o"></i> Like {{App\Models\Like::where('blog_type','post')->where('blog_id',$post->id)->where('status',1)->count()}}</a>
													 </li>
													 <li>
													    <a href="javascript:void(0)" class="comment p-0">
													     <i class="la la-comment"></i> Comment {{ count($post->comments) }}</a>
													 </li>
													 @endauth
												</ul>
												@if($interest)
												<button class="btn btn-sm float-right btn-outline-<?=($interest->status == 1)?'success':'danger'?>">@if($interest->status == 1) Interested @else Not Interested @endif</button>
												@endif
											</div>
											
											<div class="bg-light p-2 comment-box" style="display:none;">
											    <form action="{{route('comment')}}" method="post">
											        @csrf
											        <input type="hidden" name="user_id" value="@auth {{Auth::user()->id}} @endif">
											        <input type="hidden" name="blog_type" value="post">
											        <input type="hidden" name="blog_id" value="{{$post->id}}">
                                                    <div class="">
                                                        <textarea class="form-control ml-1 shadow-none textarea" placeholder="write a comment..." name="comment"></textarea>
                                                    </div>
                                                    <div class="mt-2 text-right">
                                                        <button class="btn btn-sm shadow-none" type="submit" style="background:#008069;color:#fff">
                                                            Post comment
                                                        </button>
                                                    </div>
                                                </form>
                                                 
                                                @foreach($post->comments as $cm)
                                                <div class="commented-section m-2">
                                                    <div class="d-flex flex-row align-items-center commented-user">
                                                       <h5 class="mr-2"> {{$cm->user_name}}</h5>
                                                        <span class="dot mb-1"></span>
                                                        <span class="mb-1 ml-2">{{$cm->created_at->diffForHumans()}}</span>
                                                    </div>
                                                    <div class="comment-text-sm offset-1">
                                                        <p>{{$cm->comment}}</p>
                                                    </div>
                                                </div>
                                                @endforeach 
                                            </div>
										</div>
									</div>
								</div>
							</div>
							@auth
							<div class="col-lg-3 pd-right-none no-pd" style="display:<?=(Auth::check() && $post->created_by == Auth::user()->id)?'block':'none'?>">
								<div class="right-sidebar">
								<div class="widget widget-jobs">
										<div class="sd-title">
											<h3>Interested Advisors</h3>
											<!-- <i class="la la-ellipsis-v"></i> -->
										</div>
										<div class="jobs-list">
											@if($all_interested->isNotEmpty())
											
											@foreach($all_interested as $i)
											<div class="job-info">
												<div class="job-details">
													<a href="{{route('user_profile',$i->users->id ?? '')}}" target="_blank" class="text-dark"><h3>{{$i->users->name ?? ''}}</h3></a>
													<p>{{$i->users->designation ?? ''}}</p>
												</div>
												<div class="">
												 	@if(App\Models\AdvisoryRequest::where('user_id',$i->users->id ?? '')->where('advisor_id',Auth::user()->id)->where('listing_id',$i->post_id)->where('status',4)->first())
													<a href="tel:{{$i->users->contact ?? ''}}" type="button" class="btn btn-sm theme-color"><i class="las la-phone"></i> {{$i->users->contact ?? ''}}</a>
													<a href="https://wa.me/{{$i->users->contact ?? ''}}" type="button" class="btn btn-sm theme-color"><i class="la la-whatsapp"></i></a>
													@else
													<button type="button" class="btn btn-sm theme-bg text-light" onclick="talkToAdvisorWP({{Auth::user()->id}},{{$i->users->id ?? ''}},'{{$post->id}}','{{$post->title}}');" data-toggle="modal" data-target="#talkToadvisorWPModal"><i class="las la-user"></i> Talk To Advisor</button>
													@endif
												</div>
											</div>
											
											@endforeach
											@else
												No Advisor Interested.
											@endif
										</div>
									</div>
									
								</div>
							</div>
							@endauth
						</div>
					</div><!-- main-section-data end-->
				</div> 
			</div>
		</main>

		<!--Talk to advisor without post modal-->
		<div class="modal fade" id="talkToadvisorWPModal" tabindex="-1" role="dialog" aria-labelledby="talkToAdvisorModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="talkToAdvisorModalLabel">Talk to Advisor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="request-form" method="post" action="{{route('send_advisory_request')}}">
                    @csrf
                    <input type="hidden" value="" id="user_id" name="user_id">
                    <input type="hidden" value="" id="advisor_id" name="advisor_id">
                    <!--<input type="hidden" value="" id="listing_id" name="listing_id">
                    <input type="hidden" value="" id="listing_name" name="listing_name">
                    <input type="hidden" value="{{$post->id}}" id="advisory_id" name="advisory_id">
                    <input type="hidden" value="{{url()->current()}}" id="advisory_url" name="advisory_url">
                    <input type="hidden" value="post" id="advisory_type" name="advisory_type">-->
                    <input type="hidden" value="{{$post->id}}" id="listing_id" name="listing_id">
                    <input type="hidden" value="{{$post->title}}" id="listing_name" name="listing_name">
                    <input type="hidden" value="post" id="lead_type" name="lead_type">
                    <input type="hidden" value="{{url()->current()}}" id="lead_url" name="lead_url">
                    <input type="hidden" value="post" id="post" name="lead_source">
                    <input type="hidden" value="{{$post->title}}" id="post" name="requirement">

                  <div class="form-group">
                    <label for="total-fees" class="col-form-label">Total fees:</label>
                    <input type="text"  value="{{$post->advisory_fees ?? 0}}" class="form-control" id="total_fees" name="fees">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Lead Expire:</label>
                    <input type="datetime-local" class="form-control" id="lead_expire_date" min=""  name="lead_expire_date" >
                  </div>
                
              </div>
              <div class="modal-footer">
                <!--<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>-->
                <button type="submit" class="btn btn-sm" style="background-color:#008069;color:#fff;">Payment</button>
              </div>
              </form>
            </div>
          </div>
        </div>
		<!--Talk to advisor without post modal-->
		
		
	<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Advisory Charge Fees</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="form-group">
                    <!--<label for="total-fees" class="col-form-label">fees:</label>-->
                    <input type="number"  value="0"  class="form-control advisory_fees" placeholder="Fees" name="advisory_fees">
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary theme-bg theme-border" onclick="interestedOrNot({{$post->id}},'{{route('post_details',$post->slug)}}','{{App\Models\Notification::activity_post}}',1)">Submit</button>
          </div>
        </div>
      </div>
    </div>

@endsection
@push('js')

    
    

    <script>
		/*--------------Talk to advisor Without Post----------------*/
		function talkToAdvisorWP(user_id,advisor_id,listing_id,listing_name){
			$("#user_id").val(user_id);
			$("#advisor_id").val(advisor_id);
			$("#listing_id").val(listing_id);
			$("#listing_name").val(listing_name);
		}
        $(document).ready(function(){
            
            /*----select2-------*/
            
            $(".multiple").select2({
                placeholder: "Select",
                allowClear: true,
                tags: true
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
            
            
             /*----open comment box-------*/
            
            $('.comment').click(function(){
                $('.comment-box').slideToggle();
            })
            
            
            
             /*----show socialite on share click-------*/
            
            $(".share").on('click',function(){
                $(".social-media-icons").fadeToggle();
            });
        
        
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
    </script>
@endpush
