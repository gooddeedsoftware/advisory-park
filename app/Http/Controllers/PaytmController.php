<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PaytmWallet;
use paytm\checksum\PaytmChecksumLibrary;
use App\Models\{Paytm,User,Payment,AdvisoryRequest};
use Auth;
use DB;
class PaytmController extends Controller
{
    public function paytmPayment(Request $request)
    {   
        // dd($request->all());
        DB::beginTransaction();
        
        try{
            
            $payment = PaytmWallet::with('receive');
            
            if($request->advisory_request_id){
                AdvisoryRequest::whereId($request->advisory_request_id)->update(['status'=>$request->status]);
            }
            
            $order_id = rand('1000000','9999999');
       
            $admin = User::whereType('admin')->first();  
            
            Paytm::create([
                  'order_id' => $order_id,
                  'sender_id' => $request->user_id,
                  'reciever_id' => $admin->id,
                  'advisor_id' => $request->advisor_id,
                  'advisory_request_id' => $request->advisory_request_id,
            ]);

            $payment->prepare([
              'order' => $order_id,
              'user' => 'paytmtest',
              'mobile_number' => '123456789',
              'email' => 'paytmtest@gmail.com',
              'amount' => $request->fees,
              'callback_url' => route('paytm.callback'),
            ]); 
            
            DB::commit();
    
            return $payment->receive();
            
        }catch(Throwable $e){
            DB::rollback();
            // return response()->json(['status'=>false,'message'=>$e]);
            return redirect()->back()->with('error',$e->getMessage());
        }
        
    }

    public function paytmCallback(Request $request)
    {   
        $auth = Auth::user();
       /* $myfile = fopen(time()."newfile.txt", "w") or die("Unable to open file!");
        $txt = json_encode($_POST);
        fwrite($myfile, $txt);
        fclose($myfile);*/
        
        $transaction = PaytmWallet::with('receive');
      
        $response = $transaction->response();
        
            if($transaction->isSuccessful()){
                
                    $portal_charge = portalCharge($response['TXNAMOUNT']);
                                            
                    $final_amount = (float)$response['TXNAMOUNT'] - (float)$portal_charge;
                    // $final_amount = (float)$request->fees;
                    
                
                    Paytm::whereOrderId($response['ORDERID'])->update([
                        'status'            =>      $response['STATUS'],
                        'order_id'          =>      $response['ORDERID'],
                        'transaction_id'    =>      $response['TXNID'],
                        'transaction_date'  =>      $response['TXNDATE'],
                        'amount'            =>      $response['TXNAMOUNT'],
                        'currency'          =>      $response['CURRENCY'],
                        'gateway_name'      =>      $response['GATEWAYNAME'],
                        'payment_mode'      =>      $response['PAYMENTMODE'],
                        'merchant_id'       =>      $response['MID'],
                        'response_code'     =>      $response['RESPCODE'],
                        'response_msg'      =>      $response['RESPMSG'],
                        'bank_name'         =>      $response['BANKNAME'],
                        'bank_txn_id'       =>      $response['BANKTXNID'],
                    ]); 
                    
                    
                    $admin = User::whereType('admin')->first();   
                    $final_wallet = (float)$admin->wallet + $portal_charge;
                    $admin->wallet = $final_wallet;    
                    $admin->save();  
                    
                        // AdvisoryRequest::create($data);
                            
              return view('paytm.paytm-success-page');
              
            }else if($transaction->isFailed()){
                
                Paytm::whereOrderId($response['ORDERID'])->update([
                        'status' => $response['STATUS'],
                        'order_id' => $response['ORDERID'],
                        'transaction_id' => $response['TXNID'] ?? null,
                        'transaction_date' => $response['TXNDATE'] ?? null,
                        'amount' => $response['TXNAMOUNT'],
                        'currency' => $response['CURRENCY'],
                        'gateway_name' => $response['GATEWAYNAME'] ?? null,
                        'payment_mode' => $response['PAYMENTMODE'] ?? null,
                        'merchant_id' => $response['MID'],
                        'response_code' => $response['RESPCODE'],
                        'response_msg' => $response['RESPMSG'],
                        'bank_name' => $response['BANKNAME'] ?? null,
                        'bank_txn_id' => $response['BANKTXNID'] ?? null,
                    ]);
                    
              return view('paytm.paytm-fail');
              
            }else if($transaction->isOpen()){
                
                Paytm::whereOrderId($response['ORDERID'])->update([
                        'name' => $auth->name,
                        'mobile' => $auth->contact,
                        'email' => $auth->email,
                        'status' => $response['STATUS'],
                        'order_id' => $response['ORDERID'],
                        'transaction_id' => $response['TXNID'] ?? null,
                        'transaction_date' => $response['TXNDATE'] ?? null,
                        'amount' => $response['TXNAMOUNT'],
                        'currency' => $response['CURRENCY'],
                        'gateway_name' => $response['GATEWAYNAME'] ?? null,
                        'payment_mode' => $response['PAYMENTMODE'] ?? null,
                        'merchant_id' => $response['MID'],
                        'response_code' => $response['RESPCODE'],
                        'response_msg' => $response['RESPMSG'],
                        'bank_name' => $response['BANKNAME'] ?? null,
                        'bank_txn_id' => $response['BANKTXNID'] ?? null,
                    ]); 
             
              return view('paytm.paytm-fail');
            }
            $transaction->getResponseMessage(); 
            
            $transaction->getOrderId(); 
            $transaction->getTransactionId();
        
        
    }

}
