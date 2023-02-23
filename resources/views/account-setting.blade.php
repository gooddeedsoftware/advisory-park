@extends('layout.app')
@section('content')
		<section class="profile-account-setting" style="height:710px;">
			<div class="container">
				<div class="account-tabs-setting">
					<div class="row">
						<div class="col-lg-3">
							<div class="acc-leftbar">
								<div class="nav nav-tabs" id="nav-tab" role="tablist">
								    <!--<a class="nav-item nav-link active" id="nav-acc-tab" data-toggle="tab" href="#nav-acc" role="tab" aria-controls="nav-acc" aria-selected="true"><i class="la la-cogs"></i>Account Setting</a>-->
								    <!--<a class="nav-item nav-link" id="nav-status-tab" data-toggle="tab" href="#nav-status" role="tab" aria-controls="nav-status" aria-selected="false"><i class="fa fa-line-chart"></i>Status</a>-->
								    <a class="nav-item nav-link" id="nav-password-tab" data-toggle="tab" href="#nav-password" role="tab" aria-controls="nav-password" aria-selected="false"><i class="fa fa-lock"></i>Change Password</a>
								    <a class="nav-item nav-link" id="nav-notification-tab" data-toggle="tab" href="#nav-notification" role="tab" aria-controls="nav-notification" aria-selected="false"><i class="fa fa-bell-o"></i>Notifications</a>
								    <a class="nav-item nav-link" id="nav-requests-tab" data-toggle="tab" href="#nav-requests" role="tab" aria-controls="nav-requests" aria-selected="false"><i class="fa fa-group"></i>Requests</a>
								    <!--<a class="nav-item nav-link" id="security-login" data-toggle="tab" href="#security-login" role="tab" aria-controls="security-login" aria-selected="false"><i class="fa fa-user-secret"></i>Security and Login</a>-->
								    <!--<a class="nav-item nav-link" id="privacy" data-toggle="tab" href="#privacy" role="tab" aria-controls="privacy" aria-selected="false"><i class="fa fa-paw"></i>Privacy</a>-->
								    <!--<a class="nav-item nav-link" id="blockking" data-toggle="tab" href="#blockking" role="tab" aria-controls="blockking" aria-selected="false"><i class="fa fa-cc-diners-club"></i>Blocking</a>-->
								    <a class="nav-item nav-link" id="nav-deactivate-tab" data-toggle="tab" href="#nav-deactivate" role="tab" aria-controls="nav-deactivate" aria-selected="false"><i class="fa fa-random"></i>Deactivate Account</a>
								  </div>
							</div><!--acc-leftbar end-->
						</div>
						<div class="col-lg-9">
							<div class="tab-content" id="nav-tabContent">
								<!--<div class="tab-pane fade " id="nav-acc" role="tabpanel" aria-labelledby="nav-acc-tab">
									<div class="acc-setting">
										<h3>Account Setting</h3>
										<form>
											<div class="notbar">
												<h4>Notification Sound</h4>
												<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus pretium nulla quis erat dapibus, varius hendrerit neque suscipit. Integer in ex euismod, posuere lectus id</p>
												<div class="toggle-btn">
													<a href="#" title=""><img src="images/up-btn.png" alt=""></a>
												</div>
											</div>
											<div class="notbar">
												<h4>Notification Email</h4>
												<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus pretium nulla quis erat dapibus, varius hendrerit neque suscipit. Integer in ex euismod, posuere lectus id</p>
												<div class="toggle-btn">
													<a href="#" title=""><img src="images/up-btn.png" alt=""></a>
												</div>
											</div>
											<div class="notbar">
												<h4>Chat Message Sound</h4>
												<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus pretium nulla quis erat dapibus, varius hendrerit neque suscipit. Integer in ex euismod, posuere lectus id</p>
												<div class="toggle-btn">
													<a href="#" title=""><img src="images/up-btn.png" alt=""></a>
												</div>
											</div>
											<div class="save-stngs">
												<ul>
													<li><button type="submit">Save Setting</button></li>
													<li><button type="submit">Restore Setting</button></li>
												</ul>
											</div>
										</form>
									</div>
								</div>
							  	<div class="tab-pane fade " id="nav-status" role="tabpanel" aria-labelledby="nav-status-tab">
							  		<div class="acc-setting">
							  			<h3>Profile Status</h3>
							  			<div class="profile-bx-details">
							  				<div class="row">
							  					<div class="col-lg-3 col-md-6 col-sm-12">
							  						<div class="profile-bx-info">
							  							<div class="pro-bx">
							  								<img src="images/pro-icon1.png" alt="">
							  								<div class="bx-info">
							  									<h3>₹ 5,145</h3>
							  									<h5>Total Income</h5>
							  								</div>
							  							</div>
							  							<p>Lorem ipsum dolor sit amet, consectetur adipiscing.</p>
							  						</div>
							  					</div>
							  					<div class="col-lg-3 col-md-6 col-sm-12">
							  						<div class="profile-bx-info">
							  							<div class="pro-bx">
							  								<img src="images/pro-icon2.png" alt="">
							  								<div class="bx-info">
							  									<h3>₹ 4,745</h3>
							  									<h5>Widthraw</h5>
							  								</div>
							  							</div>
							  							<p>Lorem ipsum dolor sit amet, consectetur adipiscing.</p>
							  						</div>
							  					</div>
							  					<div class="col-lg-3 col-md-6 col-sm-12">
							  						<div class="profile-bx-info">
							  							<div class="pro-bx">
							  								<img src="images/pro-icon3.png" alt="">
							  								<div class="bx-info">
							  									<h3>₹ 1,145</h3>
							  									<h5>Sent</h5>
							  								</div>
							  							</div>
							  							<p>Lorem ipsum dolor sit amet, consectetur adipiscing.</p>
							  						</div>
							  					</div>
							  					<div class="col-lg-3 col-md-6 col-sm-12">
							  						<div class="profile-bx-info">
							  							<div class="pro-bx">
							  								<img src="images/pro-icon4.png" alt="">
							  								<div class="bx-info">
							  									<h3>130</h3>
							  									<h5>Total Projects</h5>
							  								</div>
							  							</div>
							  							<p>Lorem ipsum dolor sit amet, consectetur adipiscing.</p>
							  						</div>
							  					</div>
							  				</div>
							  			</div>
							  			<div class="pro-work-status">
							  				 <h4>Work Status  -  Last Months Working Status</h4> 
							  			</div>
							  		</div>
							  	</div>-->
							  	<div class="tab-pane fade show active" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
							  		<div class="acc-setting">
										<h3>Change Password</h3>
										@if(session('error'))
                                            <div class="alert alert-danger" role="alert">{{session('error')}}</div>
                                        @elseif(session('success'))
                                            <div class="alert alert-success" role="alert">{{session('success')}}</div>
                                        @endif
                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                          <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                          </ul>
                                        </div>
                                        @endif
										<form method="post" action="{{route('change.password.post')}}">
										    @csrf
											<div class="cp-field">
												<h5>Old Password</h5>
												<div class="cpp-fiel">
													<input type="password" name="current_password" placeholder="Old Password">
													<i class="fa fa-lock"></i>
												</div>
											</div>
											<div class="cp-field">
												<h5>New Password</h5>
												<div class="cpp-fiel">
													<input type="password" name="new_password" placeholder="New Password">
													<i class="fa fa-lock"></i>
												</div>
											</div>
											<div class="cp-field">
												<h5>Repeat Password</h5>
												<div class="cpp-fiel">
													<input type="password" name="confirm_password" placeholder="Repeat Password">
													<i class="fa fa-lock"></i>
												</div>
											</div>
										<!--	<div class="cp-field">
												<h5><a href="#" title="">Forgot Password?</a></h5>
											</div>-->
											<div class="save-stngs pd2">
												<ul>
													<li><button type="submit">Save Setting</button></li>
													<!--<li><button type="submit">Restore Setting</button></li>-->
												</ul>
											</div><!--save-stngs end-->
										</form>
									</div><!--acc-setting end-->
							  	</div>
							  	<div class="tab-pane fade" id="nav-notification" role="tabpanel" aria-labelledby="nav-notification-tab">
							  		<div class="acc-setting">
							  			<h3>Notifications</h3>
							  			<div class="notifications-list">
							  				@if($notifications->isNotEmpty()) 
							  				  @foreach($notifications as $v) 
							  				  <div class="notfication-details"> 
							  				    <div class="noty-user-img"> 
							  				      <img src="http://via.placeholder.com/35x35" alt=""> 
							  				    </div> 
							  				    <div class="notification-info"> 
							  				        <h3>{{$v->notification}}</h3> 
							  				        <span>{{getTimeAgo($v->created_at)}}</span> 
							  				    </div> 
							  			      </div> 
							  			     @endforeach 
							  			    @else 
							  			        <center><h4>No New Notifications.</h4></center> 
							  			    @endif
							  				
							  			</div><!--notifications-list end-->
							  		</div><!--acc-setting end-->
							  	</div>
							  	<div class="tab-pane fade" id="nav-requests" role="tabpanel" aria-labelledby="nav-requests-tab">
							  		<div class="acc-setting">
							  			<h3>Requests</h3>
							  			<div class="requests-list">
							  				<div class="request-details">
							  					<div class="noty-user-img">
							  						<img src="http://via.placeholder.com/35x35" alt="">
							  					</div>
							  					<div class="request-info">
							  						<h3>Jessica William</h3>
							  						<span>Graphic Designer</span>
							  					</div>
							  					<div class="accept-feat">
							  						<ul>
							  							<li><button type="submit" class="accept-req">Accept</button></li>
							  							<li><button type="submit" class="close-req"><i class="la la-close"></i></button></li>
							  						</ul>
							  					</div><!--accept-feat end-->
							  				</div><!--request-detailse end-->
							  				
							  			</div><!--requests-list end-->
							  		</div><!--acc-setting end-->
							  	</div>
							  	<div class="tab-pane fade" id="nav-deactivate" role="tabpanel" aria-labelledby="nav-deactivate-tab">
							  		<div class="acc-setting">
										<h3>Deactivate Account</h3>
										<form>
											<div class="cp-field">
												<h5>Email</h5>
												<div class="cpp-fiel">
													<input type="text" name="email" placeholder="Email">
													<i class="fa fa-envelope"></i>
												</div>
											</div>
											<div class="cp-field">
												<h5>Password</h5>
												<div class="cpp-fiel">
													<input type="password" name="password" placeholder="Password">
													<i class="fa fa-lock"></i>
												</div>
											</div>
											<div class="cp-field">
												<h5>Please Explain Further</h5>
												<textarea></textarea>
											</div>
											<!--<div class="cp-field">
												<div class="fgt-sec">
													<input type="checkbox" name="cc" id="c4">
													<label for="c4">
														<span></span>
													</label>
													<small>Email option out</small>
												</div>
												<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus pretium nulla quis erat dapibus, varius hendrerit neque suscipit. Integer in ex euismod, posuere lectus id,</p>
											</div>-->
											<div class="de-activate pd3">
												<ul>
													<li><button type="submit" class="btn btn-danger">Deactivate</button></li>
													<!--<li><button type="submit">Restore Setting</button></li>-->
												</ul>
											</div><!--save-stngs end-->
										</form>
									</div><!--acc-setting end-->
							  	</div>
							</div>
						</div>
					</div>
				</div><!--account-tabs-setting end-->
			</div>
		</section>



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
					<p><img src="images/copy-icon2.png" alt="">Copyright 2018</p>
					<img class="fl-rgt" src="images/logo2.png" alt="">
				</div>
			</div>
		</footer>

		<!-- The Modal -->
		<div class="modal" id="myModal">
			<div class="modal-dialog">
			<div class="modal-content">
			
				<!-- Modal Header -->
				<div class="modal-header">
				<h4 class="modal-title">Reason for Decline Request</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				
				<!-- Modal body -->
				<div class="modal-body">
					<textarea name="reason_for_reject" class="form-control" id="reason" cols="30" rows="3" placeholder="Reason...."></textarea>
				</div>
				
				<!-- Modal footer -->
				<div class="modal-footer">
				<button type="button" class="btn btn-primary reason_save">Save</button>
				</div>
				
			</div>
			</div>
		</div>

