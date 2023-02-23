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
              <h3 class="page-title"> Categories </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Categories</a></li>
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
                          <th> Status </th>
                          <!--<th> Amount </th>-->
                          <!--<th> Deadline </th>-->
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                     @foreach($category as $data)
                        <tr>
                          <td> {{$loop->iteration}} </td>
                          <td>  {{$data->name}}</td>
                         <!-- <td>
                            <div class="progress">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>-->
                          <td> <button type="button" class="btn btn-gradient-{{($data->status == '1') ? 'success' : 'danger' }}">{{($data->status == '1') ? 'Active' : 'Inactive' }}</button></td>
                          <!--<td> May 15, 2015 </td>-->
                          <td>
                              <a href="{{route('category.edit',$data->id)}}" type="button" class="btn btn-gradient-dark btn-sm btn-icon-text"> Edit <i class="mdi mdi-pencil btn-icon-append"></i></a>
                              <a href="{{route('category.delete',$data->id)}}" type="button" class="btn btn-gradient-danger btn-sm btn-icon-text"> Delete <i class="mdi mdi-delete btn-icon-append"></i></a>
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
 