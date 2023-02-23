<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Paytm Payment Gateway Integration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body>
    <div id="app">
        <style>
        .mt2{
            margin-top: 2%;
        }
        .payment
    	{
    		border:1px solid #28a745;
    		height:280px;
            border-radius:20px;
            background:#fff;
    	}
       .payment_header
       {
    	   background:#28a745;
    	   padding:20px;
           border-radius:20px 20px 0px 0px;
    	   
       }
       
       .check
       {
    	   margin:0px auto;
    	   width:50px;
    	   height:50px;
    	   border-radius:100%;
    	   background:#fff;
    	   text-align:center;
    	   animation: 0.75s ease-out forwards 0.75s;
       }
       
       .check i
       {
    	   vertical-align:middle;
    	   line-height:50px;
    	   font-size:30px;
    	   color : #28a745;
       }
    
        .content 
        {
            text-align:center;
        }
    
        .content  h1
        {
            font-size:25px;
            padding-top:25px;
        }
    
        .content a
        {
            width:200px;
            height:35px;
            color:#fff;
            border-radius:30px;
            padding:5px 10px;
            background:#28a745;
            transition:all ease-in-out 0.3s;
        }
    
        .content a:hover
        {
            text-decoration:none;
            background:#000;
        }
   
      
        </style>
        <main class="py-4">
            <div class="container">
               <div class="row">
                  <div class="col-md-6 mx-auto mt-5">
                     <div class="payment">
                        <div class="payment_header">
                           <div class="check"><i class="fa fa-check" aria-hidden="true"></i></div>
                        </div>
                        <div class="content">
                           <h1>Success !</h1>
                           <p>Payment Has been Successfully Received;<br/> Advisor'll be in touch you shortly!</p>
                           <a href="{{route('index')}}">Go to Home</a>
                        </div>
                        
                     </div>
                  </div>
               </div>
            </div>
        </main>
    </div>
</body>
</html>