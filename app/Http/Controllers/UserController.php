<?php

namespace App\Http\Controllers;

use App\Models\Banks;
use App\Models\Chennels;
use App\Models\Refund;
use App\Models\SendMoney;
use App\Models\Top;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;
use GuzzleHttp;
use GuzzleHttp\Client as GuzzleHttpClient;

class UserController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function medical_payment(){
        return view("user.medical_payment");
    }

    public function wallet_payment(Request $request)
    {
        if($request['invoice_file']){
            $file = $request->file('invoice_file');
            $filename = $file->getClientOriginalName();
             $file->storeAs('public/slip', $filename);
            }
        $inp = request()->validate([
            'fname'=> "required",
            'upi'=> "required",
            'amt_paid'=> "required",
            'invoice_file'=> "required",
            'inovice_amt'=>"required",
        ]);
        $inp['status']= 0;
        $inp['balance']= 0;
        $inp['date']= date("Y-m-d");
        $inp['chennel']= "Wallet payment";
        $inp['invoice_file']=  $filename;
        $getWallet = Wallet::where('upi', $inp['upi'])->first();
        if($inp["amt_paid"] != $inp["inovice_amt"]){
            return response()->json([
                'status'=> 400,
                'message'=>'Kindly check your invoice amount and the amount you entered.'
            ]);
        }
        else if($inp["amt_paid"] > $getWallet->wallet_amount){
            return response()->json([
                'status'=> 400,
                'message'=>'Account balance is insufficient.'
            ]);
        }else{
            Transaction::create($inp);
            return response()->json([
                'status'=> 200,
                'message'=>'Payment successful. Kindly wait for approval.'
            ]);
        }
    }

    public function  send() {
        return view("admin.send");
    }

    public function requestApprovalSend(Request $request, $id){
        $id = $request->id;
        $sum = SendMoney::where('id', $id)->first();
        $getRequestAmount =  Wallet::where('upi', $sum->upi)->value("wallet_amount");
        if($sum->amount  > $getRequestAmount){
            return response()->json([
                'status'=>400,
                'message' => "Account balance is insufficient."
            ]);
        }
        else{
            $remainingBalance = $getRequestAmount - $sum->amount;
            Wallet::where('upi', $sum->upi)->update(['wallet_amount' => $remainingBalance]);
            SendMoney::where('id', $id)->update(['status' => 1, 'confirm_user' => Auth::user()->id]);
            return response()->json([
                'status'=>200,
                'message' => "Amount approved successfully"
            ]);
        }
    }

    public function getCommentSend($id){
        $getRefund = SendMoney::find($id);
        return response()->json([
            'status'=>200,
            'getRefund' =>$getRefund
        ]);
    }

    public function requestdisapprovalSend(Request $request){
        $id = $request->comment_id;
        $comment = $request->comment;
        SendMoney::where('id', $id)->update(['status' => 2,'comment'=>$comment , 'confirm_user' => Auth::user()->id]);
        return response()->json([
            'status'=>200,
            'message' => "Request Denied"
        ]);
    }

    public function sendFatch(){
        if(Auth::user()->role == 1){
            $request = SendMoney::orderBy('created_at', 'desc')->latest()->get();
        }else{
            $request = SendMoney::where('upi', Auth::user()->h_number)->orderBy('created_at', 'desc')->latest()->get();
        }
        $user = Auth::user()->name;
        return response()->json([
            'status'=>200,
            'request'=>$request,
            'user'=>$user
        ]);
    }

    public function sendMoney(){
        $inp = request()->validate([
            'fname'=> "required",
            'upi'=> "required",
            'amount'=> "required",
        ]);
        $getWallet = Wallet::where('upi', $inp['upi'])->first();
        if($inp["amount"] > $getWallet->wallet_amount){
            return response()->json([
                'status'=> 400,
                'message'=>'Account balance is insufficient.'
            ]);
        }else{
            SendMoney::create($inp);
            return response()->json([
                'status'=> 200,
                'message'=>'Sent successful. Kindly wait for approval.'
            ]);
        }
    }

