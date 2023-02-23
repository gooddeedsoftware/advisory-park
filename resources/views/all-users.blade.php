
@extends('layout.app')

@section('content')
	
		<section class="companies-info">
			<div class="container">
				<div class="company-title">
					<h3>Advisors</h3>
				</div>
				<div class="companies-list">
					<div class="row">
					    @if(!empty($all_advisors))
					     @foreach($all_advisors as $data)
						    <div class="col-lg-3 col-md-4 col-sm-6">
    							<div class="company_profile_info">
    								<div class="company-up-info">
    									<!--<img src="http://via.placeholder.com/90x90" alt="">-->
    									@php $image = $data->image; @endphp @if($data->image !== null)
                                        <img src='{{asset("front/images/users/$image")}}' alt="" height="210px" />
                                        @else
                                        <img src='{{asset("front/images/users/image.jpg")}}' alt="" height="210px" />
                                        @endif
                        
    									<h3>{{$data->name}}</h3>
    									<h4>Joined {{date('d M, Y'),strtotime($data->created_at)}}</h4>
    									
                                        <div>
                                        <ul class="flw-status">
                                            <li>
                                                <span>Following</span>
                                                <b>{{ App\Models\Following::where('auth_id',$data->id)->where('status',1)->count() }}</b>
                                            </li>
                                            <li>
                                                <span>Followers</span>
                                                <b>{{ App\Models\Follower::where('auth_id',$data->id)->where('status',1)->count() }}</b>
                                            </li>
                                        </ul>
                                    </div>
                                        @auth
    									<ul>
    									    @if(App\Models\Following::where('auth_id',Auth::user()->id)->where('user_id',$data->id)->where('status',1)->exists() == true)
    										    <li><a href="{{route('following')}}?auth_id={{Auth::user()->id}}&user_id={{$data->id}}" title="" class="btn btn-outline-success text-success">Following</a></li>
    										@else
    										    <li><a href="{{route('following')}}?auth_id={{Auth::user()->id}}&user_id={{$data->id}}" title="" class="follow">Follow</a></li>
    										@endif
    									   
    										
    										<!--<li><a href="#" title="" class="message-us"><i class="fa fa-envelope"></i></a></li>-->
    									</ul>
    									@else
    									<ul>
    										<li><a href="{{route('login')}}" title="" class="follow">Follow</a></li>
    									</ul>
    									@endauth
    								</div>
    								@auth
    								<a href="{{route('user_profile',$data->id)}}" title="" class="view-more-pro">View Profile</a>
    								@else
    								<a href="{{route('login')}}" title="" class="view-more-pro">View Profile</a>
    								@endif
    							</div>
    						</div>
    					 @endforeach
						@else
						    <h4>No Advisor Found!</h4>
						@endif
						<!--<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="company_profile_info">
								<div class="company-up-info">
									<img src="http://via.placeholder.com/90x90" alt="">
									<h3>Google Inc.</h3>
									<h4>Establish Feb, 2004</h4>
									<ul>
										<li><a href="#" title="" class="follow">Follow</a></li>
										<li><a href="#" title="" class="message-us"><i class="fa fa-envelope"></i></a></li>
									</ul>
								</div>
								<a href="#" title="" class="view-more-pro">View Profile</a>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="company_profile_info">
								<div class="company-up-info">
									<img src="http://via.placeholder.com/90x90" alt="">
									<h3>Pinterest</h3>
									<h4>Establish Feb, 2004</h4>
									<ul>
										<li><a href="#" title="" class="follow">Follow</a></li>
										<li><a href="#" title="" class="message-us"><i class="fa fa-envelope"></i></a></li>
									</ul>
								</div>
								<a href="#" title="" class="view-more-pro">View Profile</a>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="company_profile_info">
								<div class="company-up-info">
									<img src="http://via.placeholder.com/90x90" alt="">
									<h3>Microsoft Inc.</h3>
									<h4>Establish Feb, 2004</h4>
									<ul>
										<li><a href="#" title="" class="follow">Follow</a></li>
										<li><a href="#" title="" class="message-us"><i class="fa fa-envelope"></i></a></li>
									</ul>
								</div>
								<a href="#" title="" class="view-more-pro">View Profile</a>
							</div>
						</div>-->
						
					</div>
				</div>
				<!--<div class="process-comm">
					<div class="spinner">
						<div class="bounce1"></div>
						<div class="bounce2"></div>
						<div class="bounce3"></div>
					</div>
				</div>-->
			</div>
		</section>

@endsection
