<?php

namespace App\Http\Controllers;

use App\Models\Refund;
use App\Models\Top;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Console\View\Components\Warn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


public function request(){
return view("admin.request");
}



public function requestFatch(){
    $request = Refund::with('user')->where('status', 0)->orderBy('created_at', 'desc')->latest()->get();
    return response()->json([
        'status'=>200,
        'request'=>$request
    ]);
return view("admin.request");
}

public function requestApproval(Request $request, $id){
    $id = $request->id;
    $sum = Refund::where('id', $id)->first();
    $getRequestAmount =  Wallet::where('upi', $sum->upi)->value("wallet_amount");
    $remainingBalance = $getRequestAmount - $sum->refund_amount;
    Wallet::where('upi', $sum->upi)->update(['wallet_amount' => $remainingBalance]);
    Refund::where('id', $id)->update(['status' => 1, 'confirm_user' => Auth::user()->id]);
    return response()->json([
        'status'=>200,
        'message' => "Refund approved"
    ]);
}


public function getComment($id){
$getRefund = Refund::find($id);
return response()->json([
    'status'=>200,
    'getRefund' =>$getRefund
]);
}

public function requestdisapproval(Request $request){
    $id = $request->comment_id;
    $comment = $request->comment;
    Refund::where('id', $id)->update(['status' => 2,'comment'=>$comment , 'confirm_user' => Auth::user()->id]);
    return response()->json([
        'status'=>200,
        'message' => "Refund Denied"
    ]);
}

public function verify_online_payment(Request $request,$reference){
    $sec = "sk_test_8cb8a50307fe8ed59da50fcdbcf1f2f94acd4487";
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $sec",
            "Cache-Control: no-cache",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $new_data = json_decode($response);
    if ($new_data->status == true) {
        $upi = $new_data->data->metadata->upi;
        $inv_amount = $new_data->data->metadata->inovice_amt;
        $amount = $new_data->data->amount / 100;
        $inp = new Transaction();
        if ($request->hasFile('invoice_file')) {
            $file = $request->file('invoice_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/slip', $filename);
            $inp->invoice_file = $filename;
        }
        $inp->chennel = "Online Payment";
        $inp->fname = Auth::user()->name;
        $inp->upi = $upi;
        $inp->inovice_amt = $inv_amount;
        $inp->amt_paid = $amount;
        $balance = $inv_amount - $amount;
        $inp->balance = $balance;
        $inp->status = 0;
        $inp->token_key = $reference;
        $inp->date = date("Y-m-d");
        if ($amount > $inv_amount) {
        return response()->json([
            'status' => 404,
            'message' => "Please verify the invoice amount or the amount you have paid",
        ]);
        }
        else{
            $inp->save();
            return [$new_data];
        }
    }
}

public function  verify_payment(Request $request,$reference) {
    $sec = "sk_test_8cb8a50307fe8ed59da50fcdbcf1f2f94acd4487";
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer $sec",
        "Cache-Control: no-cache",
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
   $new_data = json_decode($response);

   //bank code for paystack is 500

   if($new_data->status == true){
    $upi =  $new_data->data->metadata->upi;
    $amount = $new_data->data->amount / 100;
    $inp = new Top();
    $inp->upi =   $upi ;
    $inp->user_id = Auth::id();
    $inp->amount =$amount;
    $inp->token_key = $reference;
    $inp->date = date("Y-m-d");
    $inp->year = date("Y");
    $inp->status  = 1;
    $inp->save();
    $getWallet = Wallet::where('upi',   $upi)->first();
    $prv = $getWallet->wallet_amount;
    $newAmount = $prv +  +$amount;
    Wallet::where('upi', $new_data->data->metadata->upi)->update(['wallet_amount' => $newAmount]);
    // $responseMessage = "Payment verification was successful.";
    return [$new_data];
   }
}

public function payment(){

return view("payment.payment");

}


public function getDepositComment($id){
    $getDeposit = Top::find($id);
    return response()->json([
        'status'=>200,
        'getDeposit' => $getDeposit
    ]);
    }


 public function requestdeposit(Request $request){
        $id = $request->comment_id;
        $comment = $request->comment;
        Top::where('id', $id)->update(['status' => 2,'comment'=>$comment , 'confirm_user' => Auth::user()->id]);
        return response()->json([
            'status'=>200,
            'message' => "Payment Denied"
        ]);
    }


public function topfetch(){
$getTop = Top::with('chennel')->with('bank')->where('status', 0)->orderBy('created_at','desc')->Latest()->get();
return response()->json([
    'status'=>200,
    'getTop'=>$getTop
]);
}

    public function awaiting(){
        return view("payment.awaiting");
    }

 public function status_update(Request $request, $id){
    $id = $request->id;
    $amt = Top::where('id', $id)->first();
    $getRequestAmount =  Wallet::where('upi', $amt->upi)->value("wallet_amount");
    if($getRequestAmount > 0){
        $total = $amt->amount+ $getRequestAmount;
        Wallet::where('upi', $amt->upi)->update(['wallet_amount' => $total]);
    }else{
        $wallet = new Wallet();
        $wallet->upi = $amt->upi;
        $wallet->wallet_amount = $amt->amount;
        $wallet->save();
    }
    Top::where('id', $id)->update(['status' => 1, 'confirm_user' => Auth::user()->id]);
    return response()->json([
        'status'=>200,
        'message'=>"Status updated"
    ]);
    }


public function top_up_store(Request $request){
 if($request['file']){
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
             $file->storeAs('public/slip', $filename);
            }
            $inp = request()->validate([
                'amount'=>'required',
                'chennel'=>'required',
            ]);
            $token = bin2hex(random_bytes(10).Auth::user()->h_number);
            $inp['token_key'] = $token;
            $inp['user_id'] = Auth::id();
            $inp['upi'] = Auth::h_number();
            $inp['file']=$filename;
            $inp['date']= date("Y-m-d");
            $inp['year']= date("Y");
            Top::create($inp);
            return response()->json([
                'status'=>200,
                'message'=>"Top up made successfully"
            ]);
      }



      public function top_up_transwction(Request $request)
      {

        if($request['file']){
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
             $file->storeAs('public/slip', $filename);
            }
            $inp = request()->validate([
                'amount'=>'required',
                'chennel'=>'required',
                'bank' => 'required',
            ]);
            $inp['bank']= $request->input('bank');
            $token = bin2hex(random_bytes(10).Auth::user()->h_number);
            $inp['token_key'] = $token;
            $inp['user_id'] = Auth::id();
            $inp['upi'] = Auth::user()->h_number;
            $inp['file']=$filename;
            $inp['date']= date("Y-m-d");
            $inp['year']= date("Y");
            Top::create($inp);
            return response()->json([
                'status'=>200,
                'message' => "Bank top up made successfully"
            ]);
      }
}
