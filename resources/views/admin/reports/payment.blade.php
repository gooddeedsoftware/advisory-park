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
                  <li class="breadcrumb-item"><a href="#">Payments </a></li>
                  <li class="breadcrumb-item active" aria-current="page">Report</li>
                </ol>
              </nav>
            </div>
            
            <div class="card">
                <div class="card-body" style="padding: 20px 20px 10px 20px;">
                    
                     <form action="{{route('payment.report')}}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!--<label class="form-label">Start Date</label>-->
                                    <input class="form-control border-primary" type="date"  id="start_date" name="start_date" value="{{ Request::get('start_date') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!--<label class="form-label">End Date</label>-->
                                    <input class="form-control border-primary" type="date"  id="end_date" name="end_date" value="{{ Request::get('end_date') }}">
                                </div>
                            </div>
                            <!--<div class="col-md-3">
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
                            </div>-->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!--<label class="form-label">Advisors</label>-->
                                    <select class="form-select border-primary" name="advisor">
                                        <option value="">Select Advisor</option>
                                       @foreach(App\Models\Paytm::with('advisor')->distinct('advisor_id')->get('advisor_id') as $adv)
                                        <option value="{{$adv->advisor->id}}" {{ Request::get('advisor') == $adv->advisor->id ? 'selected' : '' }}>{{$adv->advisor->name}}</option>
                                       @endforeach
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!--<label class="form-label">Advisors</label>-->
                                    <select class="form-select border-primary" name="advisory_type">
                                        <option value="">Select Type</option>
                                       
                                        <option value="post" {{ Request::get('advisory_type') == 'post' ? 'selected' : '' }}>Post</option>
                                        <option value="requirement" {{ Request::get('advisory_type') == 'requirement' ? 'selected' : '' }}>Requirement</option>
                                       
                                       
                                    </select>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-2">
                                <button class="btn btn-primary btn-sm" type="submit"><i class="mdi mdi-filter"></i> Filter</button>
                            </div>
                            <div class="col-md-2">
                                <a type="button" href="{{route('payment.report')}}" class="btn btn-secondary btn-sm" type="submit"><i class="mdi mdi-refresh"></i> Refresh</a>
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
                          <th> Advisory / Requirement </th>
                          <th> Advisory Type </th>
                          <th> Sender </th>
                          <th> Amount </th>
                          <th> Portal Charge </th>
                          <th> Final Amount </th>
                          <th> Reciever </th>
                          <th> Status</th>
                         
                        </tr>
                      </thead>
                      <tbody>
                     @foreach($payment as $data)
                        <tr>
                            <td> {{$loop->iteration}} </td>
                            <td>  {{date('d-m-Y h:i A',strtotime($data->created_at))}} </td>
                            <td>  <a href='#' target="_blank">{{$data->advisory_request->requirement ?? ''}}</a> </td>
                            <td>  {{$data->advisory_request->lead_type ?? ''}} </td>
                            <td>  {{$data->sender->name ?? ''}} </td>
                            <td>  {{$data->amount}} </td>
                            <td>  {{@portalCharge($data->amount)}} </td>
                            <td>  {{$data->amount - @portalCharge($data->amount)}} </td>
                            
                            <td> 
                                {{$data->reciever->name ?? ''}}
                            </td>
                            <td> 
                                <span class="badge {{$data->status == 'TXN_SUCCESS' ? 'badge-success' : 'badge-danger'}}">{{$data->status == 'TXN_SUCCESS' ? 'SUCCESS' : 'FAILURE'}}</span>
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
 