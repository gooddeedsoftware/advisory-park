@extends('layout.app')

@section('content')
		
		<main>
			<div class="main-section">
				<div class="container">
					<div class="main-section-data">
						<div class="row">
							<div class="col-lg-3 navWrap">
								<div class="filter-secs">
								    <!--<a href="{{route('requirements')}}" title="">Clear</a>-->
								    @foreach($field as $f)
								    <a href="{{route('requirements')}}?field={{$f->id}}" class="filter-heading {{ (request()->get('field') == $f->id) ? 'theme-bg text-light' : 'text-dark' }}" style="padding-top: 15px;padding-bottom: 15px;margin-bottom:0px">
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
                        					   
                        						 <input class="typeahead form-control" placeholder="Search Requirements..." id="search" type="text" name="search">
                        			        
                        					</form>
                        				</div>
                        			</div>
                        		</div>
								<div class="main-ws-sec">
									<div class="posts-section" id="post-data">
									    @include('requirement-data')

									    <div class="ajax-load text-center" style="display:none">
											<i class="fa fa-48px fa-spin fa-spinner"></i> Loading ...
										</div>
									
									</div>
								</div>
							</div>
							
						</div>
					</div>
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
	<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        var page = 1;
    	$(window).scroll(function() {
    	    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
    	        page++;
    	        loadMoreData(page);
    	    }
    	});
    
    	function loadMoreData(page){
    	  $.ajax(
    	        {
    	            url: '?page=' + page,
    	            type: "get",
    	            beforeSend: function()
    	            {
    	                $('.ajax-load').show();
    	            }
    	        })
    	        .done(function(data)
    	        {	
					console.log(data.html);
    	            if(data.html == " "){
    	                $('.ajax-load').html("No more records found.");
    	                return;
    	            }
    	            $('.ajax-load').hide();
    	            $("#post-data").append(data.html);
    	        })
    	        .fail(function(jqXHR, ajaxOptions, thrownError)
    	        {
    	              toastr.error('server not responding...');
    	        });
    	}
    </script>
    <script>

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
      

        /*-----Autocomplete Search----*/
        $( "#search" ).autocomplete({
            source: function( request, response ) {
            $.ajax({
                url: "{{route('autocomplete.requirement')}}",
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