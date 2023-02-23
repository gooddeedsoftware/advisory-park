<div class="user-tab-sec">
    <h2>{{Auth::user()->name}}
        <a href="#" title="" class="theme-color" style="font-size:20px">{{Auth::user()->advisory_park_id}}</a>
    </h2>
    <div class="star-descp">
        <p>Joined Since {{Auth::user()->created_at->diffForHumans()}}</p>
        <ul class="mr-3">
            <li><i class="fa fa-star theme-color"></i></li>
            <li><i class="fa fa-star theme-color"></i></li>
            <li><i class="fa fa-star theme-color"></i></li>
            <li><i class="fa fa-star-half-o theme-color"></i></li>
            <li><i class="fa fa-star-o theme-color"></i></li>
        </ul>
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
    <!--star-descp end-->

    <div class="tab-feed st2">
        <ul class="myTabs">
            <li data-toggle="tab" data-tab="info-dd" class="animated fadeIn">
                <a href="#" title="" class="true">
                    <img src="{{asset('front/images/ic2.png')}}" alt="" />
                    <span>Info</span>
                </a>
            </li>
            <li data-toggle="tab" data-tab="feed-dd" class="animated fadeIn">
                <a href="#" title="">
                    <img src="{{asset('front/images/ic1.png')}}" alt="" />
                    <span>Feed</span>
                </a>
            </li>
            <li data-toggle="tab" data-tab="saved-jobs" class="animated fadeIn">
                <a href="#" title="">
                    <img src="{{asset('front/images/ic4.png')}}" alt="" />
                    <span>Saved Post</span>
                </a>
            </li>
           <!-- <li data-toggle="tab" data-tab="my-bids">
                <a href="#" title="">
                    <img src="{{asset('front/images/ic5.png')}}" alt="" />
                    <span>My Bids</span>
                </a>
            </li>
            <li data-toggle="tab" data-tab="portfolio-dd">
                <a href="#" title="">
                    <img src="{{asset('front/images/ic3.png')}}" alt="">
                    <span>Portfolio</span>
                </a>
            </li>-->
            @if(\Session::get('type') == 'Advisor')
            <li data-toggle="tab" data-tab="payment-dd" class="animated fadeIn">
                <a href="#" title="">
                    <img src="{{asset('front/images/ic6.png')}}" alt="" />
                    <span>Payment</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
    <!-- tab-feed end-->
</div>
