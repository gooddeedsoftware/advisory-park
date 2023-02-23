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
    
    .wrap {
    	width: 250px;
    	height: 50px;
    	background: #fff;
    	position: absolute;
    	top: 50%;
    	left: 50%;
    	transform: translate(-50%,-50%);
    	border-radius: 10px;
    }
    .stars {
    	width: fit-content;
    	margin: 0 auto;
    	cursor: pointer;
    }
    .star {
    	color: #91a6ff !important;
    }
    .rate {
    	height: 50px;
    	margin-left: -5px;
    	padding: 5px;
    	font-size: 25px;
    	position: relative;
    	cursor: pointer;
    }
    .rate input[type="radio"] {
    	opacity: 0;
    	position: absolute;
    	top: 50%;
    	left: 50%;
    	transform: translate(-50%,0%);
    	pointer-events: none;
    }
    .star-over::after {
    	font-family: 'Font Awesome 5 Free';
      font-weight: 900;
    	font-size: 16px;
    	content: "\f005";
    	display: inline-block;
    	color: #d3dcff;
    	z-index: 1;
    	position: absolute;
    	top: 17px;
    	left: 10px;
    }
    
    .rate:nth-child(1) .face::after {
    	content: "\f119"; /* ☹ */
    }
    .rate:nth-child(2) .face::after {
    	content: "\f11a"; /* 😐 */
    }
    .rate:nth-child(3) .face::after {
    	content: "\f118"; /* 🙂 */
    }
    .rate:nth-child(4) .face::after {
    	content: "\f580"; /* 😊 */
    }
    .rate:nth-child(5) .face::after {
    	content: "\f59a"; /* 😄 */
    }
    .face {
    	opacity: 0;
    	position: absolute;
    	width: 35px;
    	height: 35px;
    	background: #91a6ff;
    	border-radius: 5px;
    	top: -50px;
    	left: 2px;
    	transition: 0.2s;
    	pointer-events: none;
    }
    .face::before {
    	font-family: 'Font Awesome 5 Free';
      font-weight: 900;
    	content: "\f0dd";
    	display: inline-block;
    	color: #91a6ff;
    	z-index: 1;
    	position: absolute;
    	left: 9px;
    	bottom: -15px;
    }
    .face::after {
    	font-family: 'Font Awesome 5 Free';
      font-weight: 900;
    	display: inline-block;
    	color: #fff;
    	z-index: 1;
    	position: absolute;
    	left: 5px;
    	top: -1px;
    }
    
    .rate:hover .face {
    	opacity: 1;
    }

    #DataTables_Table_5_wrapper .dataTable, #DataTables_Table_5_wrapper .dataTables_scrollHeadInner {
        width: 100% !important;
    }

</style>
@endpush

@section('content')
	<section class="cover-sec">
		@php $cover_image = Auth::user()->cover_image; @endphp
		@if(Auth::user()->cover_image !== null)
		<img src='{{asset("front/images/users/$cover_image")}}' alt="" height="375px">
		@else
		<img src="https://via.placeholder.com/1600x400" alt="" height="375px">
		@endif
		<a href="javascript:void(0)" id="cover" title=""><i class="fa fa-camera"></i> Change Cover</a>
		<input type="file" id="my_cover" style="display: none;" data-id="{{Auth::user()->id}}" />
	</section>


	<main>
		<div class="main-section">
			<div class="container">
				<div class="main-section-data">
					<div class="row">
						<!-- User Tabs sidebar -->
						@include('profile-contents.sidebar') 
						<!-- User Tabs sidebar -->

						<div class="col-lg-9">
							<div class="main-ws-sec">
								<!-- Tabs option for tab -->
								@include('profile-contents.tabs-options') 
								<!-- Tabs option for tab -->

								<!-- Info dd -->
								@include('tabs.info-tab') 
								<!-- Info dd -->
								
								<!-- Feed dd -->
								@include('tabs.feeds-tab') 
								<!-- Feed dd -->
								
								<!-- saved jobs -->
								@include('tabs.saved-jobs-tab') 
								<!-- Saved jobs -->
								
								<!-- My bids -->
								<!--@include('tabs.my-bids-tab') -->
								<!-- My bids -->
								
								<!-- payement dd -->
								@include('tabs.payment-tab') 
								<!-- payement dd -->
								
								<!-- Business Ad -->
								@include('tabs.business-tab') 
								<!-- Business Ad -->
								
								<!-- Advisory listing add -->
								@include('tabs.advisory-listing-tab') 
								<!-- Advisory listing add -->
								
								<!-- my leads -->
								@include('tabs.myleads-tab') 
								<!-- my leads -->
								
								<!-- My requirments -->
								@include('tabs.myrequirments-tab') 
								<!-- My requirments -->
								
								<!-- lets connect -->
								@include('tabs.letsconnect-tab') 
								<!-- lets connect -->
								
								<!-- my posts -->
								@include('tabs.myposts-tab') 
								<!-- my posts -->
								
								<!-- My score card -->
								@include('tabs.myscorecard-tab') 
								<!-- My score card -->
								
								<!-- Complains -->
								@include('tabs.complains-tab') 
								<!-- Complains -->
								
								<!-- Advisory Report -->
								@include('tabs.advisory-report-tab') 
								<!-- Advisory Report -->
								
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
	
	<!----------------------- Advisory Payment Modal ----------------------->
	@include('modals.advisory-payment-modal')
	<!----------------------- Advisory Payment Modal ----------------------->
		
@endsection
@push('js')
	<!-- PROFILE JS START -->
	@include('profile-contents.profile-js') 
	<!-- PROFILE JS END ---->
@endpush