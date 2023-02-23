<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use PaytmWallet;
use paytm\checksum\PaytmChecksumLibrary;
use App\Models\{PaymentRequest,Payment,User,AdvisorPayment,Paytm};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class PaymentController extends Controller
{
    
    /*public function paymentRequestList(Request $request)
    {
        $request = Payment::where('payment_type','Payment Request')->latest()->get();
        return view('admin.payments.list',compact('request'));  
    }*/
    
    public function advisorPaymentList(Request $request)
    {
        $list = AdvisorPayment::with('advisor')->latest()->get();
        return view('admin.advisor-payments.list',compact('list'));  
    }
    
    public function requestChange(Request $request)
    {   
        // dd($request->all());
        if($request->ajax()){
            Payment::whereId($request->id)->update(['status'=>$request->status,'cr_dr'=>'Credit']);
            
            $advisor = User::find($request->advisor_id);
            
            $prv_wallet = (float)$advisor->wallet;
            $amount = (float)$request->amount;
            
            $final_wallet = $prv_wallet - $amount;
            
            $advisor->wallet = $final_wallet;
            
            $advisor->save();
            
            return response()->json(['status'=>true,'message'=>'Payment Approved !']);
        }
        return response()->json(['status'=>false,'message'=>'Something went wrong !']);
    }
    
    
    /*public function advisorPayment(Request $request)
    {
        // dd($request->all());
        
        DB::beginTransaction();
        
        try{
            
            if(Auth::user()->wallet >= $request->amount){
                
                Paytm::where('advisor_id',$request->advisor_id)->update([
                                                'payment_type' => 'To Advisor Payment'
                                                ]);
                AdvisorPayment::create([
                                    'admin_id' => Auth::user()->id,
                                    'advisor_id' => $request->advisor_id,
                                    'amount' => $request->amount,
                                    'status' => 'Success'
                                    ]);
                                    
                $final_wallet = (int)Auth::user()->wallet - (int)$request->amount;
                                    
                User::whereId(Auth::user()->id)->update(['wallet'=>$final_wallet]);
                
                DB::commit();
                
                return response()->json(['status'=>true,'message'=>'Payment Paid Successful!']);
            }else{
                return response()->json(['status'=>false,'message'=>'Insufficient Fund.']);
            }
        }catch(Throwable $e){
            DB::rollback();
            return response()->json(['status'=>false,'message'=>$e]);
        }
        
        
    }*/
    
    
    public function advPay(Request $request)
    {   
        //  dd($request->all());
            
        $admin = User::whereType('admin')->first(); 
        
        DB::beginTransaction();
        
        try{
            
            if($admin->wallet >= $request->amount){
                
                
                
                $payment = PaytmWallet::with('receive');
                    
                    $order_id = rand('1000000','9999999');
                    
                    AdvisorPayment::create([
                          'order_id' => $order_id,
                          'admin_id' => $admin->id,
                          'advisor_id' => $request->advisor_id,
                    ]);
        
                    $payment->prepare([
                      'order' => $order_id,
                      'user' => 'paytmtest',
                      'mobile_number' => '123456789',
                      'email' => 'paytmtest@gmail.com',
                      'amount' => $request->amount,
                      'callback_url' => route('adv.pay.callback'),
                    ]); 
                    
                    
                    DB::commit();
            
                    return $payment->receive();
            }else{
                // return response()->json(['status'=>false,'message'=>'Insufficient Fund.']);
                return redirect()->back()->with('error','Insufficient Fund.');
            }
        }catch(Throwable $e){
            DB::rollback();
            // return response()->json(['status'=>false,'message'=>$e]);
            return redirect()->back()->with('error',$e->getMessage());
        }
        
    }

    public function advPayCallback(Request $request)
    {   

        $auth = Auth::user();

        $transaction = PaytmWallet::with('receive');
      
        $response = $transaction->response();
        
        // dd($response);
        
            if($transaction->isSuccessful()){
                
                
                    AdvisorPayment::whereOrderId($response['ORDERID'])->update([
                        
                        'status'            =>    $response['STATUS'],
                        'order_id'          =>    $response['ORDERID'],
                        'transaction_id'    =>    $response['TXNID'],
                        'transaction_date'  =>    $response['TXNDATE'],
                        'amount'            =>    $response['TXNAMOUNT'],
                        'currency'          =>    $response['CURRENCY'],
                        'gateway_name'      =>    $response['GATEWAYNAME'],
                        'payment_mode'      =>    $response['PAYMENTMODE'],
                        'merchant_id'       =>    $response['MID'],
                        'response_code'     =>    $response['RESPCODE'],
                        'response_msg'      =>    $response['RESPMSG'],
                        'bank_name'         =>    $response['BANKNAME'],
                        'bank_txn_id'       =>    $response['BANKTXNID'],
                    ]); 
                    
                        
                    $dd = AdvisorPayment::whereOrderId($response['ORDERID'])->first('advisor_id');
                    
                    if($dd)
                        Paytm::whereAdvisorId($dd->advisor_id)->update([
                            'payment_type' => 'To Advisor Payment'
                            ]);
                    
                    
                    $final_wallet = (int)$auth->wallet - (int)$response['TXNAMOUNT'];
                    
                    // dd((string)$final_wallet);
                                    
                    User::whereId($auth->id)->update(['wallet'=>(string)$final_wallet]);
                    
            //   return response()->json(['status'=>true]);
              return view('admin.advisor-payments.paytm-success-page');
              
            }else if($transaction->isFailed()){
                
                AdvisorPayment::whereOrderId($response['ORDERID'])->update([
                        'status'            => $response['STATUS'],
                        'order_id'          => $response['ORDERID'],
                        'transaction_id'    => $response['TXNID'] ?? null,
                        'transaction_date'  => $response['TXNDATE'] ?? null,
                        'amount'            => $response['TXNAMOUNT'],
                        'currency'          => $response['CURRENCY'],
                        'gateway_name'      => $response['GATEWAYNAME'] ?? null,
                        'payment_mode'      => $response['PAYMENTMODE'] ?? null,
                        'merchant_id'       => $response['MID'],
                        'response_code'     => $response['RESPCODE'],
                        'response_msg'      => $response['RESPMSG'],
                        'bank_name'         => $response['BANKNAME'] ?? null,
                        'bank_txn_id'       => $response['BANKTXNID'] ?? null,
                    ]);
                    
                // return response()->json(['status'=>false]);
              return view('admin.advisor-payments.paytm-fail');
              
            }else if($transaction->isOpen()){
                
                AdvisorPayment::whereOrderId($response['ORDERID'])->update([
                        'name'              => $auth->name,
                        'mobile'            => $auth->contact,
                        'email'             => $auth->email,
                        'status'            => $response['STATUS'],
                        'order_id'          => $response['ORDERID'],
                        'transaction_id'    => $response['TXNID'] ?? null,
                        'transaction_date'  => $response['TXNDATE'] ?? null,
                        'amount'            => $response['TXNAMOUNT'],
                        'currency'          => $response['CURRENCY'],
                        'gateway_name'      => $response['GATEWAYNAME'] ?? null,
                        'payment_mode'      => $response['PAYMENTMODE'] ?? null,
                        'merchant_id'       => $response['MID'],
                        'response_code'     => $response['RESPCODE'],
                        'response_msg'      => $response['RESPMSG'],
                        'bank_name'         => $response['BANKNAME'] ?? null,
                        'bank_txn_id'       => $response['BANKTXNID'] ?? null,
                    ]); 
             
                // return response()->json(['status'=>false]);
              return view('admin.advisor-payments.paytm-fail');
            }
            
            $transaction->getResponseMessage(); 
            $transaction->getOrderId(); 
            $transaction->getTransactionId();
        
        
    }
   /* 
    public function advPaySuccessPage()
    {
        return view('admin.advisor-payments.paytm-success');
    }
    
    public function advPayFailPage()
    {
        return view('admin.advisor-payments.paytm-fail');
    }*/
	
}
