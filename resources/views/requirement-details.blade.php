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
													        <a href="{{route('user_profile',$requirement->users->id ?? '')}}" target="_blank" class="text-dark"><h3>{{$requirement->users->name ?? ''}}</h3></a>
														<span><i class="fa fa-clock-o theme-color"></i> {{$requirement->created_at->diffForHumans()}}</span>
													</div>
													@auth
													<a href="{{route('save')}}?user_id={{Auth::user()->id}}&blog_type=requirement&blog_id={{$requirement->id}}" style="font-size:30px;margin-left:18rem;">
												     {!! App\Models\Save::where('user_id',Auth::user()->id)->where('blog_type','requirement')->where('blog_id',$requirement->id)->where('status',1)->exists() == true ? '<i class="fa fa-bookmark" style="color:#008069;" ></i>' : '<i class="la la-bookmark" style="color:#000;" ></i>' !!}
												    </a>
												
												    @else
												    <a href="{{route('login')}}" title="" style="font-size:30px;margin-left:18rem;">
												     <i class="la la-bookmark" ></i> 
												    </a>
												    @endauth
												</div>
										
											</div>
											{{--<div class="epi-sec">
												<ul class="descp">
													<li><span><i class="fa fa-globe theme-color"></i> {{$requirement->users->designation}}</span></li>
													<li><span><i class="fa fa-map-marker theme-color"></i> {{$requirement->users->address}}</span></li>
												</ul>
												<ul class="bk-links">
												
													<li>
													    @auth
													    <a href="{{route('save')}}?user_id={{Auth::user()->id}}&blog_type=requirement&blog_id={{$requirement->id}}" >
													     <i class="la la-bookmark"  {!! App\Models\Save::where('user_id',Auth::user()->id)->where('blog_type','requirement')->where('blog_id',$requirement->id)->where('status',1)->exists() == true ? 'style="background:#53d690;color:#fff"' : 'style="background:#fff;color:#000"' !!}></i> 
													    </a>
													    @else
													    <a href="{{route('login')}}" title="">
													     <i class="la la-bookmark" ></i> 
													    </a>
													    @endauth
													 </li>
													<li><a href="#" title=""><i class="la la-envelope"></i></a></li>
												</ul>
											</div>--}}
											<div class="job_descp">
												@auth
												 @if(!$interest)
													@if(\Session::get('type') == 'Advisor' && $requirement->created_by != Auth::user()->id)  
													<button type="button" class="btn btn-success btn-sm" onclick="interestedOrNot({{$requirement->id}},'{{route('requirements_details',$requirement->slug)}}','{{App\Models\Notification::activity_requirement}}',1)">Interest <i class="fa fa-thumbs-up"></i></button>
												    
												    <button class="btn btn-danger btn-sm" onclick="interestedOrNot({{$requirement->id}},'{{route('requirements_details',$requirement->slug)}}','{{App\Models\Notification::activity_requirement}}',2)">Not Interest <i class="fa fa-thumbs-down"></i></button>
													@endif
												 @endif
												@endauth
												
												<?php
												// 	$cats = getPostCategories($requirement->category);
												// 	$skills = getPostSkills($requirement->skill);
												// 	$tags = getPostTags($requirement->tag);
													$skills = getPostFields($requirement->skill);
												?>
												
                                                @if($requirement->category)
												@foreach($skills as $id => $name)
											    	<span class="badge badge-info float-right mr-1">{{$name}}</span>
												@endforeach
												@endif
												<br><br>
												<h3>{{$requirement->title}}</h3>
												<p class="more">{{$requirement->description}}</p> 
												<ul class="job-dt">
													<li><a href="#" class="theme-bg">Min.Budget : {{$data->min_budget ?? 0}}</a></li>
													<li><a href="#" class="theme-bg">Max.Budget : {{$data->max_budget ?? 0}}</a></li>
												
												</ul>
												<!--<p>{{Str::limit($requirement->description,200)}} <a href="#" title="">view more</a></p>
												@if($requirement->skill)
												<ul class="skills">
												    @foreach($skills as $id => $name)
													<li><a href="javascript:void(0);" title="">{{$name}}</a></li>
													@endforeach
												</ul>
												@endif
												{{--
												@if($requirement->tag)
												<ul class="skill-tags">
												    @foreach($tags as $id => $name)
													<li><a href="javascript:void(0);" title="">{{$name}}</a></li>
													@endforeach
												</ul>
												@endif  --}}
												-->
											</div>
											<div class="job-status-bar">
												<div class="row">
													<div class="col-md-8">
														<ul class="like-com">
															@auth
															<li>
																<a href="{{route('like')}}?user_id={{Auth::user()->id}}&blog_type=requirement&blog_id={{$requirement->id}}" {!! App\Models\Like::where('user_id',Auth::user()->id)->where('blog_type','requirement')->where('blog_id',$requirement->id)->where('status',1)->exists() == true ? 'style="color:#008069"' : '' !!}>
																<i class="la la-heart" ></i> Like {{App\Models\Like::where('blog_type','requirement')->where('blog_id',$requirement->id)->where('status',1)->count()}} 
																</a>
															</li>
															<li>
																<a href="javascript:void(0)" class="comment p-0">
																<i class="la la-comment"></i> Comment {{ count($requirement->comments) }}</a>
															</li>
															<li>
																<a href="javascript:void(0)" class="share">
																<i class="la la-share"></i> Share </a>
															</li>
															
															<li class="social arrow-left social-edia-icons" style="display: none;">
																<a target="_blank" href="https://api.whatsapp.com/send?text={{route('requirements_details',$requirement->slug)}}" data-action="share/whatsapp/share">
																	<i class="la la-whatsapp"></i>
																</a> 
																<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{route('requirements_details',$requirement->slug)}}">
																	<i class="la la-facebook"></i>
																</a> 
																<a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url={{route('requirements_details',$requirement->slug)}}">
																	<i class="la la-linkedin"></i>
																</a>
																<a target="_blank" href="https://telegram.me/share/url?url={{route('requirements_details',$requirement->slug)}}">
																	<i class="la la-telegram"></i>
																</a> 
																<a target="_blank" href="https://twitter.com/intent/tweet?text={{route('requirements_details',$requirement->slug)}}">
																	<i class="la la-twitter"></i>
																</a> 
															</li>
															
															@else
															<li>
																<a href="{{route('login')}}">
																<i class="la la-heart-o"></i> Like {{App\Models\Like::where('blog_type','requirement')->where('blog_id',$requirement->id)->where('status',1)->count()}}</a>
															</li>
															<li>
																<a href="javascript:void(0)" class="comment p-0">
																<i class="la la-comment"></i> Comment {{ count($requirement->comments) }}</a>
															</li>
															@endauth
														</ul>
													</div>

													<div class="col-md-4">
													@if($interest)
														<button class="btn btn-sm float-right btn-outline-<?=($interest->status == 1)?'success':'danger'?>">@if($interest->status == 1) Interested @else Not Interested @endif</button>
													@endif
													</div>
												</div>
											</div>
											<div class="bg-light p-2 comment-box" style="display:none;">
											    <form action="{{route('comment')}}" method="post">
											        @csrf
											        <input type="hidden" name="user_id" value="@auth {{Auth::user()->id}} @endif">
											        <input type="hidden" name="blog_type" value="requirement">
											        <input type="hidden" name="blog_id" value="{{$requirement->id}}">
                                                    <div class="">
                                                        <textarea class="form-control ml-1 shadow-none textarea" placeholder="write a comment..." name="comment"></textarea>
                                                    </div>
                                                    <div class="mt-2 text-right">
                                                        <button class="btn btn-sm shadow-none" type="submit" style="background:#008069;color:#fff">
                                                            Post comment
                                                        </button>
                                                    </div>
                                                </form>
                                                 
                                                @foreach($requirement->comments as $cm)
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
							<div class="col-lg-3 pd-right-none no-pd" style="display:<?=(Auth::check() && $requirement->created_by == Auth::user()->id)?'block':'none'?>">
								<div class="right-sidebar">
								<div class="widget widget-jobs">
										<div class="sd-title">
											<h3>Interested Advisors</h3>
											<i class="la la-ellipsis-v"></i>
										</div>
										<div class="jobs-list">
											@if($all_interested->isNotEmpty())
											
											@foreach($all_interested as $i)
											<div class="job-info">
												<div class="job-details">
													<a href="{{route('user_profile',$i->users->id ?? '')}}" target="_blank" class="text-dark"><h3>{{$i->users->name ?? ''}}</h3></a>
													<p>{{$i->users->designation}}</p>
												</div>
												<div class="">
													@if(App\Models\AdvisoryRequest::where('advisor_id',$i->users->id ?? '')->where('user_id',Auth::user()->id)->where('listing_id',$i->requirement_id)->where('status',4)->first())
													<a href="tel:{{$i->users->contact ?? ''}}"type="button" class="btn btn-sm theme-color"><i class="las la-phone"></i> {{$i->users->contact ?? ''}}</a>
													<a href="https://wa.me/{{$i->users->contact ?? ''}}" type="button" class="btn btn-sm theme-color"><i class="la la-whatsapp"></i></a>
													@elseif(App\Models\AdvisoryRequest::where('advisor_id',$i->users->id ?? '')->where('user_id',Auth::user()->id)->where('listing_id',$i->requirement_id)->first())
													<a href="{{route('profile')}}" onclick="localStorage.setItem('activeTab','letsconnect-dd');" type="button" class="btn btn-sm theme-bg text-light">Payment</a>
													@else
													<button type="button" class="btn btn-sm theme-bg text-light" onclick="talkToAdvisor('{{$i->users->id ?? ''}}',{{Auth::user()->id}},'requirement','{{$requirement->id}}');" data-toggle="modal" data-target="#talkToadvisorModal"><i class="las la-phone"></i> Talk To Advisor</button>
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

		<!--Talk to advisor without requirement modal-->
		<!--<div class="modal fade" id="talkToadvisorWRModal" tabindex="-1" role="dialog" aria-labelledby="talkToAdvisorModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="talkToAdvisorModalLabel">Talk to Advisor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               
                <form id="request-form" method="post" action="{{route('paytm.payment')}}">
                    @csrf
                    <input type="hidden" value="" id="user_id" name="user_id">
                    <input type="hidden" value="" id="advisor_id" name="advisor_id">
                    <input type="hidden" value="{{$requirement->id}}" id="listing_id" name="listing_id">
                    <input type="hidden" value="{{$requirement->title}}" id="listing_name" name="listing_name">
                    <input type="hidden" value="requirement" id="lead_type" name="lead_type">
                    <input type="hidden" value="{{url()->current()}}" id="lead_url" name="lead_url">
                    <input type="hidden" value="requirement" id="requirement" name="lead_source">
                    <input type="hidden" value="{{$requirement->title}}" id="requirement" name="requirement">
                   
                  <div class="form-group">
                    <label for="total-fees" class="col-form-label">Advisory Fees:</label>
                    <input type="text"  value="{{$requirement->advisory_fees ?? 0}}" class="form-control" id="total_fees" name="fees" required>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-form-label">Lead Expire Date:</label>
                    <input type="date" class="form-control" id="lead_expire_date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" name="lead_expire_date" required>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-form-label">Lead Expire Time:</label>
                    <input type="time" class="form-control" id="lead_expire_time" min=""  name="lead_expire_time" required>
                  </div>
                
              </div>
              <div class="modal-footer">
                
                <button type="submit" class="btn btn-sm" style="background-color:#008069;color:#fff;">Payment</button>
              </div>
              </form>
            </div>
          </div>
        </div>-->
		<!--Talk to advisor without requirement modal-->
		
	
	
	<!-- Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <button type="button" class="btn btn-primary theme-bg theme-border" onclick="interestedOrNot({{$requirement->id}},'{{route('requirements_details',$requirement->slug)}}','{{App\Models\Notification::activity_requirement}}',1)">Submit</button>
          </div>
        </div>
      </div>
    </div>

@endsection
@push('js')

    
    

    <script>

		/*--------------Talk to advisor Without Requirement----------------*/
	/*	function talkToAdvisorWR(user_id,advisor_id,listing_id,listing_name){
			$("#user_id").val(user_id);
			$("#advisor_id").val(advisor_id);
			$("#listing_id").val(listing_id);
			$("#listing_name").val(listing_name);
		}*/

        $(document).ready(function(){
            
            /*----select2-------*/
            
            /*$(".multiple").select2({
                placeholder: "Select",
                allowClear: true,
                tags: true
            });*/
            
            
            
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
