<?php

namespace App\Http\Controllers;

use App\Models\Refund;
use App\Models\SendMoney;
use App\Models\Top;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(){

        if(Auth::user()->role == 1){

        $user = User::count();
        // $labels = ['Label 1', 'Label 2', 'Label 3','Label 4', 'Label 5', 'Label 6',  'Label 7'];
        // $data = [10, 20, 30,40,50,60,70];

        $online = Top::where('chennel', null)
        ->where('status', 1)
        ->whereMonth('created_at', date('m'))
        ->sum('amount');

        $refund = Refund::where('status', 1)
        ->whereMonth('created_at', date('m'))
        ->sum('refund_amount');

        $sent = SendMoney::where('status', 1)
        ->whereMonth('created_at', date('m'))
        ->sum('amount');

        $transWalletPayment = Transaction::where('status', 1)->where('chennel', 'Wallet payment')
        ->whereMonth('created_at', date('m'))
        ->sum('amt_paid');

        $onlinePayment = Transaction::where('status', 1)->where('chennel', 'Online Payment')
        ->whereMonth('created_at', date('m'))
        ->sum('amt_paid');

        $bankDeposit = Top::where('chennel', 1)
        ->where('status', 1)
        ->whereMonth('created_at', date('m'))
        ->sum('amount');

        $sentDenined = SendMoney::where('status', 2)
        ->whereMonth('created_at', date('m'))
        ->sum('amount');

        $users = User::count();
        // $currentMonth = Carbon::now()->month;
        // $weeklyTransactions = DB::table('transactions')
        // ->select('chennel', DB::raw('WEEK(created_at) as week'), DB::raw('SUM(amt_paid) as total_amt_paid'))
        // ->where('status', 1)
        // ->where('chennel', 'Wallet payment')
        // ->whereMonth('created_at', $currentMonth)
        // ->groupBy('chennel', 'week')
        // ->get();

        $outStanding = Transaction::where('status', 1)->where('balance', '>', 0)
        ->whereMonth('created_at', date('m'))
        ->sum('amt_paid');

             $labels[] = 'Monthly Outstanding';
             $data[] = $outStanding;

            $labels[] = 'Total Number of Users';
            $data[] = $users;

            $labels[] = 'Sent Money Denied';
            $data[] = $sentDenined;

            $labels[] = 'Paystack Deposit';
            $data[] = $online;

            $labels[] = 'Refund';
            $data[] = $refund;

            $labels[] = 'Sent';
            $data[] = $sent;

            $labels[] = 'Wallet Payment';
            $data[] = $transWalletPayment;

            $labels[] = 'Online Payment';
            $data[] = $onlinePayment;

            $labels[] = 'Bank Deposit';
            $data[] = $bankDeposit;
        $data = [
            'user'=>$user,
            'labels'=>$labels,
            'data'=>$data,
            'online'=>$online,
            'bankDeposit'=>$bankDeposit,
            'refund'=>$refund,
            'sent'=>$sent,
            'transWalletPayment'=>$transWalletPayment,
            'onlinePayment'=>$onlinePayment
        ];
    return view("admin.dashboard",$data);
    }else{
        return back();
    }
    }

    public function dashboardFatch(){
        $getTop = Top::with('chennel')->with('bank')->orderBy('created_at', 'desc')->latest()->take(10)->get();
        return response()->json([
            'status' => 200,
            'getTop' => $getTop,
        ]);
    }

}
