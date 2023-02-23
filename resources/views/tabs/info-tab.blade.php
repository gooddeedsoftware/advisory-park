<div class="product-feed-tab current" id="info-dd-ss">
    <form id="profile-form" onsubmit="return false;">
        <div class="user-profile-ov">
            <h3><a href="#" title="" class="overview-open">My Profile</a> <a href="#" title="" class="overview-open"></a></h3>
            <div class="row mb-2">
                <input type="hidden" class="form-control" name="id" value="{{Auth::user()->id}}" />
                <div class="col-md-6">
                    <label>Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}" placeholder="Name" disabled />
                </div>
                <div class="col-md-6">
                    <label>Your Advisory Park Id<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="advisory_park_id" value="{{Auth::user()->advisory_park_id}}" placeholder="Your Advisory Park Id" disabled />
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6">
                    <label>Gender<span class="text-danger">*</span></label><br />
                    <label class="p-1">Male</label> 
                    <input type="radio" class="" name="gender" {{Auth::user()->gender == 'male' ? 'checked' :''}} value="male"> 
                    <label class="p-1">Female</label>
                    <input type="radio" class="" name="gender" {{Auth::user()->gender == 'female' ? 'checked' :''}} value="female">
                    <label class="p-1">Other</label>
                    <input type="radio" class="" name="gender" {{Auth::user()->gender == 'i prefer not to say' ? 'checked' :''}} value="i prefer not to say">
                </div>
                <div class="col-md-6">
                    <label>Address</label>
                    <textarea class="form-control" name="address" placeholder="Address">{{Auth()->user()->address}}</textarea>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4">
                    <label>Country<span class="text-danger">*</span></label>
                    <select class="form-control" name="country">
                        <option selected>India</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>State<span class="text-danger">*</span></label>
                    <select class="form-control" name="state">
                        <option selected>Select</option>
                        <option value="Andhra Pradesh" {{Auth()->user()->state == 'Andhra Pradesh' ? 'selected' : ''}}>Andhra Pradesh</option>
                        <option value="Andaman and Nicobar Islands" {{Auth()->user()->state == 'Andaman and Nicobar Islands' ? 'selected' : ''}}>Andaman and Nicobar Islands</option>
                        <option value="Arunachal Pradesh" {{Auth()->user()->state == 'Arunachal Pradesh' ? 'selected' : ''}}>Arunachal Pradesh</option>
                        <option value="Assam" {{Auth()->user()->state == 'Assam' ? 'selected' : ''}}>Assam</option>
                        <option value="Bihar" {{Auth()->user()->state == 'Bihar' ? 'selected' : ''}}>Bihar</option>
                        <option value="Chattisgarh" {{Auth()->user()->state == 'Chattisgarh' ? 'selected' : ''}}>Chattisgarh</option>
                        <option value="Chandigarh" {{Auth()->user()->state == 'Chandigarh' ? 'selected' : ''}}>Chandigarh</option>
                        <option value="Dadra and Nagar Haveli and Daman & Diu" {{Auth()->user()->state == 'Dadra and Nagar Haveli and Daman & Diu' ? 'selected' : ''}}>Dadra and Nagar Haveli and Daman & Diu</option>
                        <option value="Delhi" {{Auth()->user()->state == 'Delhi' ? 'selected' : ''}}>Delhi</option>
                        <option value="Goa" {{Auth()->user()->state == 'Goa' ? 'selected' : ''}}>Goa</option>
                        <option value="Gujarat" {{Auth()->user()->state == 'Gujarat' ? 'selected' : ''}}>Gujarat</option>
                        <option value="Haryana" {{Auth()->user()->state == 'Haryana' ? 'selected' : ''}}>Haryana</option>
                        <option value="Himachal Pradesh" {{Auth()->user()->state == 'Himachal Pradesh' ? 'selected' : ''}}>Himachal Pradesh</option>
                        <option value="Jammu & Kashmir" {{Auth()->user()->state == 'Jammu & Kashmir' ? 'selected' : ''}}>Jammu & Kashmir</option>
                        <option value="Jharkhand" {{Auth()->user()->state == 'Jharkhand' ? 'selected' : ''}}>Jharkhand</option>
                        <option value="Karnataka" {{Auth()->user()->state == 'Karnataka' ? 'selected' : ''}}>Karnataka</option>
                        <option value="Kerala" {{Auth()->user()->state == 'Kerala' ? 'selected' : ''}}>Kerala</option>
                        <option value="Ladakh" {{Auth()->user()->state == 'Ladakh' ? 'selected' : ''}}>Ladakh</option>
                        <option value="Lakshadweep" {{Auth()->user()->state == 'Lakshadweep' ? 'selected' : ''}}>Lakshadweep</option>
                        <option value="Madhya Pradesh" {{Auth()->user()->state == 'Madhya Pradesh' ? 'selected' : ''}}>Madhya Pradesh</option>
                        <option value="Maharashtra" {{Auth()->user()->state == 'Maharashtra' ? 'selected' : ''}}>Maharashtra</option>
                        <option value="Manipur" {{Auth()->user()->state == 'Manipur' ? 'selected' : ''}}>Manipur</option>
                        <option value="Meghalaya" {{Auth()->user()->state == 'Meghalaya' ? 'selected' : ''}}>Meghalaya</option>
                        <option value="Mizoram" {{Auth()->user()->state == 'Mizoram' ? 'selected' : ''}}>Mizoram</option>
                        <option value="Nagaland" {{Auth()->user()->state == 'Nagaland' ? 'selected' : ''}}>Nagaland</option>
                        <option value="Odisha" {{Auth()->user()->state == 'Odisha' ? 'selected' : ''}}>Odisha</option>
                        <option value="Puducherry" {{Auth()->user()->state == 'Puducherry' ? 'selected' : ''}}>Puducherry</option>
                        <option value="Punjab" {{Auth()->user()->state == 'Punjab' ? 'selected' : ''}}>Punjab</option>
                        <option value="Rajasthan" {{Auth()->user()->state == 'Rajasthan' ? 'selected' : ''}}>Rajasthan</option>
                        <option value="Sikkim" {{Auth()->user()->state == 'Sikkim' ? 'selected' : ''}}>Sikkim</option>
                        <option value="Tamil Nadu" {{Auth()->user()->state == 'Tamil Nadu' ? 'selected' : ''}}>Tamil Nadu</option>
                        <option value="Telangana" {{Auth()->user()->state == 'Telangana' ? 'selected' : ''}}>Telangana</option>
                        <option value="Tripura" {{Auth()->user()->state == 'Tripura' ? 'selected' : ''}}>Tripura</option>
                        <option value="Uttarakhand" {{Auth()->user()->state == 'Uttarakhand' ? 'selected' : ''}}>Uttarakhand</option>
                        <option value="Uttar Pradesh" {{Auth()->user()->state == 'Uttar Pradesh' ? 'selected' : ''}}>Uttar Pradesh</option>
                        <option value="West Bengal" {{Auth()->user()->state == 'West Bengal' ? 'selected' : ''}}>West Bengal</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>City<span class="text-danger">*</span></label>
                    <input type="text" name="city" class="form-control" value="{{Auth::user()->city}}" />
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4">
                    <label>Pincode</label>
                    <input type="number" class="form-control" name="pincode" value="{{Auth::user()->pincode}}" placeholder="Pincode" />
                </div>
                <div class="col-md-4">
                    <label>Contact<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="contact" value="{{Auth::user()->contact}}" placeholder="Contact" />
                </div>
                <div class="col-md-4">
                    <label>Email<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" value="{{Auth::user()->email}}" placeholder="E-mail" disabled />
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4">
                    <label>Language Known</label>
                    <input type="text" class="form-control" name="language_known" value="{{Auth::user()->language_known}}" placeholder="Hindi/English/Tamil Etc..." />
                </div>
                <div class="col-lg-4">
                    
                    <label>Skill @if(\Session::get('type') == 'Advisor')<span class="text-danger">*</span>@endif</label>
                    <div class="inp-field">
                        <select name="skills[]" style="width:100%;" class="multiple" id="" multiple @if(\Session::get('type') == 'Advisor') required @endif>
                            @php $k = explode(',',Auth::user()->skills); @endphp
                            @foreach($config['field'] as $f)
                            <option value="{{$f->id}}" data-val="{{$f->name}}" {{in_array($f->id,$k) ? 'selected' : ''}}>{{$f->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Advisory Minimum Charge<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="advisory_minimum_charges" value="{{Auth::user()->advisory_minimum_charges}}" placeholder="Advisory Charge" />
                </div>
                
                <div class="col-md-4">
                    <label>Work Status<span class="text-danger">*</span></label>
                    <select class="form-control" name="work_status" id="wrk_st">
                        <option value="Job" {{Auth()->user()->work_status == 'Job' ? 'selected' : ''}}>Job</option>
                        <option value="Own Business" {{Auth()->user()->work_status == 'Own Business' ? 'selected' : ''}}>Own Business</option>
                        <option value="Other" {{Auth()->user()->work_status == 'Other' ? 'selected' : ''}}>Other</option>
                    </select>
                </div>
                
                <div class="col-md-4 pull-right" id="div_id" style="display:none;">
                    <label>Please Specify Other Work Status</label>
                    <input type="text" class="form-control" name="other_work_status" placeholder="Please Specify Your Work Status" value="{{Auth::user()->other_work_status}}" >

                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">
                    <label>Education</label>
                    <textarea class="form-control" name="education" rows="6" cols="50" id="text_field" placeholder="Education(Optional to show)" >{{Auth::user()->education}}</textarea>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">
                    <label>Qualification/ Achievements/ Certification/ Awards</label>
                    <textarea class="form-control" name="qualifications" rows="4" cols="50"  placeholder="Write Complete Qualification/ Achievements/ Certification/ Awards">{{Auth::user()->qualifications}}</textarea>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">
                    <label>Work Experience</label>
                    <textarea class="form-control" name="experience" rows="5" cols="50" placeholder="Please Describe your work experience...">{{Auth::user()->experience}}</textarea>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">
                    <label>Write more about your professional journey</label>
                    <textarea class="form-control" name="about_us" rows="4" cols="50" placeholder="About Us(Optional to show)">{{Auth::user()->about_us}}</textarea>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">
                    <button type="submit" class="btn float-right theme-bg text-light" id="infoBtn">Update</button>
                </div>
            </div>
        </div>
    </form>
    
</div>



