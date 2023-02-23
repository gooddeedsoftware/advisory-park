<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{{env('APP_NAME')}}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link rel="stylesheet" type="text/css" href="{{asset('front/css/animate.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('front/css/bootstrap.min.css')}}">
        <!--<link rel="stylesheet" type="text/css" href="{{asset('front/css/line-awesome.css')}}">-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"  />
        <link rel="stylesheet" type="text/css" href="{{asset('front/css/line-awesome-font-awesome.min.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"  />
        <link rel="stylesheet" type="text/css" href="{{asset('front/css/jquery.mCustomScrollbar.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('front/css/slick.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('front/css/slick-theme.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('front/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('front/css/responsive.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('front/css/footer.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css"  />
    
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.css" />
        <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"  />-->
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" />
       
		<script type="text/javascript" src="{{asset('front/js/jquery.min.js')}}"></script>
		
		@stack('css')
		
		<style>
		    .select2-container--default .select2-results__option--highlighted[aria-selected]{
		        background:#008069 !important;
		        color: #fff !important;
		    }
		    
            .se-pre-con {
            	position: fixed;
            	left: 45%;
            	top: 35%;
            	width: 100px;
            	height: 100px;
            	z-index: 9999;
            }
            button.dt-button, div.dt-button, a.dt-button, input.dt-button{
                margin-left: 0.4rem !important;
                padding : .2em 0.6em !important;
            }
            
            .dropbtn {
              background-color: #3498DB;
              color: white;
              padding: 16px;
              font-size: 16px;
              border: none;
              cursor: pointer;
            }
            
            .dropbtn:hover, .dropbtn:focus {
              background-color: #2980B9;
            }
            
            .dropdown {
              position: relative;
              display: inline-block;
            }
            
            .dropdown-content {
              display: none;
              position: absolute;
              background-color: #f1f1f1;
              min-width: 160px;
              overflow: auto;
              box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
              z-index: 1;
            }
            
            .dropdown-content a {
              color: black;
              padding: 12px 16px;
              text-decoration: none;
              display: block;
            }
            
            .dropdown a:hover {background-color: #ddd;}
            
            .show {display: block;}
            
            
		</style>
    </head>


<body>
        
	<div class="wrapper" style="height:1300px">
	        <div class="se-pre-con spinner mt-5">
				<div class="bounce1"></div>
				<div class="bounce2"></div>
				<div class="bounce3"></div>
			</div>
            <!-- / header section -->
            @include('includes.header')
            <!-- / header section -->
 
            <!-- Start Main Content Section -->
            @yield('content')
            <!--  End Main Content Section -->
            
            <!-- Spinner-->
           <!-- <div class="process-comm" style="display:none;">
    			<div class="spinner">
    				<div class="bounce1"></div>
    				<div class="bounce2"></div>
    				<div class="bounce3"></div>
    			</div>
    		</div>-->
    <!-- Post a blog modal -->
    	<div class="post-popup job_post">
			<div class="post-project">
				<h3>Post</h3>
				<div class="post-project-fields">
					<form action="{{route('store.post')}}" id="post_form" method="post" enctype="multipart/form-data">
					    @csrf
						<input type="hidden" name="id" id="post_id" value="">
						<div class="row">
						    
						    <div class="col-lg-6">
								<label>Title<span class="text-danger">*</span></label>
    				            <input type="text" class="form-control" name="title" placeholder="Title">
							</div>
						
							<div class="col-lg-6">
                                <label> Field(Sector) </label>
								<div class="inp-field">
									<select name="skill[]" class="multiple" id="skill_p" multiple >
									@foreach($config['field'] as $s)
										<option value="{{$s->id}}" data-val="{{$s->name}}">{{$s->name}}</option>
									@endforeach
									</select>
								</div>
							</div>
						
							<div class="col-lg-12">
								<label>Image<span class="text-danger">*</span></label>
    				            <input type="file" class="form-control" name="image" accept="image/*">
							</div>
						
							<div class="col-lg-12">
                                <label> Description<span class="text-danger">*</span></label>
								<textarea name="description" id="post_description" placeholder="Description" required></textarea>
							</div>
						</div>
						<div class="col-lg-12">
							<ul>
								@auth
								<li><button class="active" type="submit" value="post" id="postSubmit">Post</button></li>
								@else
								<li><a href="{{route('login')}}" class="active" type="button" value="post">Post</a></li>
								@endauth
								<!--<li><a href="#" title="">Cancel</a></li>-->
							</ul>
						</div>
					</form>
				</div><!--post-project-fields end-->
				<a href="#" title=""><i class="la la-times-circle-o"></i></a>
			</div><!--post-project end-->
		</div><!--post-a blog-popup end-->
     <!-- Post a blog modal --> 
    </div>


    <!-- Post a requirement -->
    
		<div class="post-popup pst-pj">
			<div class="post-project">
				<h3>Post a requirement</h3>
				<div class="post-project-fields">
					<form action="{{route('requirements.store')}}" method="post" id="post-form">
					    @csrf
						<div class="row">
							<div class="col-lg-6">
                                <label>Title </label>
                                
								<input type="hidden" name="id" id="id_r" required>
								
								<input type="text" name="title" placeholder="Title" id="title_r" required>
							</div>
							
							<div class="col-lg-6">
                            <label>Related Sector </label>
								<div class="inp-field">
									<select name="skill[]" class="multiple" id="skill_r"  multiple required>
									@foreach($config['field'] as $f)
										<option value="{{$f->id}}" data-val="{{$f->name}}">{{$f->name}}</option>
									@endforeach
									</select>
								</div>
							</div>
							
							<div class="col-lg-12">
                                <label>Describe the problem you are facing or the matter in which the advisory is required?</label>
								<textarea name="description" id="description_r" placeholder="Explain in Details...." required></textarea>
							</div>
							<div class="col-lg-6">
                                <label>Budget(Min.) </label>
								<input type="number" name="min_budget"  placeholder="Mininum Budget" required>
							</div>
							<div class="col-lg-6">
                                <label>Budget(Max.) </label>
								<input type="number" name="max_budget"  placeholder="Maximum Budget" required>
							</div>
							<div class="col-lg-12">
							    <label>Your waiting period to get the advisor's response? </label>
								<div class="inp-field">
									<select class="" name="responding_time" required>
								
										<option value="" >Select</option>
										<option value="24 Hr" >24 Hr</option>
										<option value="3 Days" >3 Days</option>
										<option value="7 Days" >7 Days</option>
										<option value="15 Days" >15 Days</option>
										<option value="30 Days" >30 Days</option>
									
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<ul>
								  @auth
									<li><button class="active" type="submit" value="post" id="save_r" >Post</button></li>
								  @else
								    <li><a href="{{route('login')}}" class="active" type="button" value="post">Post</a></li>
								  @endauth
									<!--<li><a href="#" title="">Cancel</a></li>-->
								</ul>
							</div>
						</div>
					</form>
				</div><!--post-project-fields end-->
				<a href="#" title=""><i class="la la-times-circle-o"></i></a>
			</div><!--post-project end-->
		</div><!--post-a-requirement-popup end-->
    <!-- Post a requirement -->

	<!--Talk to advisor modal-->
	<div class="modal fade" id="talkToadvisorModal" tabindex="-1" role="dialog" aria-labelledby="talkToAdvisorModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="talkToAdvisorModalLabel">Talk to Advisor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="request-form">
                @csrf
                    <input type="hidden" value="" id="advisor_id" name="advisor_id">
                    <input type="hidden" value="" id="user_id" name="user_id">
                    <input type="hidden" value="" id="lead_type" name="lead_type" >
                    <input type="hidden" value="" id="listing_id" name="listing_id">
                
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Write about your requirement</label>
                    <textarea class="form-control" id="message-text" name="requirement" placeholder="Write about your requirement" required></textarea>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Lead Expire Date:</label>
                    <input type="date" class="form-control" id="lead_expire_date" value="<?php echo date('Y-m-d') ?>" min="<?php echo date('Y-m-d') ?>"  name="lead_expire_date" required>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Lead Expire Time :</label>
                    <input type="time" class="form-control" id="lead_expire_time" min=""  name="lead_expire_time" required>
                </div>
            
          </div>
          <div class="modal-footer">
            <!--<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>-->
            <button type="submit" class="btn btn-sm submit" style="background-color:#008069;color:#fff;">Send request</button>
          </div>
          </form>
        </div>
      </div>
    </div>
	<!--Talk to advisor modal-->
	
	<nav class="mobile-nav pt-2">
         <a type="button" href="{{route('index')}}" class="bloc-icon">
             
             <center><i class="fa fa-home fa-2x theme-color"></i></center>
             <p class="text-muted">Home</p>
         </a>
         <a type="button" type="button" href="#" class="post_project bloc-icon" >
             
             <center><i class="fa fa-edit fa-2x theme-color"></i></center>
             <p class="text-muted">Post Requirement</p>
         </a>
         <a type="button" href="{{route('advisory')}}" class="bloc-icon">
             
             <center><i class="fa fa-user-circle fa-2x theme-color"></i></center>
             <p class="text-muted">Advisory</p>
             
         </a>
         <!--<a type="button" href="#" class="bloc-icon">
             
             <center><i class="fa fa-bell-o fa-2x theme-color"></i></center>
             <p class="text-muted">Notification</p>
             
         </a>-->
        
        <div class="btn-group dropup">
          <a href="#" type="button" class="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <center><i class="fa fa-bell-o fa-2x theme-color"></i></center>
             @auth
			  @php
				  $new_notif = App\Models\Notification::where('entity_id',Auth::user()->id)->where('entity_type',session()->get('type'))->where('seen_status',0)->count();
			  @endphp
			  @if($new_notif > 0)
				<span class="badge badge-danger footer-notif" data-tooltip="{{$new_notif}} New Messages." data-tooltip-position="right">{{$new_notif}}</span>
			  @endif
			@endauth
             <p class="text-muted">Notification</p>
          </a>
          <div class="dropdown-menu">
            @auth
                @php 
    			    $notif = App\Models\Notification::where('entity_id',Auth::user()->id)->where('entity_type',session()->get('type'))->where('seen_status',0)->latest()->get();
    		 
    		    @endphp
    		    @if($notif->isNotEmpty())
    		    @foreach($notif as $n)
                  
                    <a class="dropdown-item" href="javascript:void(0)" onclick="seen_notification({{$n->id}},'{{url($n->link)}}');">{{$n->notification}}</a>
                    <p class="float-right">{{getTimeAgo($n->created_at)}}</p>
                    <hr>
                @endforeach
                @else
                    <a class="dropdown-item" href="javascript:void(0)">No notification found.</a>
                @endif
            @else
                <a class="dropdown-item" href="javascript:void(0)">No notification found.</a>
            @endif
          </div>
        </div>
         
        <div class="btn-group dropup">
          <a href="#" type="button" class="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <center><i class="fa fa-ellipsis-v fa-2x theme-color"></i></center>
            <p class="text-muted">Others</p>
          </a>
          <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('requirements')}}">Leads(Requirements)</a>
                <a class="dropdown-item" href="{{route('all.advisors')}}">Live Advisors</a>
                <a class="dropdown-item" href="{{route('all.advisors')}}">Top Advisors</a>
                <a class="dropdown-item" href="{{route('categories')}}">Top Categories</a>
          </div>
        </div>
  
    </nav>
    
   
    <script type="text/javascript" src="{{asset('front/js/popper.js')}}"></script>
    <script type="text/javascript" src="{{asset('front/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('front/js/jquery.mCustomScrollbar.js')}}"></script>
    <script type="text/javascript" src="{{asset('front/js/slick.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('front/js/scrollbar.js')}}"></script>
    <script type="text/javascript" src="{{asset('front/js/script.js')}}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

     <!--toastr js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

     <!--select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.js"></script>
    
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>

    <script>
        /* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
        function myFunction() {
          document.getElementById("myDropdown").classList.toggle("show");
        }
        
        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
          if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
              var openDropdown = dropdowns[i];
              if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
              }
            }
          }
        }
    </script>
    <script>
    $(document).ready(function(){
        /*-----------------Create Advisory Request--------------------*/
        $('.request-form').validate({ 
           
           submitHandler: function(form) 
          { 
              $(".submit").attr("disabled", true);
              $.ajax({
                  url: "{{route('send_advisory_request')}}", 
                  type: "POST",             
                  data: $(form).serialize(),
                  cache: false,             
                  processData: false, 
                  dataType: "json", 
                  success: function(data) 
                  {
                     if(data.status){
                         toastr.success("Success!", data.message);
                               
                        setTimeout(function(){ 
                           window.location.href = "{{route('profile')}}";
                         }, 1000);
                     }else{
                         toastr.error("Opps!", data.message);
                               
                     }
                  }
              });
              return false;
          },
       });
    });

        
        /*var unloaded = false;
        $(window).on('beforeunload', unload);
        $(window).on('unload', unload);  
        function unload(){    
            let id = "{{Auth::user()->id ?? ''}}";
            if(!unloaded){
                $('body').css('cursor','wait');
                $.ajax({
                    type: 'get',
                    async: false,
                    url: '{{url("session-close/")}}'+id,
                    success:function(){ 
                        unloaded = true; 
                        $('body').css('cursor','default');
                    },
                    timeout: 5000
                });
            }
        }*/

    
        // Wait for window load
    	$(window).load(function() {
    		// Animate loader off screen
    		$(".se-pre-con").fadeOut("slow");;
    	});
    
        /*----success/error toastr-------*/
            toastr.options.timeOut = 3000;
            @if (Session::has('error'))
                toastr.error("{{ Session::get('error') }}");
            @elseif(Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
            @endif


			/* SELECT2 multiple */
			
              
              $('select').select2().select2();
              
            
			/* SELECT2 multiple */

			/* In Notification Box Notification & Interested/Not Interested */
			function seen_notification(notification_id,link,type=null,status=null){
				// alert(status);
				$.ajax({
					url : "{{route('update.notification')}}",
					type:"post",
					data:{notification_id:notification_id,link:link,type:type,status:status,_token:"{{csrf_token()}}"},
					success:function(response){
						if(response.status == true){
				        // toastr.success("Success!", response.message);
							window.location.href=link;
						}else{
				        // toastr.error("Error!", response.message);
							location.reload();
						}
					}
				})
			}


			function interestedOrNot(activity_id,link,type=null,status=null)
			{   
				$.ajax({
					url : "{{route('interested_or_not')}}",
					type:"post",
					data:{activity_id:activity_id,link:link,type:type,status:status,_token:"{{csrf_token()}}"},
					success:function(response){
						if(response.status == true){
							toastr.success("Success!", response.message);
							window.location.href=link;
						}else{
							toastr.error("Error!", response.message);
							location.reload();
						}
					}
				})
			}
			
			
			/*--------------Talk to advisor----------------*/
            function talkToAdvisor(advisor_id,user_id,lead_type,listing_id=null){
            
                $("#advisor_id").val(advisor_id);
                $("#user_id").val(user_id);
                $("#lead_type").val(lead_type);
                $("#listing_id").val(listing_id);
            }
			
		
    </script>

    
    @stack('js')

    </body>

</html>