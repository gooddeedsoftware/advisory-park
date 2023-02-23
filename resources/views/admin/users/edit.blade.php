@extends('admin.layout.app')

 @section('content')
	    
	<div class="main-panel">
      <div class="content-wrapper">
        <div class="page-header">
          <h3 class="page-title">Users</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Users</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
          </nav>
        </div>
        <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <!--<h4 class="card-title">Basic form elements</h4>-->
                <!--<p class="card-description"> Basic form elements </p>-->
                <form class="forms-sample" method="post" action="{{route('users.update',$users->id)}}">
                  @csrf
                  
                  <div class="form-group">
                    <label for="exampleInputName">Name*</label>
                    <input type="text" class="form-control" id="exampleInputName" placeholder="Name" name="name" value="{{$users->name}}" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail">Email address*</label>
                    <input type="email" class="form-control" id="exampleInputEmail" placeholder="Email" name="email" value="{{$users->email}}" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputMobile">Contact</label>
                    <input type="number" class="form-control" id="exampleInputMobile" placeholder="Mobile" name="contact" value="{{$users->contact}}">
                  </div>
                  
                  <div class="form-group">
                    <label>Image</label>
                    <!--<input type="file" name="img" class="file-upload-default">-->
                    <div class="input-group col-xs-12">
                      <input type="file" class="form-control file-upload-info" name="image" placeholder="Upload Image">
                      <!--<span class="input-group-append">
                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                      </span>-->
                    </div>
                  </div>
                  <!--<div class="form-group">
                    <label for="exampleSelectStatus">Status*</label>
                    <select class="form-control" id="exampleSelectStatus" name="status" required>
                      <option value="1" {{$users->status == '1' ? 'selected' : ''}}>Active</option>
                      <option value="0" {{$users->status == '0' ? 'selected' : ''}}>Inactive</option>
                    </select>
                  </div>-->
                 
                  <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
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