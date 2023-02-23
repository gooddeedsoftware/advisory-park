 @extends('admin.layout.app')

 @section('content')
	    
	<div class="main-panel">
      <div class="content-wrapper">
        <div class="page-header">
          <h3 class="page-title">Users</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Users</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add</li>
            </ol>
          </nav>
        </div>
        <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <!--<h4 class="card-title">Basic form elements</h4>-->
                <!--<p class="card-description"> Basic form elements </p>-->
                <form class="forms-sample" method="post" action="{{route('users.store')}}">
                  @csrf
                  <div class="form-group">
                    <label for="exampleInputTitle">Name*</label>
                    <input type="text" class="form-control" id="exampleInputTitle" placeholder="Name" name="name" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail">Email address*</label>
                    <input type="email" class="form-control" id="exampleInputEmail" placeholder="Email" name="email" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputMobile">Contact</label>
                    <input type="number" class="form-control" id="exampleInputMobile" name="contact"  placeholder="Contact">
                  </div>
                  <!--<div class="form-group">
                    <label for="exampleInputPassword4">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                  </div>-->
                  <div class="form-group">
                    <label>Image</label>
                    <!--<input type="file" name="img[]" class="file-upload-default">-->
                    <div class="input-group col-xs-12">
                      <input type="file" class="form-control file-upload-info" name="image"  placeholder="Upload Image">
                      <!--<span class="input-group-append">
                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                      </span>-->
                    </div>
                  </div>
                  <!--<div class="form-group">
                    <label for="exampleSelectStatus">Status*</label>
                    <select class="form-control" id="exampleSelectStatus" name="status" required>
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>-->
                 
                  <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                  <button class="btn btn-light">Cancel</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
     
    </div>
	    
	    
 @endsection