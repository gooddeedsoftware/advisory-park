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
              <h3 class="page-title"> Payments </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Advisor Payments</a></li>
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
                    <table id="example" class="table table-bordered" width="100%">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> Payment Date </th>
                          <th> Transaction Id </th>
                          <th> Order Id </th>
                          <th> Advisor </th>
                          <th> Amount </th>
                          <th> Status </th>
                        </tr>
                      </thead>
                      <tbody>
                     @foreach($list as $data)
                        <tr>
                          <td> {{$loop->iteration}} </td>
                          <td> {{$data->transaction_date}} </td>
                          <td> {{$data->transaction_id}} </td>
                          <td>  {{$data->order_id}} </td>
                          <td> {{$data->advisor->name ?? ''}} </td>
                          <td> ₹ {{$data->amount}} </td>
                          <td> 
                                @if($data->status == 'TXN_SUCCESS')
                                    <span class="badge badge-success">SUCCESS</span>
                                @else
                                   <span class="badge badge-danger ">FAILURE</span>
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
            });
            
            
           /* $('.status').change(function(){
                let status = $(this).val();
                let id = $(this).data('id');
                let advisor_id = $(this).data('advisor_id');
                let amount = $(this).data('amount');
                
                $.ajax({
                    url:"{{route('request.change')}}",
                    type: "POST",
                    data: { id: id, advisor_id: advisor_id, amount:amount , status: status, _token: "{{csrf_token()}}"},
                    success:function(result){
                        if(!result.status){
                            toastr.error(result.message);
                            location.reload();
                        }
                        toastr.success(result.message);
                        location.reload();
                    }
                });
            });*/
        });
    </script>
 @endpush
 