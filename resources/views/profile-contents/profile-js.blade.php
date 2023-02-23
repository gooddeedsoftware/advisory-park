<script>
    /*----open comment box-------*/
    function openComment(id){
        // console.log(id);

        $('#comment-box-'+id).slideToggle();
    }

    $(document).ready(function(){
        var url = window.location.href;
        var activeTab = url.substring(url.indexOf("#") + 1);
        // $(".tab-pane").removeClass("active in");
        // $("#" + activeTab).addClass("active in");
        // $('a[href="#'+ activeTab +'"]').tab('show')

        $(".share").on('click',function(){
            $(".social-media-icons").fadeToggle();
        });
        
        /*---------My Profile--------------*/
        $('#profile-form').validate({
            rules: {
                name : {
                    required: true,
                    minlength: 5
                },
                gender: {
                    required: true,
                },
                country: {
                    required: true,
                },
                state: {
                    required: true,
                },
                city: {
                    required: true,
                },
                contact: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits: true
                },
                email: {
                    required: true,
                    email:true
                },
                advisory_minimum_charges: {
                    required: true,
                },
                work_status: {
                    required: true,
                },
                skills: {
                    required: true,
                },
                
            },
            messages: {
                name : {
                    required: "Enter Your Name",
                },
                    gender : {
                    required: "Select Your Gender",
                },
                    country : {
                    required: "Select Your Country",
                },
                state : {
                    required: "Select Your State",
                },
                city : {
                    required: "Enter Your City",
                },
                contact : {
                    required: "Enter Your Contact No.",
                    minlength: "Phone number should be 10 digit",
                    maxlength: "Phone number should be 10 digit"
                },
                email : {
                    required: "Enter Your Email-address",
                    email: "Enter Valid Email-address",
                },
                work_status : {
                    required: "Select Your Work Status",
                }
            },
            submitHandler: function(form) 
            {
                $('#infoBtn').prop('disabled', true);
                var form = $('#profile-form')[0];
                var datas = new FormData(form); 
            
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $('.process-comm').css("display", "block");
                $.ajax({
                    url: "{{route('profile.update')}}", 
                    type: "POST",             
                    data: datas,
                    cache: false,             
                    processData: false,
                    contentType: false,
                    dataType: "json",  
                    
                    success: function(data) 
                    {
                        $('.process-comm').css("display", "none");
                    
                        if(data.status == true){
                        toastr.success("Success!", data.message);
                        location.reload();
                        }else{
                        toastr.error("Opps!", data.message);
                        location.reload();
                        }
                    }
                });
                return false;
            },
        });
        
        $('[data-toggle="tooltip"]').tooltip();
        
        
       /* $('.example').DataTable({
            'dom': 'Rlfrtip',
            "scrollX": true,
            
            responsive: {
                details: {
                    type: 'column'
                }
            }
        });*/
        
        $('#example-mylead').DataTable({
            dom: 'lBfrtip',
            responsive:false,
            order: [[ 0, 'asc' ]]
        } );
        $('#example-lets').DataTable({
            dom: 'lBfrtip',
            responsive:false,
            scrollX: true,
            order: [[ 0, 'asc' ]]
        } );
        $('#example-myreq').DataTable({
            dom: 'lBfrtip',
            responsive:false,
            scrollX: true,
            order: [[ 0, 'asc' ]]
        } );
        
         $('#example-adv-rep').DataTable({
            dom: 'lBfrtip',
            responsive:false,
            scrollX: true,
            order: [[ 0, 'asc' ]]
        } ); 
        
        $('#example-adv-list').DataTable({
            dom: 'lBfrtip',
            responsive:false,
            scrollX: true,
            order: [[ 0, 'asc' ]]
        } ); 
        $('#example-business').DataTable({
            dom: 'lBfrtip',
            responsive:false,
            scrollX: true,
            order: [[ 0, 'asc' ]]
        } ); 
         $('#example-pay').DataTable({
            dom: 'lBfrtip',
            responsive:false,
            scrollX: true,
            order: [[ 0, 'desc' ]]
        } ); 

        /*---------Profile Image--------------*/
        $("a[id='image']").click(function() {
            $("input[id='my_file']").click();
        });
        
        $("#my_file").change(function() {
            
            var img = $(this).prop('files')[0];
            var id = $(this).data('id');
            var form_data = new FormData(); 
                form_data.append("image", img) 
                form_data.append("id",id) 
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url: "{{route('profile.update')}}",
                data:form_data,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    if(data.status == true){
                            toastr.options.timeOut = 1500; // 1.5s
                            toastr.success(data.message);
                            location.reload();
                    }else{
                        toastr.options.timeOut = 1500; // 1.5s
                            toastr.error('Something went wrong!');
                            location.reload();
                    }
                },
                error: function(data){
                    console.log("error");
                }
            });
                
            });
            
        /*---------Cover Image--------------*/
        $("a[id='cover']").click(function() {
            $("input[id='my_cover']").click();
        });
        
        $("#my_cover").change(function() {
            
            var cover_img = $(this).prop('files')[0];
            var id = $(this).data('id');
            var form_data = new FormData(); 
                form_data.append("cover_image", cover_img) 
                form_data.append("id",id) 
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url: "{{route('profile.update')}}",
                data:form_data,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    if(data.status == true){
                            toastr.options.timeOut = 1500; // 1.5s
                            toastr.success(data.message);
                            location.reload();
                    }else{
                        toastr.options.timeOut = 1500; // 1.5s
                            toastr.error('Something went wrong!');
                            location.reload();
                    }
                },
                error: function(data){
                    console.log("error");
                }
            });
                
            });
            

            /*---------Business Profile--------------*/
        
        
            $('#business-profile').validate({
            rules: {
                org_name : {
                    required: true,
                    minlength: 5
                },
                org_address_line_1: {
                    required: true,
                },
                country: {
                    required: true,
                },
                state: {
                    required: true,
                },
                city: {
                    required: true,
                },
                about_org : {
                    required: true,
                }                  
            },
            messages: {
                org_name : {
                    required: "Enter Your Organization Name",
                },
                org_address_line_1 : {
                    required: "Enter Your Organization Address",
                },
                    country : {
                    required: "Select Your Country",
                },
                state : {
                    required: "Select Your State",
                },
                city : {
                    required: "Enter Your City",
                },
                about_org : {
                    required: "Write About Your Organization",
                }
            },
            submitHandler: function(form) 
            {
                $('#bpBtn').prop('disabled', true);
                var form = $('#business-profile')[0];
                var datas = new FormData(form); 
            
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                    url: "{{route('business-profile.create')}}", 
                    type: "POST",             
                    data: datas,
                    cache: false,             
                    processData: false,
                    contentType: false,
                    dataType: "json",  
                    
                    success: function(data) 
                    {
                    
                        if(data.status == true){
                        toastr.success("Success!", data.message);
                        location.reload();
                        }else{
                        toastr.error("Opps!", data.message);
                        location.reload();
                        }
                    }
                });
                return false;
            },
        });
        
        
            $('body').on('click', '.editbp', function () {
            
            var id = $(this).data('id');
            
            $.get("{{ url('business-profile-edit') }}" +'/' + id, function (data) {
                
                $('#exampleModalLabel1').html("Edit Business Profile");
                $('#bpBtn').text("Update");
                $('.business-profile-modal').modal('show');
                
                $('#bpid').val(data.id);
                $('#org_name').val(data.org_name);
                $('#org_address_line_1').val(data.org_address_line_1);
                $('#org_address_line_2').val(data.org_address_line_2);
                $('#country').find('option[value="' + data.country + '"]').attr("selected", "selected");
                $('#state').find('option[value="' + data.state + '"]').attr("selected", "selected");
                $('#city').val(data.city);
                $('#pincode').val(data.pincode);
                
                var org_type = null;
                if(data.org_type){
                    org_type = JSON.parse(data.org_type);
                    $(".org_type").each(function(x,y){
                        if(data.org_type.includes($(this).val())){
                            $(this).attr('checked', true);
                        }
                    });
                }
                $('#about_org').val(data.about_org);
                $('#iso_cert').find('option[value="' + data.iso_cert + '"]').attr("checked", "checked");
                
                var iso_cert = null;
                if(data.iso_cert){
                    iso_cert = JSON.parse(data.iso_cert);
                    $(".iso_cert").each(function(x,y){
                        if(data.iso_cert.includes($(this).val())){
                            $(this).attr('checked', true);
                        }
                    });
                }
                $('#desc_iso_cert').val(data.desc_iso_cert);
                
                var achievement = null;
                if(data.achievement){
                    achievement = JSON.parse(data.achievement);
                    $(".achievement").each(function(x,y){
                        if(data.achievement.includes($(this).val())){
                            $(this).attr('checked', true);
                        }
                    }); 
                }
                $('#desc_achievement').val(data.desc_achievement);
                $('#about_listing').val(data.about_listing);
                
                var trademark = null;
                if(data.trademark){
                    trademark = JSON.parse(data.trademark);
                    $(".trademark").each(function(x,y){
                        if(data.trademark.includes($(this).val())){
                            $(this).attr('checked', true);
                        }
                    }); 
                }
                $('#desc_trademark').val(data.desc_trademark);
                
                var business_sector = null;
                if(data.business_sector){
                    business_sector = JSON.parse(data.business_sector);
                    $(".business_sector").each(function(x,y){
                        if(data.business_sector.includes($(this).val())){
                            $(this).attr('checked', true);
                        }
                    });
                }
                
                var nature_of_business = null;
                if(data.nature_of_business){
                    nature_of_business = JSON.parse(data.nature_of_business);
                    $(".nature_of_business").each(function(x,y){
                        if(nature_of_business.includes($(this).val())){
                            $(this).attr('checked', true);
                        }
                    });
                }

                    /* $('.org_img').attr('id',"org_img_"+data.id);
                    var org_img = data.org_images.split(',');
                    console.log(org_img);
                    org_img.forEach(function(x,y){
                    console.log(x);
                            var path = "{{asset('front/images/business_profile')}}/"+x;
                            $('#org_img_'+y).attr('src', path);   
                            <img src="" class="org_img" height="80" width="80">
                    }); */
                
            });
            $('body').on('click', '#bpBtn', function (e) {
                e.preventDefault();
                    
                    var editid = $('#bpid').val();
                    
                    var edit_form = $('#business-profile')[0];
                    var edit_datas = new FormData(edit_form); 
                //   alert(edit_datas.valid());

                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                    $.ajax({
                        url: "{{ url('business-profile-update') }}" +'/' + editid,
                        type: "POST",             
                        data: edit_datas,
                        cache: false,             
                        processData: false,
                        contentType: false,
                        dataType: "json",  
                        
                        success: function(data) 
                        {
                        //  $('.loader_gif').css("display", "none");
                        
                        $('#business-profile').trigger("reset");
                        $('#business-profile-modal').modal('hide');
                            if(data.status == true){
                            toastr.success("Success!", data.message);
                            location.reload();
                            }else{
                            toastr.error("Opps!", data.message);
                            location.reload();
                            }
                        }
                    });
                });
            });

            $(".deletebp").click(function(){
            var id = $(this).data("id");
            var token = "{{csrf_token()}}";
            var d = confirm('Do you really want to delete this business profile ?');
            if(d == true){
                $.ajax(
                {
                    url: "{{ url('business-profile-delete') }}" +'/' + id,
                    type: 'Delete',
                    dataType: "JSON",
                    data: {
                        "id": id,
                        "_method": 'DELETE',
                        "_token": token,
                    },
                    success: function (data)
                    {
                        if(data.status == true){
                                toastr.error("Success!", data.message);
                                location.reload();
                        }else{
                        toastr.error("Opps!", data.message);
                        location.reload();
                        }
                    }
                });
            }
        });


        $('.iso_cert').on('click', function(){
        
            var get_val = $(this).attr('value');
            if(get_val=='1'){
                $('#desc_iso_cert').css('display', 'block');
            }else{
                $('#desc_iso_cert').css('display', 'none');
            }
        });

        $('.achievement').on('click', function(){
            
            var get_val = $(this).attr('value');
            if(get_val=='1'){
                $('#desc_achievement').css('display', 'block');
            }else{
                $('#desc_achievement').css('display', 'none');
            }
        });

        $('.trademark').on('click', function(){
            
            var get_val = $(this).attr('value');
            if(get_val=='1'){
                $('#desc_trademark').css('display', 'block');
            }else{
                $('#desc_trademark').css('display', 'none');
            }
        });
        

            
        /*---------Advisory Listing--------------*/
        
        /*--Image Validation --*/
        var _URL = window.URL || window.webkitURL;
        $("#adv-image").change(function (e) {
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                var objectUrl = _URL.createObjectURL(file);
                img.onload = function () {
                    // alert(this.width + " " + this.height);
                    var height = this.height;
                    var width = this.width;
                    if (height > 300 || width > 300) {
                        // alert("Height and Width must not exceed 300px.");
                        $('.img-success').text('');
                        $('.img-error').text('Height and Width must not exceed 300x300.');
                        return false;
                    }
                    else if (height < 300 || width < 300) {
                        $('.img-success').text('');
                        $('.img-error').text('Height and Width must be atleast 300x300.');
                        return false;
                    }
                    // alert("Selected image has valid Height and Width.");
                    $('.img-error').text('');
                    $('.img-success').text('Selected image has valid Height and Width.');
                    return true;
                    _URL.revokeObjectURL(objectUrl);
                };
                img.src = objectUrl;
            }
        });
        
        
        $('#advisory-listing').validate({
            submitHandler: function(form) 
            {
                $('#saveBtn').prop('disabled', true);
                var form = $('#advisory-listing')[0];
                var datas = new FormData(form); 
            
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                    url: "{{route('advisory-listing.create')}}", 
                    type: "POST",             
                    data: datas,
                    cache: false,             
                    processData: false,
                    contentType: false,
                    dataType: "json",  
                    
                    success: function(data) 
                    {
                      // $('#modal-id').modal('hide');
                        if(data.status == true){
                        toastr.success("Success!", data.message);
                        location.reload();
                        }else{
                        toastr.error("Opps!", data.message);
                        location.reload();
                        }
                    }
                });
                return false;
            },
        });
        
        
        $('body').on('click', '.edit-advisory', function () {
            
            
            var id = $(this).data('id');
            
            $.get("{{ url('advisory-listing-edit') }}" +'/' + id, function (data) {
                
                $('#exampleModalLabel1').html("Edit Advisory Listing");
                $('#saveBtn').text("Update");
                $('.advisory-listing-modal').modal('show');
                
                
                $('#id').val(data.id);
                $('#type').find('option[value="' + data.type + '"]').attr("selected", "selected");
                $('#category').find('option[value="' + data.category + '"]').attr("selected", "selected");
                $('#listing_name').val(data.listing_name);
                $('#duration_in_hours').val(data.duration_in_hours);
                $('#duration_in_minutes').val(data.duration_in_minutes);
                $('#fees').val(data.fees);
                $('#about_listing').val(data.about_listing);
                $('#experience').val(data.experience);
                $('#exp_in_years').val(data.exp_in_years);
                $('#exp_in_months').val(data.exp_in_months);
                
                var mode = null;
                if(data.mode){
                    mode = JSON.parse(data.mode);
                    $(".mode").each(function(x,y){
                        if(mode.includes($(this).val())){
                            $(this).attr('checked', true);
                        }
                    });
                }
            });
            
            $('body').on('click', '#saveBtn', function (e) {
                
                $(this).prop('disabled', true);
                e.preventDefault();
                var editid = $('#id').val();
                //   alert(editid);
                
                var edit_form = $('#advisory-listing')[0];
                var edit_datas = new FormData(edit_form); 
                //   alert(edit_datas.valid());

                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                    $.ajax({
                        url: "{{ url('advisory-listing-update') }}" +'/' + editid,
                        type: "POST",             
                        data: edit_datas,
                        cache: false,             
                        processData: false,
                        contentType: false,
                        dataType: "json",  
                        
                        success: function(data) 
                        {
                        //  $('.loader_gif').css("display", "none");
                        
                        $('#advisory-listing').trigger("reset");
                        $('#advisory-listing-modal').modal('hide');
                            if(data.status == true){
                            toastr.success("Success!", data.message);
                            location.reload();
                            }else{
                            toastr.error("Opps!", data.message);
                            location.reload();
                            }
                        }
                    });
                });
        });


        $(".delete-advisory").click(function(){
            var id = $(this).data("id");
            var token = "{{csrf_token()}}";
            let a = confirm('Do you really want to delete this advisory ?');
            if(a == true){
                $.ajax(
                {
                    url: "{{ url('advisory-listing-delete') }}" +'/' + id,
                    type: 'Delete',
                    dataType: "JSON",
                    data: {
                        "id": id,
                        "_method": 'DELETE',
                        "_token": token,
                    },
                    success: function (data)
                    {
                        if(data.status == true){
                                toastr.error("Success!", data.message);
                                location.reload();
                        }else{
                        toastr.error("Opps!", data.message);
                        location.reload();
                        }
                    }
                });
            }else{
                return false;
            }
        });

        
        /*----show more/show less-------*/
        var showChar = 200;  
        var ellipsestext = "...";
        var moretext = "Read more";
        var lesstext = "Read less";
        
    
        $('.more').each(function() {
            var content = $(this).html();
        
            if(content.length > showChar) {
        
                var c = content.substr(0, showChar);
                var h = content.substr(showChar, content.length - showChar);
        
                var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
        
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


        /* Posts Edit Popup */

        $('body').on('click', '.editPost', function () {
            
            var id = $(this).data('id');
            let route = "{{route('post.update')}}";

        
            $.get("{{ url('post-edit') }}" +'/' + id, function (data) {
                $("#post_form").attr('action',route);

                $('#saveBtn').text("Update");
                $(".post-popup.job_post").addClass("active");
                $(".wrapper").addClass("overlay");
                
                $('#post_id').val(data.id);
                $('#post_title').val(data.title);
                
                var categories = data.category.split(',');
                var skills = data.skill.split(',');
                var tags = data.tag.split(',');

                $('#category_p').val(categories);
                $('#category_p').trigger("change");

                $('#skill_p').val(skills);
                $('#skill_p').trigger("change");
                
                $('#tag_p').val(tags);
                $('#tag_p').trigger("change");

                $('#post_description').text(data.description);
            });
        }); 
        /* Posts Edit Popup */
        /* Posts delete */
        $(".deletePost").click(function(){
            let r = confirm('Do you really want to delete this post ?');

            if(r == true){
                var id = $(this).data("id");
                var token = "{{csrf_token()}}";
                $.ajax(
                {
                    url: "{{ url('post-delete') }}" +'/' + id,
                    type: 'Delete',
                    dataType: "JSON",
                    data: {
                        "id": id,
                        "_method": 'DELETE',
                        "_token": token,
                    },
                    success: function (data)
                    {
                        if(data.status == true){
                                toastr.error("Success!", data.message);
                                location.reload();
                        }else{
                            toastr.error("Opps!", data.message);
                            location.reload();
                        }
                    }
                });
            }

        });
        /* Posts delete */
        
        /* Requirements Edit Popup */

        $('body').on('click', '.editRequirement', function () {
            
            var id = $(this).data('id');
            let route = "{{route('requirements.update')}}"; 

        
            $.get("{{ url('requirement-edit') }}" +'/' + id, function (data) {

                $(".post-popup.pst-pj").addClass("active");
                $(".wrapper").addClass("overlay");
                // return false;
                $("#post-form").attr('action',route);
                $('#save_r').text("Update");
                /*$(".post-project > a").on("click", function(){
                    $(".post-popup.pst-pj").removeClass("active");
                    $(".wrapper").removeClass("overlay");
                    return false;
                });*/
                
                $('#id_r').val(data.id);
                $('#title_r').val(data.title);
                
                var categories = data.category.split(',');
                var skills = data.skill.split(',');
                var tags = data.tag.split(',');

                $('#category_r').val(categories);
                $('#category_r').trigger("change");

                $('#skill_r').val(skills);
                $('#skill_r').trigger("change");
                
                $('#tag_r').val(tags);
                $('#tag_r').trigger("change");

                $('#description_r').text(data.description);
            });
        }); 
        /* Requirement Edit Popup */
        /* Requirement delete */
        $(".deleteRequirement").click(function(){
            let r = confirm('Do you really want to delete this requirement ?');

            if(r == true){
                var id = $(this).data("id");
                var token = "{{csrf_token()}}";
                $.ajax(
                {
                    url: "{{ url('requirement-delete') }}" +'/' + id,
                    type: 'Delete',
                    dataType: "JSON",
                    data: {
                        "id": id,
                        "_method": 'DELETE',
                        "_token": token,
                    },
                    success: function (data)
                    {
                        if(data.status == true){
                                toastr.error("Error!", data.message);
                                location.reload();
                        }else{
                            toastr.error("Opps!", data.message);
                            location.reload();
                        }
                    }
                });
            }

        });
        /* Requirement delete */


    });      
        
</script>
	
<script>

    

    /* Change Status Advisory Request */
    function reqAccept(_this, status, id) {
        $(this).attr('disabled','disabled');
        $("#AdvMsgModal").modal("show");
        $(".message_save").click(function () {
            var message = $("textarea#advisors_message").val();
            var fees = $("input#advisors_fees").val();
            if (!message) {
                alert("Please send a message to user!");
            } 
            else 
            {
                $.ajax({
                    url: "{{route('change_status')}}",
                    type: "POST",
                    data: { status: status, _token: "{{csrf_token()}}", id: id, message: message, fees:fees  },
                    success: function (response) {
                        if (response.status == true) {
                            toastr.success("Success!", response.message);
                            _this.closest("td").remove();
                            location.reload();
                        } else {
                            toastr.error("Opps!", response.message);
                            location.reload();
                        }
                    },
                });
            }
        });
    }
    function reqClose(_this, status, id) {
        //  alert(status);
        $("#myModal").modal("show");
        $(".reason_save").click(function () {
            var reason = $("textarea#reason").val();
            if (!reason) {
                alert("Reason is required!");
            } else {
                $.ajax({
                    url: "{{route('change_status')}}",
                    type: "POST",
                    data: { status: status, _token: "{{csrf_token()}}", id: id, reason: reason },
                    success: function (response) {
                        if (response.status == true) {
                            $("#myModal").modal("toggle");
                            toastr.error("Opps!", response.message);
                            _this.closest("td").remove();
                            location.reload();
                        } else {
                            $("#myModal").modal("toggle");
                            toastr.error("Opps!", response.message);
                            location.reload();
                        }
                    },
                });
            }
        });
    }
    function reqPayment(status, advisory_request_id, user_id, advisor_id, fees=0, ) {
       
         $('#user_id_x').val(user_id);
         $('#advisor_id_x').val(advisor_id);
         $('#fees_x').val(fees); 
         $('#status_x').val(status); 
         $('#advisory_request_id_x').val(advisory_request_id);
        
        $("#reqPayModal").modal("show");
        
    }
    
    /* Rating */
    $(document).ready(function(){
	    
    	$(".btnrating").on('click',(function(e) {
    	
        	var previous_value = $("#selected_rating").val();
        	
        	var selected_value = $(this).attr("data-attr");
        	$("#selected_rating").val(selected_value);
        	
        	$(".selected-rating").empty();
        	$(".selected-rating").html(selected_value);
    
        	$(".rating").val(selected_value);
        	
        	for (i = 1; i <= selected_value; ++i) {
        	$("#rating-star-"+i).toggleClass('btn-warning');
        	$("#rating-star-"+i).toggleClass('btn-secondary');
        	}
        	
        	for (ix = 1; ix <= previous_value; ++ix) {
        	$("#rating-star-"+ix).toggleClass('btn-warning');
        	$("#rating-star-"+ix).toggleClass('btn-secondary');
        	}
    	
    	}));
    		
    });

    
    
    function completed(_this, status, id) {
        $.ajax({
            url: "{{route('change_status')}}",
            type: "POST",
            data: { status: status, _token: "{{csrf_token()}}", id: id },
            success: function (response) {
                if (response.status == true) {
                    toastr.success("Success!", response.message);
                    location.reload();
                } else {
                    toastr.error("Opps!", response.message);
                    location.reload();
                }
            },
        });
    }
    
     function dismiss(_this, status, id) {
         $.ajax({
            url: "{{route('change_status')}}",
            type: "POST",
            data: { status: status, _token: "{{csrf_token()}}", id: id },
            success: function (response) {
                if (response.status == true) {
                    toastr.success("Success!", response.message);
                    location.reload();
                } else {
                    toastr.error("Opps!", response.message);
                    location.reload();
                }
            },
        });
    }
    function feedback(_this, status, id) {
        
        $('#fbid').val(id);
        $("#fbModal").modal("show");
        $(".feedback_save").click(function () {
            var rating = $('.rating').val();
            var feedback = $("textarea#feedback").val();
            $.ajax({
                url: "{{route('change_status')}}",
                type: "POST",
                data: { status: status, _token: "{{csrf_token()}}", id: id, feedback: feedback,rating:rating },
                success: function (response) {
                    if (response.status == true) {
                        $("#fbModal").modal("toggle");
                        toastr.success("Success!", response.message);
                        location.reload();
                    } else {
                        $("#fbModal").modal("toggle");
                        toastr.error("Opps!", response.message);
                        location.reload();
                    }
                },
            });
        });
    }
    
    function complain(_this, lead_id) {
        
        $('#lead_id').val(lead_id);
        $("#complainModal").modal("show");
    }
    
    
    /*function reRequest(_this, advisor_id, user_id, listing_name, type=null, category=null) {
         
        $("#reRequestModal").modal("show");
         $('#re_req_advisor_id').val(advisor_id);
         $('#re_req_user_id').val(user_id);
         $('#re_req_listing_name').val(listing_name);
         $('#re_req_type').val(type);
         $('#re_req_category').val(category);
         
    }*/
    
    /*function disSatisfy(_this, status, id) {
    
        $("#myModal1").modal("show");
        $(".feedback_save").click(function () {
            var feedback = $("textarea#feedback").val();
            if (!feedback) {
                alert("Please Give Your Feedback..!");
            } else {
                $.ajax({
                    url: "{{route('change_status')}}",
                    type: "POST",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: { status: status, id: id, feedback: feedback },
                    success: function (response) {
                        if (response.status == true) {
                            $("#myModal1").modal("toggle");
                            toastr.error("Opps!", response.message);
                            _this.closest("td").remove();
                            location.reload();
                        } else {
                            $("#myModal1").modal("toggle");
                            toastr.error("Opps!", response.message);
                            location.reload();
                        }
                    },
                });
            }
        });
    }*/
    
    $(document).ready(function(){
        $('#wrk_st').change(function(){
            if($(this).val() == 'Other') {
                $('#div_id').show(); 
            }else{
                 $('#div_id').hide(); 
            }
        });
    });
    
    
    $(document).ready(function(){
        $('#text_field').keypress(function(e) {
            preventNumberInput(e);
        });
    })
    
    function preventNumberInput(e){
        var keyCode = (e.keyCode ? e.keyCode : e.which);
        if (keyCode > 47 && keyCode < 58 || keyCode > 95 && keyCode < 107 ){
            e.preventDefault();
        }
    }
    
    
    /* Stay Same page after page reload*/
    $(document).ready(function(){
    	$('.myTabs li[data-toggle="tab"]').on('click', function(e) {
    	   // console.log($(this).attr('data-tab'));
    		localStorage.setItem('activeTab', $(this).attr('data-tab'));
    	});
    	var activeTab = localStorage.getItem('activeTab');
    	if(activeTab){
         // $('#myTab a[href="' + activeTab + '"]').tab('show');
    // 		$("#info-dd-ss").hide();
    		$("#info-dd-ss").removeClass('current');
    		$('.myTabs li[data-tab="' + activeTab + '"]').addClass('animated fadeIn active');
    		$("#"+ activeTab +"-ss").addClass('current animated fadeIn');
    // 		$("#info-dd-ss").show();

    	}
    });
    
    
    

</script>