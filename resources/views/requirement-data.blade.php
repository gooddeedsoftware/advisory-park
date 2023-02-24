@foreach($req as $data)
<div class="post-bar">
	<div class="post_topbar">
		<div class="usy-dt">
			<div class="usy-name">
				<img src="http://via.placeholder.com/50x50" alt="">
				
					<!--<a href="{{route('user_profile',$data->users->id)}}" class="text-dark">{{$data->users->advisory_park_id}}</a>@auth <i class="user_status_{{$data->users->id}} user_active_status fa fa-circle {{($data->users->is_active == '1') ? 'text-success' : 'text-danger' }} " aria-hidden="true"></i>@endauth-->
					<!--<span><i class="fa fa-clock-o theme-color"></i> {{$data->created_at->diffForHumans()}}</span>-->
					<a href="{{route('user_profile',$data->users->id)}}" target="_blank" class="text-dark">
						<h3 class="mb-0">
							{{$data->users->name}} 
							<span class="text-success">{{$data->users->advisory_park_id}}</span>
							@auth <i class="user_status_{{$data->users->id}} user_active_status fa fa-circle {{($data->users->is_active == '1') ? 'text-success' : 'text-danger' }} " aria-hidden="true" style="margin-right:2rem;"></i>@endauth
							<span class="badge theme-bg text-light float-right" style="margin-left:30rem!important">{{$data->field->name ?? ''}}</span>    
						</h3> 
					</a>
					@php
						$followers = App\Models\Follower::where('auth_id',$data->users->id)->where('status',1)->count();
					@endphp
					<span> {{$followers}} Followers</span><br>
					<span> Joined Since {{$data->users->created_at->diffForHumans()}}</span>
				
			</div>
		</div>

	</div>
	
	<div class="job_descp">
	
		<?php
		// 	$cats = getPostCategories($data->category);
		// 	$skills = getPostSkills($data->skill);
		// 	$tags = getPostTags($data->tag);
			$skills = getPostFields($data->skill);
		?>
		
		@if($data->skill)
		@foreach($skills as $id => $name)
			<span class="badge badge-info float-right mr-1">{{$name}}</span>
		@endforeach
		@endif
		<br><br>
		<h3>
			<a class="theme-color" href="{{route('requirements_details',$data->slug)}}" target="_blank">{{$data->title}}</a> 
		</h3>
		<p class="more">{{$data->description}}</p> 
		<ul class="job-dt">
			<li><a href="#" class="bg-secondary">Min.Budget : {{$data->min_budget ?? 0}}</a></li>
			<li><a href="#" class="bg-secondary">Max.Budget : {{$data->max_budget ?? 0}}</a></li>
			<!--<li><span>$30 / hr</span></li>-->
			<li class="float-right">Waiting Period : <span>{{$data->responding_time ?? 'N/A'}}</span></li>
		</ul>
		<!--<p>{{Str::limit($data->description,200)}} <a href="#" title="">view more</a></p>
		@if($data->skill)
		<ul class="skills">
			@foreach($skills as $id => $name)
			<li><a href="javascript:void(0);" title="">{{$name}}</a></li>
			@endforeach
		</ul>
		@endif
		{{--
		@if($data->tag)
		<ul class="skill-tags">
			@foreach($tags as $id => $name)
			<li><a href="javascript:void(0);" title="">{{$name}}</a></li>
			@endforeach
		</ul>
		@endif --}}
		-->
	</div>
	
	<div class="job-status-bar">
		<ul class="like-com float-right">
			
		@auth
			@php 
				$interest = App\Models\RequirementInterest::where('requirement_id',$data->id)->where('entity_id',Auth::user()->id)->first();
			@endphp
			
			@if(!$interest)
			@if(\Session::get('type') == 'Advisor' && $data->created_by != Auth::user()->id)  
			<button type="button" class="btn btn-success btn-sm" onclick="interestedOrNot({{$data->id}},'{{route('requirements_details',$data->slug)}}','{{App\Models\Notification::activity_requirement}}',1)">Are You Interested ? <i class="fa fa-thumbs-up"></i></button>
			
			<!--<button class="btn btn-danger btn-sm" onclick="interestedOrNot({{$data->id}},'{{route('requirements_details',$data->slug)}}','{{App\Models\Notification::activity_requirement}}',2)">Not Interest <i class="fa fa-thumbs-down"></i> </button>-->
			@endif
			@else
			<button class="btn btn-sm float-right btn-outline-<?=($interest->status == 1)?'success':'danger'?>">@if($interest->status == 1) Already Interested @else Not Interested @endif</button>
			@endif
			
		@endauth
		<!--@auth
		<li>
			@if(\Session::get('type') == 'User')
				<a href="javascript:void(0);" class="active btn theme-bg text-light" onclick="talkToAdvisor('{{$data->added_by}}','{{Auth::user()->id}}','advisory-listing','{{$data->id}}');" data-toggle="modal" data-target="#talkToadvisorModal">
				<i class="las la-phone"></i> Talk to advisor</a>
			@endif
		</li>
		
			
			@else
			<li>
			<a class="active btn theme-bg text-light" href="{{route('login')}}" >
				<i class="las la-phone"></i> Talk to advisor
			</a>
			</li>
		
			@endauth-->
	</ul>
		<!--<a><i class="la la-eye"></i>Views</a>-->
	</div>
	
</div>
@endforeach
