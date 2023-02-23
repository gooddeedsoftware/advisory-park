
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Advisory Park</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link rel="stylesheet" type="text/css" href="{{asset('front/css/animate.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('front/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('front/css/line-awesome.css')}}">
        <!--<link rel="stylesheet" type="text/css" href="{{asset('front/css/line-awesome-font-awesome.min.css')}}">-->
        <!--<link rel="stylesheet" type="text/css" href="{{asset('front/css/font-awesome.min.css')}}">-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"  />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"  />
        <link rel="stylesheet" type="text/css" href="{{asset('front/css/slick.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('front/css/slick-theme.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('front/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('front/css/responsive.css')}}">
    </head>


    <body class="sign-in">
	

	    <div class="wrapper">
		

		    <div class="sign-in-page" style="background:#008069">
    			<div class="signin-popup">
    				<div class="signin-pop">
    					<div class="row">
    						<div class="col-lg-6">
    							<div class="cmp-info">
    								<div class="cm-logo">
    									<!--<img src="{{asset('front/images/cm-logo.png')}}" alt="">-->
    									<!--<h2>Advisory Park</h2>-->
    									<img src="{{asset('front/images/logo.png')}}" style="height: 50px;background: #008069;margin: 1rem;padding: 2px;" alt="">
    									<p>Advisory Park,  is a global freelancing platform and social networking where businesses and independent professionals connect and collaborate remotely</p>
    								</div><!--cm-logo end-->	
    								<!--<img src="{{asset('front/images/cm-main-img.png')}}" alt="">			-->
    								<img src="#" alt="">			
    							</div><!--cmp-info end-->
    						</div>
    						<div class="col-lg-6">
    							<div class="login-sec">
    								<ul class="sign-control">
    									<li data-tab="tab-1" class="current"><a href="#" title="">Sign in</a></li>				
    									<li data-tab="tab-2"><a href="#" title="">Sign up</a></li>				
    								</ul>
    								
    								<div class="sign_in_sec current" id="tab-1">
    									
    									<h3>Sign in</h3>
    									
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
    									
    									<form method="post" action="{{route('login.post')}}">
    									    @csrf
    										<div class="row">
    											<div class="col-lg-12 no-pdd">
    												<div class="sn-field">
    													<input type="text" name="email" placeholder="Email address" required>
    													<i class="la la-user"></i>
    												</div><!--sn-field end-->
    											</div>
    											<div class="col-lg-12 no-pdd">
    												<div class="sn-field">
    													<input type="password" name="password" placeholder="Password" required>
    													<i class="la la-lock"></i>
    												</div>
    											</div>
    											<div class="col-lg-12 no-pdd d-none">
    											   
    												<div class="sn-field">
    										            <label>Login as :<span class="text-danger">*</span></label>
    										            <input type="radio" class="" name="type" value="User" style="height:10px;width:7%" required checked>
    										            <label class="p-1">User</label> 
    										            <!--<input type="radio" class="" name="type" value="Advisor" style="height:10px;width:7%" required>
    										            <label class="p-1">Advisor</label>-->
    										        </div>
    											</div>
    											<div class="col-lg-12 no-pdd">
    												<div class="checky-sec">
    													<div class="fgt-sec">
    														<input type="checkbox" name="remember" id="c1">
    														<label for="c1">
    															<span></span>
    														</label>
    														<small>Remember me</small>
    													</div><!--fgt-sec end-->
    													<a href="#" title="">Forgot Password?</a>
    												</div>
    											</div>
    											<div class="col-lg-12 no-pdd">
    												<button type="submit" value="submit">Sign in</button>
    											</div>
    										</div>
    									</form>
    									<div class="login-resources">
    										<!--<h4>Login Via Social Account</h4>-->
    										<ul>
    											<!--<li><a href="#" title="" class="fb"><i class="fa fa-facebook"></i>Login Via Facebook</a></li>-->
    											<li><a href="{{ url('google') }}" title="" class="">
    											        <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png">
    											    </a>
    											</li>
    										</ul>
    									</div>
    								</div>
    								<div class="sign_in_sec" id="tab-2">
    									<!--<div class="signup-tab">
    										<i class="fa fa-long-arrow-left"></i>
    										<h2>johndoe@example.com</h2>
    										<ul>
    											<li data-tab="tab-3" class="current"><a href="#" title="">Sign up</a></li>
    											<li data-tab="tab-4"><a href="#" title="">Company</a></li>
    										</ul>
    									</div>-->
    									<h3>Sign in</h3>
    									
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
    									
    									<div class="dff-tab current" id="tab-3">
    										<form method="post" action="{{route('register.post')}}">
    										    @csrf
    											<div class="row">
    												<div class="col-lg-12 no-pdd">
    													<div class="sn-field">
    														<input type="text" name="name" placeholder="Full Name" required>
    														<i class="la la-user"></i>
    													</div>
    												</div>
    											    <div class="col-lg-12 no-pdd">
    													<div class="sn-field">
    														<input type="text" name="email" placeholder="Email" required>
    														<i class="la la-envelope"></i>
    													</div>
    												</div>
    											<!--<div class="col-lg-12 no-pdd">
    													<div class="sn-field">
    														<select>
    															<option>Category</option>
    														</select>
    														<i class="la la-dropbox"></i>
    														<span><i class="fa fa-ellipsis-h"></i></span>
    													</div>
    												</div>-->
    												<div class="col-lg-12 no-pdd">
    													<div class="sn-field">
    														<input type="password" name="password" placeholder="Password" required>
    														<i class="la la-lock"></i>
    													</div>
    												</div>
    												<div class="col-lg-12 no-pdd">
    													<div class="sn-field">
    														<input type="password" name="confirm_password" placeholder="Repeat Password" required>
    														<i class="la la-lock"></i>
    													</div>
    												</div>
    												<div class="col-lg-12 no-pdd">
    													<div class="checky-sec st2">
    														<div class="fgt-sec">
    															<input type="checkbox" name="cc" id="c2">
    															<label for="c2">
    																<span></span>
    															</label>
    															<small>Yes, I understand and agree to the advisory park Terms & Conditions.</small>
    														</div><!--fgt-sec end-->
    													</div>
    												</div>
    												<div class="col-lg-12 no-pdd">
    													<button type="submit" value="submit">Get Started</button>
    												</div>
    											</div>
    										</form>
    									</div><!--dff-tab end-->
    								
    								</div>		
    							</div><!--login-sec end-->
    						</div>
    					</div>		
    				</div><!--signin-pop end-->
    			</div><!--signin-popup end-->
    			<div class="footy-sec">
    				<div class="container">
    					<ul>
    						<li><a href="#" title="">Help Center</a></li>
    						<li><a href="#" title="">Privacy Policy</a></li>
    						<!--<li><a href="#" title="">Community Guidelines</a></li>-->
    						<!--<li><a href="#" title="">Cookies Policy</a></li>-->
    						<!--<li><a href="#" title="">Career</a></li>-->
    						<!--<li><a href="#" title="">Forum</a></li>-->
    						<!--<li><a href="#" title="">Language</a></li>-->
    						<li><a href="#" title="">Copyright Policy</a></li>
    					</ul>
    					<p><img src="{{asset('front/images/copy-icon.png')}}" alt="">Copyright {{date('Y')}}</p>
    				</div>
    			</div><!--footy-sec end-->
    		</div><!--sign-in-page end-->


	</div><!--theme-layout end-->



<script type="text/javascript" src="{{asset('front/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front/js/popper.js')}}"></script>
<script type="text/javascript" src="{{asset('front/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front/js/slick.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front/js/script.js')}}"></script>
</body>
</html>