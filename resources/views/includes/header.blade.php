<header>
			<div class="container">
				<div class="header-data">
					<div class="logo">
						<a href="{{route('index')}}" title=""><img src="{{asset('front/images/logo.png')}}" style="height:50px" alt=""></a>
					</div>
					<!--<div class="search-bar">
						<form>
							<input type="text" name="search" placeholder="Search...">
							<button type="submit"><i class="la la-search"></i></button>
						</form>
					</div>--><!--search-bar end-->
					<nav>
						<ul>
							<li>
								<a href="{{route('index')}}" title="">
									<!--<span><img src="{{asset('front/images/icon1.png')}}" alt=""></span>-->
									<span><i class="fa fa-home"></i></span>
									Home
								</a>
							</li>
							<li>
								<a class="post_project" href="#" title="">
									<!--<span><img src="{{asset('front/images/icon2.png')}}" alt=""></span>-->
									<span><span><i class="fa fa-edit"></i></span></span>
									Post a Requirement
								</a>
							</li>
							
							
							<!--<li>
								<a href="{{route('top_advisors')}}" title="">
									<span><img src="{{asset('front/images/icon2.png')}}" alt=""></span>
									Top Advisors
								</a>-->
							    <!--<ul>
									<li><a href="companies.html" title="">Companies</a></li>
									<li><a href="company-profile.html" title="">Company Profile</a></li>
								</ul>-->
							<!--</li>-->
							<li>
								<a href="{{route('requirements')}}" title="">
									<!--<span><img src="{{asset('front/images/icon4.png')}}" alt=""></span>-->
									<span><span><i class="fa fa-file-text"></i></span></span>
									Requirements
								</a>
							</li>
							<li>
								<a href="{{route('advisory')}}" title="">
									<!--<span><img src="{{asset('front/images/icon3.png')}}" alt=""></span>-->
									<span><span><i class="fa fa-user-circle-o"></i></span></span>
									Advisory
								</a>
							</li>
						<!--	<li>
								<a href="profiles.html" title="">
									<span><img src="{{asset('front/images/icon4.png')}}" alt=""></span>
									Profiles
								</a>
								<ul>
									<li><a href="user-profile.html" title="">User Profile</a></li>
									<li><a href="my-profile-feed.html" title="">my-profile-feed</a></li>
								</ul>
							</li>
							<li>
								<a href="jobs.html" title="">
									<span><img src="{{asset('front/images/icon5.png')}}" alt=""></span>
									Jobs
								</a>
							</li>-->
						<!--	<li>
								<a href="#" title="" class="not-box-open">
									<span><img src="{{asset('front/images/icon6.png')}}" alt=""></span>
									Messages
								</a>
								<div class="notification-box msg">
									<div class="nt-title">
										<h4>Setting</h4>
										<a href="#" title="">Clear all</a>
									</div>
									<div class="nott-list">
										<div class="notfication-details">
							  				<div class="noty-user-img">
							  					<img src="#" alt="">
							  				</div>
							  				<div class="notification-info">
							  					<h3><a href="messages.html" title="">Jassica William</a> </h3>
							  					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do.</p>
							  					<span>2 min ago</span>
							  				</div>
						  				</div>
						  				<div class="notfication-details">
							  				<div class="noty-user-img">
							  					<img src="#" alt="">
							  				</div>
							  				<div class="notification-info">
							  					<h3><a href="messages.html" title="">Jassica William</a></h3>
							  					<p>Lorem ipsum dolor sit amet.</p>
							  					<span>2 min ago</span>
							  				</div>
						  				</div>
						  				<div class="notfication-details">
							  				<div class="noty-user-img">
							  					<img src="#" alt="">
							  				</div>
							  				<div class="notification-info">
							  					<h3><a href="messages.html" title="">Jassica William</a></h3>
							  					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore et dolore magna aliqua.</p>
							  					<span>2 min ago</span>
							  				</div>
						  				</div>
						  				<div class="view-all-nots">
						  					<a href="{{route('messages')}}" title="">View All Messsages</a>
						  				</div>
									</div>
								</div>
							</li>-->
							
							<li>
								<a href="javascript:void(0)" title="" class="not-box-open">
									<span>
										<i class="fa fa-bell"></i>
										@auth
    									  @php
    										  $new_notif = App\Models\Notification::where('entity_id',Auth::user()->id)->where('entity_type',session()->get('type'))->where('seen_status',0)->count();
    									  @endphp
    									  @if($new_notif > 0)
    										<span class="badge badge-danger new-notif" data-tooltip="{{$new_notif}} New Messages." data-tooltip-position="right">{{$new_notif}}</span>
    									  @endif
										@endauth
									</span>
									Notification 
								</a>
								<div class="notification-box">
									<div class="nt-title">
										<h4>Notifications</h4>
										<!-- <a href="#" title="">Mark all as Read</a> -->
									</div>
									
									<div class="nott-list">
										
									@auth
										<div class="notfication-details">
							  				<div class="noty-user-img">
							  					<img src="#" alt="">
							  				</div>
							  				
											@php 
												$notif = App\Models\Notification::where('entity_id',Auth::user()->id)->where('entity_type',session()->get('type'))->where('seen_status',0)->latest()->get();
											 
											@endphp
											@if($notif->isNotEmpty())
											@foreach($notif as $n)
												<div class="notification-info noti_btn" id="notifi">
													<span>{{getTimeAgo($n->created_at)}}</span>
													
													<h3 style="cursor:pointer;" onclick="seen_notification({{$n->id}},'{{url($n->link)}}');">
														{{$n->notification}}
													</h3>
													@if(\Session::get('type') == 'Advisor')
													 @if(in_array($n->activity_type,[App\Models\Notification::activity_requirement,App\Models\Notification::activity_post]))
													 <button class="btn btn-success btn-sm" onclick="seen_notification({{$n->id}},'{{url($n->link)}}','{{$n->activity_type}}',1);"><i class="fa fa-thumbs-up"></i></button>
													 <button class="btn btn-danger btn-sm" onclick="seen_notification({{$n->id}},'{{url($n->link)}}','{{$n->activity_type}}',2);"><i class="fa fa-thumbs-down"></i></button>
													 @endif
													@endif
												</div>
												<hr style="visibility:hidden;">
											@endforeach
											@else
												<div class="notfication-details">
            										<div class="notification-info">
            											<h3>No Notification Found.</h3>
            										</div>
            									</div>
            								@endif
												
						  				</div>
						  				<!-- <div class="notfication-details">
							  				<div class="noty-user-img">
							  					<img src="#" alt="">
							  				</div>
							  				<div class="notification-info">
							  					<h3><a href="#" title="">Jassica William</a> Comment on your project.</h3>
							  					<span>2 min ago</span>
							  				</div>
						  				</div> -->
						  				
						  				<!-- <div class="view-all-nots">
						  					<a href="#" title="">View All Notification</a>
						  				</div> -->
									@else
									<div class="notfication-details">
										<div class="notification-info">
											<h3>No Notification Found.</h3>
										</div>
									</div>
									@endauth
									</div>
									<!--nott-list end-->
								</div><!--notification-box end-->
							</li>
							
						</ul>
					</nav><!--nav end-->
					<div class="menu-btn d-none">
						<a href="javascript:void(0)" title=""><i class="fa fa-bars"></i></a>
					</div><!--menu-btn end-->
					<div class="user-account">
						<div class="user-info">
    						 @auth
    						    @php $image = Auth::user()->image ? Auth::user()->image : "image.jpg"; @endphp
    						    <img src='{{asset("front/images/users/$image")}}' alt="" height="25px">&nbsp;
    							<a href="javascript:void(0)" title="">
    							    {{Auth::user()->name}}
    							</a>
    						    <!--<i class="la la-sort-down"></i>-->
    						 @else
    							<a href="{{route('login')}}" title="">Signup / Signin</a>
    						 @endauth
							
						</div>
						<div class="user-account-settingss">
							<!--<h3>Online Status</h3>
							-->
							<ul class="us-links m-0">
							  @auth
							   @if(\Session::get('type') == 'Advisor')
								<!--<li>
    								<a href="javascript:void(0)" type="button" class="theme-bg btn btn-sm text-light" data-toggle="modal" data-target="#WalletModal">
                                      Balance : ₹ {{Auth::user()->wallet}}
                                    </a>
                                </li>-->
                                    <!-- Wallet Modal -->
                                    <div class="modal" id="WalletModal" tabindex="-1" role="dialog" aria-labelledby="WalletModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="ffeed">Payment Request</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                
                                                <div class="modal-body">
                                                 <form id="fb-form" method="post" action="{{route('payment.request')}}">
                                                   @csrf
                                                    <input name="amount" class="form-control" id="request_fees" placeholder="Request Fees" required>
                                                    <br>
                                                    <textarea name="message" class="form-control" id="advisors_msg" cols="30" rows="3" placeholder="Send a message...."></textarea>
                                                    
                                                    <button type="submit" class="btn btn-primary request theme-bg theme-border mt-2 float-right">Request</button>
                                                </form>
                                                </div>
                                    
                                                <!--<div class="modal-footer">
                                                  
                                                </div>-->
                                            </div>
                                        </div>
                                    </div>
                                
                                @endif
								<li><a href="{{route('profile')}}" title="">Profile</a></li>
								<li><a href="{{route('account_setting')}}" title="">Account Settings</a></li>
								
								<li><a href="{{url('switch-type')}}?type={{\Session::get('type')}}" onclick="localStorage.clear();" title="" >Switch to {{\Session::get('type') == 'User' ? 'Advisor' : 'User'}}</a></li>
							<!--	<li><a href="#" title="">Privacy</a></li>
								<li><a href="#" title="">Faqs</a></li>
								<li><a href="#" title="">Terms & Conditions</a></li>-->
							  @else
							 
							    <li><a href="{{route('login')}}" title="">Signup / Signin</a></li>
							  @endauth
							</ul>
							 @auth <h3 class="tc m-0 "><a href="{{route('logout')}}" onclick="localStorage.clear();" class="text-danger">Logout</a></h3> @endauth
						</div><!--user-account-settingss end-->
					</div>
				</div><!--header-data end-->
			</div>
		</header><!--header end-->