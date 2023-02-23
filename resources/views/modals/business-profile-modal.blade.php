<div class="modal fade business-profile-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Add Business Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" id="business-profile" onsubmit="return false;">
                    <div class="modal-body">
                        <div class="container">
                            <input type="hidden" name="id" id="bpid" value="" />
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label>Name of the Organisation or You can create your personal name if you don't have organisation<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="org_name" id="org_name" value="" placeholder="Name of the Organization" />
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <h6>Address of the Organization</h6>
                                </div>
                                <div class="col-md-6">
                                    <label>Line 1<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="org_address_line_1" id="org_address_line_1" value="" placeholder="Line 1" />
                                </div>
                                <div class="col-md-6">
                                    <label>Line 2</label>
                                    <input type="text" class="form-control" name="org_address_line_2" id="org_address_line_1" value="" placeholder="Line 2" />
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label>Country<span class="text-danger">*</span></label><br>
                                    <select class="form-select" style="width:100%;" name="country" id="country">
                                        <option value="" selected>Select Country</option>
                                        <option value="India" selected>India</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>State<span class="text-danger">*</span></label><br>
                                    <select class="form-select" style="width:100%;" name="state" id="state">
                                        <option value="" selected>Select State</option>
                                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                                        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                        <option value="Assam">Assam</option>
                                        <option value="Bihar">Bihar</option>
                                        <option value="Chattisgarh">Chattisgarh</option>
                                        <option value="Chandigarh">Chandigarh</option>
                                        <option value="Dadra and Nagar Haveli & Daman and Diu">Dadra and Nagar Haveli & Daman and Diu</option>
                                        <option value="Delhi">Delhi</option>
                                        <option value="Goa">Goa</option>
                                        <option value="Gujarat">Gujarat</option>
                                        <option value="Haryana">Haryana</option>
                                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                                        <option value="Jammu & Kashmir">Jammu & Kashmir</option>
                                        <option value="Jharkhand">Jharkhand</option>
                                        <option value="Karnataka">Karnataka</option>
                                        <option value="Kerala">Kerala</option>
                                        <option value="Ladakh">Ladakh</option>
                                        <option value="Lakshadweep">Lakshadweep</option>
                                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                                        <option value="Maharashtra">Maharashtra</option>
                                        <option value="Manipur">Manipur</option>
                                        <option value="Meghalaya">Meghalaya</option>
                                        <option value="Mizoram">Mizoram</option>
                                        <option value="Nagaland">Nagaland</option>
                                        <option value="Odisha">Odisha</option>
                                        <option value="Puducherry">Puducherry</option>
                                        <option value="Punjab">Punjab</option>
                                        <option value="Rajasthan">Rajasthan</option>
                                        <option value="Sikkim">Sikkim</option>
                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                        <option value="Telangana">Telangana</option>
                                        <option value="Tripura">Tripura</option>
                                        <option value="Uttarakhand">Uttarakhand</option>
                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                        <option value="West Bengal">West Bengal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label>City<span class="text-danger">*</span></label>
                                    <input type="text" name="city" id="city" placeholder="City" class="form-control" value="" />
                                </div>

                                <div class="col-md-6">
                                    <label>Pincode</label>
                                    <input type="number" class="form-control" id="pincode" name="pincode" value="" placeholder="Pincode" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Type of the Organisation<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-3"><input type="radio" class="org_type" name="org_type" value="Properitorship" /> Properitorship</div>
                                <div class="col-md-3"><input type="radio" class="org_type" name="org_type" value="Partnership" /> Partnership</div>
                                <div class="col-md-3"><input type="radio" class="org_type" name="org_type" value="Private Limited" /> Private Limited</div>
                                <div class="col-md-3"><input type="radio" class="org_type" name="org_type" value="Public Limited" /> Public Limited</div>
                                <div class="col-md-3"><input type="radio" class="org_type" name="org_type" value="LLP" /> LLP</div>
                                <div class="col-md-3"><input type="radio" class="org_type" name="org_type" value="Listed Co." /> Listed Co.</div>
                                <div class="col-md-3"><input type="radio" class="org_type" name="org_type" value="Other" /> Other</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label>Write about your Organisation<span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="about_org" id="about_org" placeholder="Write about how your advise is beneficial for others"></textarea>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label>Upload Organisation Pictures</label>
                                    <input type="file" class="form-control" name="org_images[]" multiple />
                                    <br />
                                </div>
                            </div>
                            <!--<div class="row mb-2">
                                <div class="col-md-12">
                                    <label>Orgnisation is ISO Certified <input type="radio" name="iso_cert" class="iso_cert" value="1" />Yes <input type="radio" name="iso_cert" class="iso_cert" value="0" />Not now </label>
                                    <textarea class="form-control" name="desc_iso_cert" id="desc_iso_cert" placeholder="Add Your ISO certification like ISO 9001:2015, ISO 14001, ISO 18001 etc."></textarea>
                                </div>
                            </div>-->
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label>
                                        Any Accomplishment/awards/honer/achievements <input type="radio" name="achievement" class="achievement" value="1" />Yes <input type="radio" name="achievement" class="achievement" value="0" />Not now
                                    </label>
                                    <textarea class="form-control" name="desc_achievement" id="desc_achievement" placeholder="Write Something..."></textarea>
                                </div>
                            </div>
                           <!-- <div class="row mb-2">
                                <div class="col-md-12">
                                    <label>Have registered trademark <input type="radio" name="trademark" class="trademark" value="1" />Yes <input type="radio" name="trademark" class="trademark" value="0" />Not now </label>
                                    <textarea class="form-control" name="desc_trademark" id="desc_trademark" placeholder="Name of the Trademark"></textarea>
                                </div>
                            </div>-->
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Please select your business is related<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-3"><input type="radio" class="business_sector" name="business_sector" value="Product Sector" /> Product Sector</div>
                                <div class="col-md-3"><input type="radio" class="business_sector" name="business_sector" value="Service Sector" /> Service Sector</div>
                                <div class="col-md-3"><input type="radio" class="business_sector" name="business_sector" value="Both" /> Both</div>
                            </div>
                            <!--<div class="row">
                                <div class="col-md-12">
                                    <label>Please select nature of your business<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-4"><input type="checkbox" class="nature_of_business" name="nature_of_business[]" value="Domestic Service Provider" /> Domestic Service Provider</div>
                                <div class="col-md-4"><input type="checkbox" class="nature_of_business" name="nature_of_business[]" value="International Service Provider" /> International Service Provider</div>
                                <div class="col-md-4"><input type="checkbox" class="nature_of_business" name="nature_of_business[]" value="Other" /> Other</div>
                            </div>-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn theme-bg" id="bpBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
