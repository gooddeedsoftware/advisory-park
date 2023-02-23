@extends('layout.app')
@section('content')
	
		<section class="forum-page">
			<div class="container">
				<div class="forum-questions-sec">
					<div class="row">
					    <div class="col-md-1"></div>
						<div class="col-lg-10">
							<div class="forum-post-view">
								<div class="usr-question">
									
									<div class="usy-dt mb-2">
										<div class="usy-name">
										    <img src="http://via.placeholder.com/50x50" alt="">
											
											    {{--<a href="{{route('user_profile',$data->users->id ?? '')}}" class="text-dark">{{$data->users->advisory_park_id}}</a>@auth <i class="user_status_{{$data->users->id}} user_active_status fa fa-circle {{($data->users->is_active == '1') ? 'text-success' : 'text-danger' }} " aria-hidden="true"></i>@endauth--}}
											    {{--<span><i class="fa fa-clock-o theme-color"></i> {{$data->created_at->diffForHumans()}}</span>--}}
											    <a href="{{route('user_profile',$data->users->id ?? '')}}" target="_blank" class="text-dark">
												    <h3 class="mb-0">
												     {{$data->users->name ?? ''}} 
												     <span class="text-success">{{$data->users->advisory_park_id ?? ''}}</span>
												     @if($data->users !== null)
												        @auth <i class="user_status_{{$data->users->id}} user_active_status fa fa-circle {{($data->users->is_active == '1') ? 'text-success' : 'text-danger' }} " aria-hidden="true" style="margin-right:15rem;"></i>@endauth
											         @endif
											         <span class="badge theme-bg text-light float-right" style="margin-left:30rem!important">{{$data->field->name ?? ''}}</span>    
												    </h3> 
												</a>
												@if($data->users !== null)
												@php
												    $followers = App\Models\Follower::where('auth_id',$data->users->id)->where('status',1)->count();
												    
												@endphp
												@else
												    $following = 0;
												@endif
												<span> {{$followers}} Followers</span><br>
												<span> Joined Since {{$data->users->created_at->diffForHumans()}}</span>
											
										</div>
									</div>
									<div class="usr_quest">
										<div>
											@if($data->image)
    										       
                                                <a data-fancybox data-type="image" href='{{asset("front/images/advisory_listing/$data->image")}}'>
                                                    <img src='{{asset("front/images/advisory_listing/$data->image")}}' alt="" width="120" height="120" style="border-radius: 3px;box-shadow: 0 0 8px rgb(0 0 0 / 63%);margin-bottom: 26px;margin-right: 75px;" />
                                                </a>
    										@else
    										     <a data-fancybox data-type="image" href='{{asset("front/images/empty.png")}}'>
                                                    <img src='{{asset("front/images/empty.png")}}' alt="" width="120" height="120" style="border-radius: 3px;box-shadow: 0 0 8px rgb(0 0 0 / 63%);margin-bottom: 26px;margin-right: 75px;" />
                                                </a>
    										@endif
    									
    									    <h1><strong>{{$data->listing_name}}</strong></h1>
										
										    <h6 ><strong>Problem Details :</strong></h6>
    										<p> 
    											{{$data->about_listing}}    
    										</p>
										
										    <h6><strong>Advisor Experience :</strong></h6>
    										<p >
    											{{$data->experience}}    
    										</p>
										</div>
									    <div>
									            
												<ul class="skills">
													
													<li><strong>Advisory Charges : </strong><h3 class="theme-color"><strong>₹ {{$data->fees}}</strong></h3></li>
												
												</ul>
												<ul class="skills">
													
													<li><strong>Approx. Time to Complete Advisory : </strong><span class="theme-color">{{$data->duration_in_hours}} {{$data->duration_in_hours ? "Hours" : ""}} {{$data->duration_in_minutes}} {{$data->duration_in_minutes ? "Minutes" : ""}}</span></li>
												
												</ul>
												<ul class="skills">
													
													<li><strong>Experience : </strong><span class="theme-color">{{$data->exp_in_years}} {{$data->duration_in_hours ? "Years" : ""}} {{$data->exp_in_months}} {{$data->exp_in_months ? "Minutes" : ""}}</span></li>
												
												</ul>
											
												<ul class="skill-tags">
													
													<li>
														<strong>Available On : </strong><br>
														@php    $mode = json_decode($data->mode) @endphp
														@foreach($mode as $m)
															
															@if($m == "Voice call")<img data-toggle="tooltip" title="Voice call" src='{{asset("front/images/voice-call.png")}}'height="34px" style="margin-top: 1px;" alt="" >  @endif
															@if($m == "Whatsapp")<img data-toggle="tooltip" title="WhatsApp" src='{{asset("front/images/whatsapp.png")}}'height="35px" style="" alt="" >  @endif
															@if($m == "Video call")<img data-toggle="tooltip" title="Video call" src='{{asset("front/images/video-call.png")}}' height="34px" style="margin-right: 3px;" alt="">@endif
															@if($m == "Any Desk")<img data-toggle="tooltip" title="Any Desk" src='{{asset("front/images/any-desk.png")}}' height="30px" style="margin-top: 1px;margin-right: 3px;" alt="">@endif
															@if($m == "Team Viewer")<img data-toggle="tooltip" title="Team Viewer" src='{{asset("front/images/team-viewer.png")}}' height="31px" style="margin-top: 1px;" alt="">@endif
														
														@endforeach
													</li>
												
												</ul>
											</div>
										<div class="job-status-bar">
										    <ul class="like-com float-right">
    											@auth
    											<li>
    												@if(\Session::get('type') == 'User')
    													<a href="javascript:void(0);" class="active btn theme-bg text-light" onclick="talkToAdvisor({{$data->fees}},{{$data->added_by}}, {{Auth::user()->id}}, '{{$data->listing_name}}','{{$data->type}}','{{$data->category}}');" data-toggle="modal" data-target="#talkToadvisorModal">
    													<i class="las la-phone"></i> Talk to advisor</a>
    												@endif
    											</li>
    											
    											 
    											 @else
    											 <li>
    											    <a class="active btn theme-bg text-light" href="{{route('login')}}" >
    											     <i class="las la-phone"></i> Talk to advisor
    											    </a>
    											 </li>
    											
    											 @endauth
											</ul>
											    <!--<a><i class="la la-eye"></i>Views</a>-->
										    </div>
										<!--<div class="comment-section">
											<h3>03 Comments</h3>
											<div class="comment-sec">
												<ul>
													<li>
														<div class="comment-list">
															<div class="bg-img">
																<img src="http://via.placeholder.com/40x40" alt="">
															</div>
															<div class="comment">
																<h3>John Smith</h3>
																<span><img src="images/clock.png" alt=""> 3 min ago</span>
																<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse at libero elit. Mauris ultrices sed lorem nec efficitur.</p>
															</div>
														</div>
													</li>
													<li>
														<div class="comment-list">
															<div class="bg-img">
																<img src="http://via.placeholder.com/40x40" alt="">
															</div>
															<div class="comment">
																<h3>John Doe</h3>
																<span><img src="images/clock.png" alt=""> 3 min ago</span>
																<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at.</p>
															</div>
														</div>
													</li>
													<li>
														<div class="comment-list">
															<div class="bg-img">
																<img src="http://via.placeholder.com/40x40" alt="">
															</div>
															<div class="comment">
																<h3>John Doe</h3>
																<span><img src="images/clock.png" alt=""> 3 min ago</span>
																<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at.</p>
															</div>
														</div>
													</li>
												</ul>
											</div>
										</div>-->
									</div>
								</div>
							</div>
							<!--<div class="post-comment-box">
								<h3>03 Comments</h3>
								<div class="user-poster">
									<div class="usr-post-img">
										<img src="http://via.placeholder.com/40x40" alt="">
									</div>
									<div class="post_comment_sec">
										<form>
											<textarea placeholder="Your Answer"></textarea>
											<button type="submit">Post Answer</button>
										</form>
									</div>
								</div>
							</div>
							<div class="next-prev">
								<a href="#" title="" class="fl-left">Preview</a>
								<a href="#" title="" class="fl-right">Next</a>
							</div>
						</div>
						<div class="col-md-1"></div>-->
						<!--<div class="col-lg-4">
							<div class="widget widget-feat">
								<ul>
									<li>
										<i class="fa fa-heart"></i>
										<span>1185</span>
									</li>
									<li>
										<i class="fa fa-comment"></i>
										<span>1165</span>
									</li>
									<li>
										<i class="fa fa-share-alt"></i>
										<span>1120</span>
									</li>
									<li>
										<i class="fa fa-eye"></i>
										<span>1009</span>
									</li>
								</ul>
							</div>
							<div class="widget widget-user">
								<h3 class="title-wd">Top User of the Week</h3>
								<ul>
									<li>
										<div class="usr-msg-details">
											<div class="usr-ms-img">
												<img src="http://via.placeholder.com/50x50" alt="">
											</div>
											<div class="usr-mg-info">
												<h3>Jessica William</h3>
												<p>Graphic Designer </p>
											</div>
										</div>
										<span><img src="images/price1.png" alt="">1185</span>
									</li>
									<li>
										<div class="usr-msg-details">
											<div class="usr-ms-img">
												<img src="http://via.placeholder.com/50x50" alt="">
											</div>
											<div class="usr-mg-info">
												<h3>John Doe</h3>
												<p>PHP Developer</p>
											</div>
										</div>
										<span><img src="images/price2.png" alt="">1165</span>
									</li>
									<li>
										<div class="usr-msg-details">
											<div class="usr-ms-img">
												<img src="http://via.placeholder.com/50x50" alt="">
											</div>
											<div class="usr-mg-info">
												<h3>Poonam</h3>
												<p>Wordpress Developer </p>
											</div>
										</div>
										<span><img src="images/price3.png" alt="">1120</span>
									</li>
									<li>
										<div class="usr-msg-details">
											<div class="usr-ms-img">
												<img src="http://via.placeholder.com/50x50" alt="">
											</div>
											<div class="usr-mg-info">
												<h3>Bill Gates</h3>
												<p>C & C++ Developer </p>
											</div>
										</div>
										<span><img src="images/price4.png" alt="">1009</span>
									</li>
								</ul>
							</div>
							<div class="widget widget-adver">
								<img src="http://via.placeholder.com/370x270" alt="">
							</div>
						</div>-->
					</div>
				</div><!--forum-questions-sec end-->
			</div>
		</section><!--forum-page end-->


	

	</div><!--theme-layout end-->
@endsection
