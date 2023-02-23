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
						    <div class="col-lg-3 col-md-4 col-sm-6 ">
    							<div class="company_profile_info">
    								<div class="company-up-info">
    									<!--<img src="http://via.placeholder.com/90x90" alt="">-->
    									@php $image = $data->users->image; @endphp @if($data->users->image !== null)
    									    <a data-fancybox data-type="image" href='{{asset("front/images/users/$image")}}'>
                                              <img src='{{asset("front/images/users/$image")}}' alt="image" height="210px" />
                                            </a>
                                        @else
                                            <a data-fancybox data-type="image" href='{{asset("front/images/empty.png")}}'>
                                                <img src='{{asset("front/images/empty.png")}}' alt="image" height="210px" />
                                            </a>
                                        @endif
                        
    									<h3>{{$data->users->name}}</h3>
    									<h4>Joined {{date('d M, Y'),strtotime($data->created_at)}}</h4>
    									
                                        <div>
                                        <ul class="flw-status">
                                            <li>
                                                <span>Following</span>
                                                <b>{{ App\Models\Following::where('auth_id',$data->users->id)->where('status',1)->count() }}</b>
                                            </li>
                                            <li>
                                                <span>Followers</span>
                                                <b>{{ App\Models\Follower::where('auth_id',$data->users->id)->where('status',1)->count() }}</b>
                                            </li>
                                        </ul>
                                    </div>
                                        <DIV CLASS="mb-2">
                                        @auth
                                        @if($data->id != Auth::user()->id)
										    @if(App\Models\Following::where('auth_id',Auth::user()->id)->where('user_id',$data->users->id)->where('status',1)->exists() == true)
											<a class="btn btn-success btn-sm rounded" href="{{route('following')}}?auth_id={{Auth::user()->id}}&user_id={{$data->users->id}}">
											   <i class=" fa fa-check"></i> Following
											</a>
											@else
											<a class="btn btn-outline-success btn-sm rounded" href="{{route('following')}}?auth_id={{Auth::user()->id}}&user_id={{$data->users->id}}">
											   <i class=" fa fa-plus"></i> Follow
											</a>
											@endif
										
										@endif
										</DIV>
    									<ul>
    									    {{--
    									    @if(App\Models\Following::where('auth_id',Auth::user()->id)->where('user_id',$data->id)->where('status',1)->exists() == true)
    										    <li><a href="{{route('following')}}?auth_id={{Auth::user()->id}}&user_id={{$data->id}}" title="" class="btn btn-outline-success text-success">Following</a></li>
    										@else
    										    <li><a href="{{route('following')}}?auth_id={{Auth::user()->id}}&user_id={{$data->id}}" title="" class="follow">Follow</a></li>
    										@endif
    										--}}
    									    <li>
											@if(Session('type') == 'User')
        										@if(App\Models\AdvisoryRequest::where('user_id',Auth::user()->id)->where('advisor_id',$data->users->id)->where('status',4)->first())
        										
    										        @if(App\Models\AdvisoryRequest::where('user_id',Auth::user()->id)->where('advisor_id',$data->users->id)->where('status',5)->first())
        									    	<a href="tel:{{$data->users->contact}}" type="button" class="btn btn-sm theme-color"><i class="las la-phone"></i> {{$data->users->contact}}</a>
    												<a href="https://wa.me/{{$data->users->contact}}" type="button" class="btn btn-sm theme-color"><i class="la la-whatsapp"></i></a>
    											    @endif
    											@else
        									        <a type="button" class="btn theme-bg theme-border" href="javascript:void(0);" onclick="talkToAdvisor('{{$data->user_id}}','{{Auth::user()->id}}','advisors-list');"  data-toggle="modal" data-target="#talkToadvisorModal">
    														<i class="las la-user"></i> Talk to advisor
    												</a>
    												<!--<a type="button" class="btn theme-bg theme-border" href="javascript:void(0);" onclick="tToAd({{Auth::user()->id}},{{$data->user_id}});"  data-toggle="modal" data-target="#tToAModal{{$data->id}}">
    														<i class="las la-user"></i> Talk to advisor
    												</a>-->
    										    @endif
    											
    										@endif
											</li>
											
											    	<!--Talk to advisor modal in all advisors list-->
                                            		<!--<div class="modal fade" id="tToAModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="tToAModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="tToAModalLabel">Talk to Advisor</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                            </button>
                                                          </div>
                                                          <div class="modal-body">
                                                            <form id="request-form" method="post" action="{{route('requirements.store')}}">
                                                                @csrf
                                                                <input type="hidden" value="" class="user_id" name="user_id">
                                                                <input type="hidden" value="{{$data->users->skills}}" class="" name="skill">
                                            
                                                              <div class="form-group">
                                                                <label for="title" class="col-form-label">Title:<span class="text-danger">*</span></label>
                                                                <input type="text"  value="" class="form-control" id="title" name="title" required>
                                                              </div>
                                                              <div class="form-group">
                                                                <label for="des" class="col-form-label">Description:</label>
                                                                <textarea class="form-control" id="des" name="description"></textarea>
                                                              </div>
                                                            
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-sm" style="background-color:#008069;color:#fff;">Send Request</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                            		<!--Talk to advisor modal in all advisors list-->
    										
    										<!--<li><a href="#" title="" class="message-us"><i class="fa fa-envelope"></i></a></li>-->
    									</ul>
    									@else
    									<ul>
    										<li><a href="{{route('login')}}" title="" class="follow">Follow</a></li>
    										<li><a class="active" href="{{route('login')}}"><i class="las la-user"></i> Talk to advisor</a>
											</li>
    									</ul>
    									@endauth
    								</div>
    								@auth
    								<a href="{{route('user_profile',$data->users->id)}}" target="_blank" title="" class="view-more-pro">View Profile</a>
    								@else
    								<a href="{{route('login')}}" title="" class="view-more-pro">View Profile</a>
    								@endif
    							</div>
    						</div>
    					 @endforeach
						@else
						    <h4>No Advisor Found!</h4>
						@endif
					
					</div>
				</div>
				
			</div>
		</section>
		
	

@endsection
@push('js')
    <script>
        
		/*--------------Talk to advisor All Advisors ----------------*/
		/*function tToAd(advisor_id,user_id){
		   
			$(".advisor_id").val(advisor_id);
			$(".user_id").val(user_id);
		}*/
    </script>
@endpush