 @extends('admin.layout.app');
 @section('content')
 
   <!-- @if(session('success'))
	<div class="alert alert-success" role="alert">
		{{session('success')}}
	</div>
	@elseif(session('update'))
	<div class="alert alert-info" role="alert">
		{{session('update')}}
	</div>
	@else
	<div class="alert alert-error" role="alert">
	    {{session('error')}}
	</div>
	@endif-->
	
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Users </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Users</a></li>
                  <li class="breadcrumb-item active" aria-current="page">List</li>
                </ol>
              </nav>
            </div>
            <div class="row">
             <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <!--<h4 class="card-title">Bordered table</h4>-->
                    <!--<p class="card-description"> Add class <code>.table-bordered</code>-->
                    </p>
                    <table id="example" class="table table-bordered">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> Name </th>
                          <th> Type </th>
                          <th> Email </th>
                          <th> Mobile </th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                     @foreach($users as $data)
                        <tr>
                          <td> {{$loop->iteration}} </td>
                          <td>  {{$data->name}} </td>
                          <td> {{$data->type}} </td>
                          <td> {{$data->email}} </td>
                          <td> {{$data->contact}} </td>
                          <!--<td> May 15, 2015 </td>-->
                          <td>
                              <a href="{{route('users.edit',$data->id)}}" type="button" style="padding:0.800rem 1.5rem !important;" class="btn btn-gradient-dark btn-sm btn-icon-text"><i class="mdi mdi-pencil btn-icon-append"></i></a>
                              <a href="{{route('users.delete',$data->id)}}" type="button" style="padding:0.800rem 1.5rem !important;" class="btn btn-gradient-danger btn-sm btn-icon-text"><i class="mdi mdi-delete btn-icon-append"></i></a>
                          </td>
                        </tr>
                       @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
         
        </div>
 @endsection
 @push('js')
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
 @endpush
 