<div class="modal fade advisory-listing-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Add Advisory Listing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" id="advisory-listing" onsubmit="return false;">
                    <div class="modal-body">
                        <div class="container">
                            <input type="hidden" name="id" id="id" value="" />
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label>Advisory Type<span class="text-danger">*</span></label>
                                    <select class="" name="type" id="type" style="width:100%;" required>
                                        <option value="" selected>Select</option>
                                        <option value="1">Product</option>
                                        <option value="2">Service</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Advisory Field(Sector)<span class="text-danger">*</span></label>
                                    <select class="" name="category" id="category" style="width:100%;" required>
                                        <option value="" selected>Select</option>
                                     @foreach(App\Models\Field::all() as $v)
                                        <option value="{{$v->id}}">{{$v->name}}</option>
                                     @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label>Explain in details about this listing or problem for which you are able to advise.</label>
                                    <textarea class="form-control" name="about_listing" id="about_listing" placeholder="Please write in details about the issue for which u are able to advise for the selected subject matter"></textarea>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label>Give any suitable name for this listing or problem<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="listing_name" id="listing_name" value="" required placeholder="Enter the Name of Your listing or Problem" />
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Duration</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" name="duration_in_hours" id="duration_in_hours" value="" placeholder="In Hours" />
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" name="duration_in_minutes" id="duration_in_minutes" value="" placeholder="In Minutes" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label>Advisory Charges<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="fees" id="fees" required value="" placeholder="Advisory Charges" />
                                </div>
                                <div class="col-md-6">
                                    <label>Upload picture of your problem</label>
                                    <input type="file" class="form-control" name="image" id="adv-image" />
                                    <span class="img-error text-danger"></span>
                                    <span class="img-success text-success"></span>
                                </div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label>Write about your experiences and how your advice is beneficial for others?</label>
                                    <textarea class="form-control" name="experience" id="experience" placeholder="Write about how your advise is beneficial for others"></textarea>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Please select your mode to provide the solutions</label>
                                        </div>
                                        <div class="col-md-6"><input type="checkbox" class="mode" name="mode[]" value="Voice call" /> On Voice Call</div>
                                        <div class="col-md-6"><input type="checkbox" class="mode" name="mode[]" value="Video call" /> On Video Call</div>
                                        <div class="col-md-6"><input type="checkbox" class="mode" name="mode[]" value="Any Desk" /> On Any Desk</div>
                                        <div class="col-md-6"><input type="checkbox" class="mode" name="mode[]" value="Team Viewer" /> On Team Viewer</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Period of experience</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" name="exp_in_years" id="exp_in_years" value="" placeholder="In Years" />
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" name="exp_in_months" id="exp_in_months" value="" placeholder="In Month" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn theme-bg" id="saveBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
