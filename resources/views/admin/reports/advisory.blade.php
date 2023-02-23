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
              <h3 class="page-title"> Reports </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Advisory</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Report</li>
                </ol>
              </nav>
            </div>
            
            <div class="card">
                <div class="card-body" style="padding: 20px 20px 10px 20px;">
                    
                     <form action="{{route('advisory.report')}}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input class="form-control border-primary" type="date"  id="start_date" name="start_date" value="{{ Request::get('start_date') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input class="form-control border-primary" type="date"  id="end_date" name="end_date" value="{{ Request::get('end_date') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-select border-primary" name="status">
                                        <option value="">Status</option>
                                        <option value="1" {{ Request::get('status') == '1' ? 'selected' : '' }}>Pending</option>
                                        <option value="2" {{ Request::get('status') == '2' ? 'selected' : '' }}>Accepted</option>
                                        <option value="3" {{ Request::get('status') == '3' ? 'selected' : '' }}>Rejected</option>
                                        <option value="4" {{ Request::get('status') == '4' ? 'selected' : '' }}>Payment Done</option>
                                        <option value="5" {{ Request::get('status') == '5' ? 'selected' : '' }}>Completed</option>
                                        <option value="6" {{ Request::get('status') == '6' ? 'selected' : '' }}>Incompleted</option>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-select border-primary" name="advisor">
                                        <option value="">Advisors</option>
                                       @foreach(App\Models\AdvisoryRequest::with('advisors')->distinct('advisor_id')->get('advisor_id') as $adv)
                                        <option value="{{$adv->advisors->id}}" {{ Request::get('advisor') == $adv->advisors->id ? 'selected' : '' }}>{{$adv->advisors->name}}</option>
                                       @endforeach
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-select border-primary" name="rating">
                                        <option value="">Rating</option>
                                        <option value="1" {{ Request::get('rating') == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ Request::get('rating') == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ Request::get('rating') == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ Request::get('rating') == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5" {{ Request::get('rating') == '5' ? 'selected' : '' }}>5</option>
                                       
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <button class="btn btn-primary btn-sm" type="submit"><i class="mdi mdi-filter"></i> Filter</button>
                            </div>
                            <div class="col-md-2">
                                <a type="button" href="{{route('advisory.report')}}" class="btn btn-secondary btn-sm" type="submit"><i class="mdi mdi-refresh"></i> Refresh</a>
                            </div>
                        </div>
                      </form>
                </div>
            </div>
	     <br>
            
            <div class="row">
             <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <!--<h4 class="card-title">Bordered table</h4>-->
                    <!--<p class="card-description"> Add class <code>.table-bordered</code>-->
                    </p>
                    <table id="example" class="table table-bordered" style="width:100%">
                      <thead>
                        <tr style="background:#f2edf3;">
                          <th> # </th>
                          <th> Date </th>
                          <th> Advisory/Requirement </th>
                          <th> Type </th>
                          <th> Rating </th>
                          <th> Feedback</th>
                          <th> Advisors </th>
                          <th> Status</th>
                         
                        </tr>
                      </thead>
                      <tbody>
                     @foreach($advisory as $data)
                        <tr>
                          <td> {{$loop->iteration}} </td>
                          <td>  {{date('d-m-Y h:i A',strtotime($data->created_at))}} </td>
                          <td>  {{$data->requirement}} </td>
                           <td> 
                                {{$data->lead_type}}
                            </td>
                           
                            <td> {{$data->rating }} </td>
                          
                            <td> 
                                {{$data->feedback}}
                            </td>
                            <td> 
                                {{$data->advisors->name}} 
                            </td>
                              <td>
                                <span class="badge badge-outline-primary">
                                @if($data->status == '1') 
                                    Pending 
                                @elseif($data->status == '2') 
                                    Accepted
                                @elseif($data->status == '3') 
                                    Rejected 
                                @elseif($data->status == '4') 
                                    Payment Done 
                                @elseif($data->status == '5') 
                                    Completed 
                                @elseif($data->status == '6') 
                                    Dismissed 
                                @elseif($data->status == '7') 
                                    Feedback Done
                                @elseif($data->status == '8') 
                                    Re-requested
                                @endif
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
                 dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            });
        });
    </script>
 @endpush
 