@extends('admin.layout.app')

 @section('content')
	    
	<div class="main-panel">
      <div class="content-wrapper">
        <div class="page-header">
          <h3 class="page-title">Skills</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Skills</a></li>
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
                <form class="forms-sample" method="post" action="{{route('skill.update',$skill->id)}}">
                  @csrf
                  
                
                  <div class="form-group">
                    <label for="exampleInputName">Name*</label>
                    <input type="text" class="form-control" id="exampleInputName" placeholder="Name" name="name" value="{{$skill->name}}" required>
                  </div>
                  <!--<div class="form-group">
                    <label for="exampleInputEmail3">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
                  </div>-->
                  <!--<div class="form-group">
                    <label for="exampleInputPassword4">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                  </div>-->
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
                  <div class="form-group">
                    <label for="exampleSelectStatus">Status*</label>
                    <select class="form-control" id="exampleSelectStatus" name="status" required>
                      <option value="1" {{$skill->status == '1' ? 'selected' : ''}}>Active</option>
                      <option value="0" {{$skill->status == '0' ? 'selected' : ''}}>Inactive</option>
                    </select>
                  </div>
                  <!--<div class="form-group">
                    <label for="exampleInputCity1">City</label>
                    <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location">
                  </div>
                  <div class="form-group">
                    <label for="exampleTextarea1">Textarea</label>
                    <textarea class="form-control" id="exampleTextarea1" rows="4"></textarea>
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