@extends('layout.app')

@push('css')
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
@endpush

@section('content')
	<section class="cover-sec">
		@php $cover_image = $user->cover_image; @endphp
		@if($user->cover_image !== null)
		<img src='{{asset("front/images/users/$cover_image")}}' alt="" height="375px">
		@else
		<img src="https://via.placeholder.com/1600x400" alt="" height="375px">
		@endif
		<!--<a href="#" id="cover" title=""><i class="fa fa-camera"></i> Change Cover</a>-->
		<input type="file" id="my_cover" style="display: none;" data-id="{{$user->id}}" />
	</section>


	<main>
		<div class="main-section">
			<div class="container">
				<div class="main-section-data">
					<div class="row">
						<!-- User Tabs sidebar -->
						<div class="col-lg-3">
                            <div class="main-left-sidebar">
                                <div class="user_profile">
                                    <div class="user-pro-img">
                                        @php $image = $user->image; @endphp @if($user->image !== null)
                                        <img src='{{asset("front/images/users/$image")}}' alt="" height="210px" />
                                        @else
                                        <img src='{{asset("front/images/users/image.jpg")}}' alt="" height="210px" />
                                        @endif
                        
                                        <!--<a href="#" id="image" title=""><i class="fa fa-camera"></i></a>-->
                                        <input type="file" id="my_file" style="display: none;" data-id="{{$user->id}}" />
                                    </div>
                                    <!--user-pro-img end-->
                                    <div class="user_pro_status">
                                        <ul class="flw-status">
                                            <li>
                                                <span>Following</span>
                                                <b>{{ App\Models\Following::where('auth_id',$user->id)->where('status',1)->count() }}</b>
                                            </li>
                                            <li>
                                                <span>Followers</span>
                                                <b>{{ App\Models\Follower::where('auth_id',$user->id)->where('status',1)->count() }}</b>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--user_pro_status end-->
                                    <div class="tab-feed st2">
                                        <ul class="social_links">
                                            <!--<li data-tab="info-dd"><a href="#info-dd" title="">My Profile</a></li>-->
                                            <!--@if(\Session::get('type') == 'User')
                                            <li data-tab="letsconnect-dd"><a href="#letsconnect-dd" title="">Let's Connect</a></li>
                                            <li data-tab="myrequirments-dd"><a href="#myrequirments-dd" title="">My Requirements</a></li>
                                            @elseif(\Session::get('type') == 'Advisor')
                                            <li data-tab="business-dd"><a href="#business-dd" title="">My Business Profile</a></li>
                                            <li data-tab="advisory-listing-dd"><a href="#advisory-listing-dd" title="">My Advisory Listing</a></li>
                                            <li data-tab="myleads-dd"><a href="#myleads-dd" title="">My Leads</a></li>
                                            <li data-tab="myposts-dd"><a href="#myposts-dd" title="">My Posts</a></li>
                                            
                                            @endif
                                            <li><a href="{{route('logout')}}" title="">Logout</a></li>-->
                                        </ul>
                                    </div>
                                </div>
                              
                            </div>
                        </div>

						<!-- User Tabs sidebar -->

						<div class="col-lg-9">
							<div class="main-ws-sec">
								<!-- Tabs option for tab -->
								<div class="user-tab-sec">
                                    <h2>
                                        {{$user->name}}
                                        <a href="#" title="" class="theme-color" style="font-size:20px">{{Auth::user()->advisory_park_id}}</a>
                                    </h2>
                                    <div class="star-descp">
                                        <span>{{$user->designation}}</span>
                                        <ul class="mr-3">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-half-o"></i></li>
                                        </ul>
                                        <!--<a href="#" title="">Status</a>-->
                                        <ul>
                                            <li>
                                                <a href="#" title=""><i class="la la-globe"></i></a>
                                            </li>
                                            <li>
                                                <a href="#" title=""><i class="fa fa-facebook-square"></i></a>
                                            </li>
                                            <li>
                                                <a href="#" title=""><i class="fa fa-twitter"></i></a>
                                            </li>
                                            <li>
                                                <a href="#" title=""><i class="fa fa-pinterest"></i></a>
                                            </li>
                                            <li>
                                                <a href="#" title=""><i class="fa fa-instagram"></i></a>
                                            </li>
                                            <li>
                                                <a href="#" title=""><i class="fa fa-youtube-play text-danger"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-feed st2">
                                        <ul>
                                            <!--<li data-tab="info-dd" class="animated fadeIn active">
                                                <a href="#" title="" class="true">
                                                    <img src="{{asset('front/images/ic2.png')}}" alt="" />
                                                    <span>Info</span>
                                                </a>
                                            </li>
                                            <li data-tab="feed-dd">
                                                <a href="#" title="">
                                                    <img src="{{asset('front/images/ic1.png')}}" alt="" />
                                                    <span>Feed</span>
                                                </a>
                                            </li>-->
                                            
                                        </ul>
                                    </div>
                                </div>
								<!-- Tabs option for tab -->

								<!-- Info dd -->
								<div class="product-feed-tab current" id="info-dd">
                                    <form id="profile-form" onsubmit="return false;">
                                        <div class="user-profile-ov">
                                            <h3><a href="#" title="" class="overview-open">Profile Info</a> <a href="#" title="" class="overview-open"></a></h3>
                                            <div class="row mb-2">
                                                
                                                <div class="col-md-6">
                                                    <label>Name</label>
                                                    <h3>{{$user->name}}</h3>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Your Advisory Park Id</label>
                                                    <h3>{{$user->advisory_park_id}}</h3>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-6">
                                                    <label>Gender</label>
                                                    <h5>{{$user->gender}}</h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Address</label>
                                                    <h5>{{$user->address}}</h5>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-4">
                                                    <label>Country</label>
                                                    <h5>{{$user->country}}</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>State</label>
                                                    <h5>{{$user->state}}</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>City</label>
                                                    <h5>{{$user->city}}</h5>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-4">
                                                    <label>Pincode</label>
                                                    <h5>{{$user->pincode}}</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Contact</label>
                                                    <h5>{{$user->contact}}</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Email</label>
                                                    <h5>{{$user->email}}</h5>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-4">
                                                    <label>Language Known</label>
                                                    <h5>{{$user->language_known}}</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Skill @if(\Session::get('type') == 'Advisor')@endif</label>
                                                    <ul class="skill-tags">
                                                        @php $k = getPostFields($user->skills) @endphp
                                                        @if($k)    
                                                            @foreach($k as $v)
        													 <li><a href="javascript:void(0);" title="">{{$v}}</a></li>
                                                            @endforeach
                                                        @endif    
													</ul>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Advisory Mimimum Charge</label>
                                                    <h5>{{$user->advisory_minimum_charges}}</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Work Status</label>
                                                    <h5>{{$user->work_status}}</h5>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-12">
                                                    <label>Education</label>
                                                    <h5>{{$user->education}}</h5>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-12">
                                                    <label>Qualification/ Achievements/ Certification/ Awards</label>
                                                    <h5>{{$user->qualifications}}</h5>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-12">
                                                    <label>Experience</label>
                                                    <h5>{{$user->experience}}</h5>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-12">
                                                    <label>Write more about yourself</label>
                                                    <h5>{{$user->about_us}}</h5>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </form>
                                    
                                </div>


								<!-- Info dd -->
								
								<!-- Feed dd -->
								@include('tabs.feeds-tab') 
								<!-- Feed dd -->
								
							</div>
							<!--main-ws-sec end-->
						</div>
					</div>
				</div><!-- main-section-data end-->
			</div> 
		</div>
	</main>

	<footer>
		<div class="footy-sec mn no-margin">
			<div class="container">
				<ul>
					<li><a href="#" title="">Help Center</a></li>
					<li><a href="#" title="">Privacy Policy</a></li>
					<li><a href="#" title="">Community Guidelines</a></li>
					<li><a href="#" title="">Cookies Policy</a></li>
					<li><a href="#" title="">Career</a></li>
					<li><a href="#" title="">Forum</a></li>
					<li><a href="#" title="">Language</a></li>
					<li><a href="#" title="">Copyright Policy</a></li>
				</ul>
				<p><img src="#" alt="">Copyright 2022</p>
				<img class="fl-rgt" src="#" alt="">
			</div>
		</div>
	</footer><!--footer end-->

	<!-- add views/profile-contents/optional-content.blade.php if you want to make it functional currently it was not need -->

	<!---------------------------- Business Profile modal ------------------------------->
	@include('modals.business-profile-modal') 
	<!---------------------------- Business Profile modal ------------------------------->

	<!--------------------------- Advisory Listing modal ------------------------------>
	@include('modals.advisory-listing-modal')
	<!--------------------------- Advisory Listing modal ------------------------------>
	
	<!------------------------- Reject Request Reason Modal --------------------------->
	@include('modals.reject-request-reason-modal')
	<!------------------------- Reject Request Reason Modal --------------------------->
	
	<!----------------------- Satisfy/Dissatisfy Feedback Modal ----------------------->
	@include('modals.satisfy-feedback-modal')
	<!----------------------- Satisfy/Dissatisfy Feedback Modal ----------------------->
	
	<!----------------------- Re-Request Advisory Modal ----------------------->
	@include('modals.re-request-modal')
	<!----------------------- Re-Request Advisory Modal ----------------------->
	
	<!----------------------- Advisor's Message Advisory Modal ----------------------->
	@include('modals.advisor-message-modal')
	<!----------------------- Advisor's Message Advisory Modal ----------------------->
	
	<!----------------------- User's Complain Modal ----------------------->
	@include('modals.complain-modal')
	<!----------------------- User's Complain Modal ----------------------->
		
@endsection
@push('js')
	<!-- PROFILE JS START -->
	@include('profile-contents.profile-js') 
	<!-- PROFILE JS END ---->
@endpush