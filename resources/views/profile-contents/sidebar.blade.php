<div class="col-lg-3">
    <div class="main-left-sidebar">
        <div class="user_profile">
            <div class="user-pro-img">
                @php $image = Auth::user()->image; @endphp @if(Auth::user()->image !== null)
                <!--<a data-fancybox data-type="image" href='{{asset("front/images/users/$image")}}'>
                    <img src='{{asset("front/images/users/$image")}}' alt="" height="210px" />
                </a>-->
                 <img src='{{asset("front/images/users/$image")}}' alt="" height="210px" />
                @else
                <!--<a data-fancybox data-type="image" href='{{asset("front/images/users/image.jpg")}}'>
                    <img src='{{asset("front/images/users/image.jpg")}}' alt="" height="210px" />
                </a>-->
                 <img src='{{asset("front/images/users/$image")}}' alt="" height="210px" />
                @endif

                <a href="javascript:void(0)" id="image" title=""><i class="fa fa-camera"></i></a>
                <input type="file" id="my_file" style="display: none;" data-id="{{Auth::user()->id}}" />
                <br/>
                <small style="color:red;">Note: Profile Picture Size Should be 250*250</small>
            </div>
            <!--user-pro-img end-->
            <div class="user_pro_status">
                <ul class="flw-status">
                    <li>
                        <span>Following</span>
                        <b>{{$following}}</b>
                    </li>
                    <li>
                        <span>Followers</span>
                        <b>{{$follower}}</b>
                    </li>
                </ul>
            </div>
            <!--user_pro_status end-->
            <div class="tab-feed st2">
                <ul class="social_links myTabs" id="myTab">
                    <li data-toggle="tab" data-tab="info-dd" class="animated fadeIn">
                        <a href="#info-dd-ss" >My Profile</a>
                    </li>
                    @if(\Session::get('type') == 'User')
                    <li data-toggle="tab" data-tab="letsconnect-dd" class="animated fadeIn">
                        <a href="#letsconnect-dd-ss">Let's Connect</a>
                    </li>
                    <!--<li data-toggle="tab" data-tab="complain-dd" class="animated fadeIn">
                        <a href="#complain-dd-ss" >Complain's</a>
                    </li>-->
                    <li data-toggle="tab" data-tab="myrequirments-dd" class="animated fadeIn">
                        <a href="#myrequirments-dd-ss" >My Requirements</a>
                    </li>
                    @elseif(\Session::get('type') == 'Advisor')
                    <li data-toggle="tab" data-tab="business-dd" class="animated fadeIn">
                        <a href="#business-dd-ss" >My Business Profile</a>
                    </li>
                    <li data-toggle="tab" data-tab="advisory-listing-dd" class="animated fadeIn">
                        <a href="#advisory-listing-dd-ss" >My Advisory Listing</a>
                    </li>
                    <li data-toggle="tab" data-tab="myleads-dd" class="animated fadeIn">
                        <a href="#myleads-dd-ss" >My Leads</a>
                    </li>
                    <li data-toggle="tab" data-tab="myposts-dd" class="animated fadeIn">
                        <a href="#myposts-dd-ss" >My Posts</a>
                    </li>
                    <!--<li data-toggle="tab" data-tab="myscorecard-dd" class="animated fadeIn">
                        <a href="#myscorecard-dd-ss" >My Score card</a>
                    </li>-->
                    <li data-toggle="tab" data-tab="advisory-report-dd" class="animated fadeIn">
                        <a href="#advisory-report-dd-ss" >My Advisory Report</a>
                    </li>
                    @endif

                </ul>
            </div>
        </div>
        <!--user_profile end-->
    </div>
</div>
