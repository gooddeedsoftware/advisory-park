<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{env('APP_NAME')}} - Admin</title>
        <!-- plugins:css -->
        <!--<link rel="stylesheet" href="{{asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css')}}">-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.7.95/css/materialdesignicons.min.css"  />
        <link rel="stylesheet" href="{{asset('admin/assets/vendors/css/vendor.bundle.base.css')}}">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
        <!--<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">-->
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"  />-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/fontawesome.min.css" />
    
        <!-- Layout styles -->
        <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">
        <script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
        <!-- End layout styles -->
        <!--<link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.ico')}}" />-->
        
        <style>
            .dt-buttons{
                font-size: 12px;
            }
            div.dt-buttons .dt-button {
                background: #f2edf3;
            }
            .page-item.active .page-link{
                background-color: #b66dff !important;
                border-color: #b66dff !important;
            }
        </style>
    </head>

    <body>
        <div class="container-scroller">
            
            @include('admin.includes.header') 
           <!-- PAGE CONTAINER-->
           
          <div class="container-fluid page-body-wrapper">
            @include('admin.includes.sidebar')
            
            @yield('content')
                       
          </div>
            <!-- END PAGE CONTAINER-->
        </div>
         <!-- plugins:js -->
        <script src="{{asset('admin/assets/vendors/js/vendor.bundle.base.js')}}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="{{asset('admin/assets/vendors/chart.js/Chart.min.js')}}"></script>
        <script src="{{asset('admin/assets/js/jquery.cookie.js')}}" type="text/javascript"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="{{asset('admin/assets/js/off-canvas.js')}}"></script>
        <script src="{{asset('admin/assets/js/hoverable-collapse.js')}}"></script>
        <script src="{{asset('admin/assets/js/misc.js')}}"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="{{asset('admin/assets/js/dashboard.js')}}"></script>
        <script src="{{asset('admin/assets/js/todolist.js')}}"></script>
        <!-- End custom js for this page -->
        
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>

        @stack('js')
    </body>
</html>