@endsection
@push('js')
    <script>
        function reqAccept(_this,status,id){
           // alert(status);
            $.ajax({
                url:"{{route('change_status')}}",
                type:"POST",
                data:{status:status,_token:"{{csrf_token()}}",id:id},
                success:function(response){
                   if(response.status == true){
                      toastr.success("Success!", response.message);
                     _this.closest("div.request-details").remove();
                     
                   }else{
                       toastr.error("Opps!", response.message);
                   }
                }
            })
            
        }
        function reqClose(_this,status,id){
             //alert(status);
             $.ajax({
                url:"{{route('change_status')}}",
                type:"POST",
                data:{status:status,_token:"{{csrf_token()}}",id:id},
                success:function(response){
                   if(response.status == true){
                       toastr.error("Error!", response.message);
                       _this.closest("div.request-details").remove();
                   }else{
                       toastr.error("Opps!", response.message);
                   }
                }
            })
        }
		function reqClose(_this,status,id){
             //alert(status);
			$('#myModal').modal('show');
			$('.reason_save').click(function(){
				var reason = $('textarea#reason').val();
				if(!reason){
					alert('Reason is required!');
				}else{
					$.ajax({
						url:"{{route('change_status')}}",
						type:"POST",
						data:{status:status,_token:"{{csrf_token()}}",id:id,reason:reason},
						success:function(response){
							if(response.status == true){
								$('#myModal').modal('toggle');
								toastr.error("Opps!", response.message);
								_this.closest("div.request-details").remove();s
								location.reload();
							}else{
								$('#myModal').modal('toggle');
								toastr.error("Opps!", response.message);
								location.reload();
							}
						}
					})
				}
			})
        }
    </script>
@endpush