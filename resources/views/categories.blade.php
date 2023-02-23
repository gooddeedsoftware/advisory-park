@extends('layout.app')

@section('content')
	
		<section class="companies-info">
			<div class="container">
				<div class="company-title">
					<h3>Categories</h3>
				</div>
				<div class="companies-list">
					<div class="row">
					    @if(!empty($categories))
					     @foreach($categories as $data)
						    <div class="col-lg-3 col-md-4 col-sm-6">
    							<div class="company_profile_info">
    								<div class="company-up-info">
    									<!--<img src="http://via.placeholder.com/90x90" alt="">-->
    								    @if($data->icon)
    									    <a  href="{{route('field-wise-advisory')}}?field={{$data->id}}">
                                              <img src='{{$data->icon}}' alt="image" height="210px" />
                                            </a>
                                        @else
                                            <a data-fancybox data-type="image" href='{{asset("front/images/empty.png")}}'>
                                                <img src='{{asset("front/images/empty.png")}}' alt="image" height="210px" />
                                            </a>
                                        @endif
                        
    									<h3>{{$data->name}}</h3>
    									
                                    </div>
                                        
    							</div>
    						</div>
    					 @endforeach
						@else
						    <h4>Category not found!</h4>
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