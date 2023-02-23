 @extends('admin.layout.app')
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
              <h3 class="page-title"> Requirements </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Requirements</a></li>
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
                          <th> Title </th>
                          <th> Category </th>
                          <th> Skill </th>
                          <th> Tag </th>
                          <th> Created By </th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                     @foreach($requirements as $data)
                        <tr>
                          <td> {{$loop->iteration}} </td>
                          <td>  {{$data->title}} </td>
                          
                          @php $v = \DB::select("select name from categories where id in ($data->category)"); @endphp
                          
                          <td> @foreach($v as $k) {{$k->name}}, @endforeach</td>
                          @php $v = \DB::select("select name from skills where id in ($data->skill)"); @endphp
                          <td> @foreach($v as $k) {{$k->name}}, @endforeach </td>
                          @php $v = \DB::select("select name from tags where id in ($data->tag)"); @endphp
                          <td> @foreach($v as $k) {{$k->name}}, @endforeach </td>
                          @php $v = \DB::select("select name from users where id in ($data->created_by)"); @endphp
                          <td> @foreach($v as $k) {{$k->name}} @endforeach  </td>
                          <td>
                              <a href="{{route('req.edit',$data->id)}}" type="button" class="btn btn-gradient-dark btn-sm btn-icon-text btn-sm"><i class="mdi mdi-pencil btn-icon-append"></i></a>
                              <a href="{{route('req.delete',$data->id)}}" type="button" class="btn btn-gradient-danger btn-sm btn-icon-text btn-sm"><i class="mdi mdi-delete btn-icon-append"></i></a>
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
            $('#example').DataTable({
                "scrollX": true,
            });
        });
    </script>
 @endpush
 