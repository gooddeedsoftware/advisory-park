@extends('admin.layout.app')

 @section('content')
	    
	<div class="main-panel">
      <div class="content-wrapper">
        <div class="page-header">
          <h3 class="page-title">Advisory Listing</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Advisory Listing</a></li>
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
                <form class="forms-sample" method="post" action="{{route('advisory_listing.update',$advisory_listing->id)}}">
                  @csrf
                  <div class="form-group">
                    <label for="exampleInputTitle">Title*</label>
                    <input type="text" class="form-control" id="exampleInputTitle" placeholder="Title" name="title" value="{{$advisory_listing->title}}" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleSelectCategory">Category*</label>
                    <select class="form-control" id="exampleSelectCategory" name="category" multiple required>
                      <option value="">Select Category</option>
                      @foreach($categories as $c)
                      <option value="{{$c->id}}">{{$c->name}}</option>
                      @endforeach
                    </select>
                  </div>
                   <div class="form-group">
                    <label for="exampleSelectSkill">Skill*</label>
                    <select class="form-control" id="exampleSelectSkill" name="skill" multiple required>
                      <option value="">Select Skill</option>
                      @foreach($skills as $s)
                      <option value="{{$s->id}}">{{$s->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleSelectTag">Tag*</label>
                    <select class="form-control" id="exampleSelectTag" name="tag" multiple required>
                      <option value="">Select Tag</option>
                      @foreach($tags as $t)
                      <option value="{{$t->id}}">{{$t->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleSelectUser">Created By*</label>
                    <select class="form-control" id="exampleSelectUser" name="created_by" required>
                      <option value="">Select</option>
                      @foreach($users as $u)
                      <option value="{{$u->id}}" {{$advisory_listing->created_by == $u->id ? 'selected' : ''}}>{{$u->name}}</option>
                      @endforeach
                    </select>
                  </div>
                 
                 
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