public function FatchMedical(){
    if(Auth::user()->role == 1){
        $getTop = Transaction::where('status' , 0)->orderBy('created_at', 'desc')->latest()->get();
    }
    else{
        $getTop = Transaction::where('upi', Auth::user()->h_number)->orderBy('created_at', 'desc')->latest()->get();
    }
    return response()->json([
        'status'=>200,
        'getTop'=>$getTop
    ]);

    }

    public function getTransactionComment($id){
        $Transaction = Transaction::find($id);
        return response()->json([
            'status'=>200,
            'geTransactiont' => $Transaction
        ]);
    }

    public function status_update_Transaction(Request $request, $id){
        $id = $request->id;
          $getAmount = Transaction::where('id', $id)->first();
         if($getAmount->chennel == 'Wallet payment'){
            $getWallet = Wallet::where('upi', $getAmount->upi)->first();
            $totalBalance =$getWallet->wallet_amount - $getAmount->amt_paid;
            Wallet::where('upi', $getAmount->upi)->update(['wallet_amount' => $totalBalance]);
            Transaction::where('id', $id)->update(['status' => 1, 'confirm_payment_by' => Auth::user()->id]);
              return response()->json([
                'status'=>200,
                'message'=>"Payment Approved successfully."
            ]);
        }else{
            Transaction::where('id', $id)->update(['status' => 1, 'confirm_payment_by' => Auth::user()->id]);
            return response()->json([
                'status'=>200,
                'message'=>"Payment Approved successfully."
            ]);
        }


        // $client = new \GuzzleHttp\Client();
        // $response = $client->post(
        //     'https://www.bulksmsnigeria.com/api/v1/sms/create',
        //     [
        //         'headers' => [
        //             'Accept' => 'application/json',
        //         ],
        //         'query' => [
        //             'api_token'=> 'zqslidqww633w7V8I9I7npo2fuPK9D7e7Kdi14mvQd3FGOdCG3XZh8UK2x72',
        //             'to'=> '23426456658',
        //             'from'=> 'ESH',
        //             'body'=>'Perious,Your payment for the DSCHC  has been comfirmed,please be informed that there is a minimum of 60days waiting period before you can access care. For more  information call 08026456658',
        //             'gateway'=> '0',
        //             'append_sender'=> '0',
        //         ],
        //     ]
        // );
        // dd($response);



    }


    public function requestTransaction(Request $request){
        $id = $request->comment_id;
        $comment = $request->comment;
        Transaction::where('id', $id)->update(['status' => 2,'comment'=>$comment , 'confirm_payment_by' => Auth::user()->id]);
        return response()->json([
            'status'=>200,
            'message' => "Payment Denied"
        ]);
    }

    public function medical_payment_status(Request $request, $id){
        $id = $request->id;
        Transaction::where('id', $id)->update(['status' => 1, 'confirm_payment_by' => Auth::user()->id]);
        return response()->json([
            'status'=>200,
            'message' => "Refund approved successfully"
        ]);
    }

    public function dashboard_user(Request $request){
        if(Auth::user()->role == 2){
            $totalWallet = Wallet::where('upi', Auth::user()->h_number)->first("wallet_amount");
            $bank = Banks::get();
            $chennel = Chennels::get();
            $data =[
                'totalWallet' =>$totalWallet,
                'bank'=>$bank,
                'chennel'=>$chennel
            ];
        }
        else{
            return back();
        }
        return view("user.dashboard_user",$data);
    }


    public function getRelatedRecords(Request $request)
        {
            $selectedChannelId = $request->input('channel');

            // Query the banks table to fetch names related to the selected channel ID
            $relatedBanks = DB::table('banks')
                ->where('chennel_id', $selectedChannelId)
                ->get();

            return response()->json(['relatedBanks' => $relatedBanks]);
        }

    public function dashboard_fetch(){
        $getTop = Top::with('chennel')->with('bank')->where('upi', Auth::user()->h_number)->orderBy('created_at', 'desc')->latest()->get();
        return response()->json([
            'status' => 200,
            'getTop' => $getTop,
        ]);
    }

    function list(){

        if(Auth::user()->role == 2){
            return view("user.list");
        }else{
            return back();
        }
    }

    public function Fatchlist()
    {
        $request = Refund::orderBy('created_at','desc')->where('upi', Auth::user()->h_number)->Latest()->get();
        return response()->json([
            'status'=>200,
            'request'=>$request
        ]);
    }

    public function refund()
    {
        $sum = Top::where('user_id', Auth::id())->where('status', 1)->get();
        $total = $sum->sum('amount');
        $inp = request()->validate([
            'refund_amount' => 'required',
            'refund_reason' => 'required',
        ]);
        if ($total < $inp["refund_amount"]) {
            return response()->json([
                'status' => 400, // Changed status to 400 for a bad request
                'message' => 'Your balance is low for your request',
            ]);
        } else {
            $inp["upi"] = Auth::user()->h_number;
            Refund::create($inp);
            return response()->json([
                'status' => 200,
                'message' => 'Refund request submitted successfully',
            ]);
        }
    }
}
