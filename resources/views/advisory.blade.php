@extends('layout.app')

@section('content')
		
		<main>
			<div class="main-section">
				<div class="container">
					<div class="main-section-data">
						<div class="row">
							<div class="col-lg-3 navWrap">
								<div class="filter-secs">
								    <!--<a href="{{route('advisory')}}" title="">Clear</a>-->
								    @foreach($field as $f)
								    <a href="{{route('field-wise-advisory')}}?field={{$f->id}}" class="filter-heading {{ (request()->get('field') == $f->id) ? 'theme-bg text-light' : 'text-dark' }}" style="padding-top: 15px;padding-bottom: 15px;margin-bottom:0px">
                                        <i class="{{$f->icon}}"></i>
                                        <span><strong>{{$f->name}}</strong></span>
									</a>
									@endforeach
									
								</div>
							</div>
							
							<div class="col-lg-9">
							    <div class="search-sec">
                        			<div class="container p-0">
                        				<div class="search-box">
                        					<form>
                        					   
                        						 <input class="typeahead form-control" placeholder="Search Advisory Listings..." id="search" type="text" name="search">
                        			        
                        					</form>
                        				</div>
                        			</div>
                        		</div>
								<div class="main-ws-sec">
									<div class="posts-section">
									   @if(count($advisory_listings) > 0) 
									   @foreach($advisory_listings as $data)
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
											<!--<div class="epi-sec">
												<ul class="descp">
													<li><span> <i class="fa fa-globe theme-color"></i> {{$data->users->designation ?? ''}}</span></li>
													<li> <span> <i class="fa fa-map-marker theme-color"></i> {{$data->users->city ?? ''}}</span></li>
												</ul>
												<ul class="bk-links">
													<li>
													    @auth
													    <a href="{{route('save')}}?user_id={{Auth::user()->id}}&blog_type=requirement&blog_id={{$data->id}}" >
													     <i class="la la-bookmark"  {!! App\Models\Save::where('user_id',Auth::user()->id)->where('blog_type','requirement')->where('blog_id',$data->id)->where('status',1)->exists() == true ? 'style="background:#53d690;color:#fff"' : 'style="background:#fff;color:#000"' !!}></i> 
													    </a>
													    @else
													    <a href="{{route('login')}}" title="">
													     <i class="la la-bookmark" ></i> 
													    </a>
													    @endauth
													    <span class="badge badge-info float-right mr-1">{{$data->field->name ?? ''}}</span>
													</li>
													<li><a href="#" title=""><i class="la la-envelope"></i></a></li>
													<li><a href="#" title="" class="bid_now">Bid Now</a></li>
												</ul>
											</div>-->
											<div class="job_descp">
											    <div class="row">
											        <div class="col-md-3">
														@if($data->image)
											            <a data-fancybox data-type="image" href='{{asset("front/images/advisory_listing/$data->image")}}'>
                                                            <img src='{{asset("front/images/advisory_listing/$data->image")}}' alt="" width="180" height="180" style="border-radius: 3px;box-shadow: 0 0 8px rgb(0 0 0 / 63%);" />
                                                        </a>
											        	@else
											            <a data-fancybox data-type="image" href='{{asset("front/images/empty.png")}}'>
                                                            <img src='{{asset("front/images/empty.png")}}' alt="" width="180" height="180" style="border-radius: 3px;box-shadow: 0 0 8px rgb(0 0 0 / 63%);" />
                                                        </a>
														
														@endif
													</div>
											        <div class="col-md-9">
											            <!--<span class="badge badge-info float-right">{{$data->category}}</span>-->
														<div class="row">
															<div class="col-md-7">
																<h3><a target="_blank"  class="theme-color" href="{{route('advisory-details',$data->slug)}}">{{$data->listing_name}}</a></h3>
															
																<h6><strong>Problem Details :</strong></h6>
																<p class="more">
																	{{$data->about_listing}}    
																</p>
																
																<h6><strong>Advisor Experience :</strong></h6>
																<p class="more">
																	{{$data->experience}}    
																</p>
																
															</div>
															<div class="col-md-5">
															    
															    
																<ul class="skills">
																	
																	<li><strong>Advisory Charges : </strong><span class="theme-color"><strong>₹ {{$data->fees}}</strong></span></li>
																
																</ul>
																<ul class="skills">
																	
																	<li><strong>Approx. Time to Complete Advisory  : </strong><span >{{$data->duration_in_hours}} {{$data->duration_in_hours ? "Hours" : ""}} {{$data->duration_in_minutes}} {{$data->duration_in_minutes ? "Minutes" : ""}}</span></li>
																
																</ul>
																<ul class="skills">
																	
																	<li><strong>Experience : </strong><span >{{$data->exp_in_years}} {{$data->exp_in_years ? "Years" : ""}} {{$data->exp_in_months}} {{$data->exp_in_months ? "Months" : ""}}</span></li>
																
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
														</div>
        												
        												
        											 </div>
        										</div>
												
											</div>
											<div class="job-status-bar">
											    <ul class="like-com float-right">
												@auth
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
												
												 @endauth
											</ul>
											    <!--<a><i class="la la-eye"></i>Views</a>-->
										    </div>
											
										</div>
									   @endforeach
									   @else
									   <h5 class="text-center mt-3">No Advisory Found.</h5>
									   @endif
									
									</div><!--posts-section end-->
								</div><!--main-ws-sec end-->
							</div>
							
						</div>
					</div><!-- main-section-data end-->
				</div> 
			</div>
		</main>
		
		

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

    $(function(){


		$(document).ready(function(){
		    
		    /*----show more/show less-------*/
            var showChar = 100;  
            var ellipsestext = "...";
            var moretext = "Read more";
            var lesstext = "Read less";
            
        
            $('.more').each(function() {
                var content = $(this).html();
         
                if(content.length > showChar) {
         
                    var c = content.substr(0, showChar);
                    var h = content.substr(showChar, content.length - showChar);
         
                    var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink theme-color">' + moretext + '</a></span>';
         
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
            
		    
		    
			$('[data-toggle="tooltip"]').tooltip();   
		});
       
      	
    })


    /*-----Autocomplete Search----*/
    $( "#search" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: "{{route('autocomplete')}}",
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
           $('#search').val(ui.item.label);
           console.log(ui.item); 
           return false;
        }
      });

    /*----open comment box-------*/
    
    function openComment(id){
        console.log(id);
       
        $('#comment-box-'+id).slideToggle();
    }
    
    /*--------------Talk to advisor----------------*/
   /* function talkToAdvisor(advisor_id,user_id,listing_id){
    
        $("#advisor_id").val(advisor_id);
        $("#user_id").val(user_id);
        $("#listing_id").val(listing_id);
    }*/


    $(document).ready(function(){
        
        /*----select2-------*/
            
            $(".multiple").select2({
                placeholder: "Select Skill",
                allowClear: true,
                tags: true
            });
            
            $(".multiple1").select2({
                placeholder: "Select Category",
                allowClear: true,
                tags: true
            });
            
            $(".multiple2").select2({
                placeholder: "Select Tag",
                allowClear: true,
                tags: true
            });
            
            
            
             /*----show socialite on share click-------*/
            
            $(".share").on('click',function(){
                $(".social-media-icons").fadeToggle();
            });
            
			/*----filter price slider-------*/
			$("#slider-range").slider({
				range: true,
				min: 1,
				max: 10000,
				step: 1,
				values: [1, 10000],
				slide: function(e, ui) {
					console.log(ui.value); 
					// $( "#sliderVal" ).val( "₹" + ui.values[ 0 ] + " - ₹" + ui.values[ 1 ] );
					$( "#sliderfrom" ).val(ui.values[ 0 ]);
					$( "#sliderto" ).val(ui.values[ 1 ] );
					var min = Math.floor(ui.values[0]);
					$('.slider-time').html('₹'+ min);

					var max = Math.floor(ui.values[1]);
					
					$('.slider-time2').html('₹'+ max);

					

				}
			});
            
            
        
    });
</script>
@endpush