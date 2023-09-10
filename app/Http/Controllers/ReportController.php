<?php

namespace App\Http\Controllers;

use App\Models\SendMoney;
use App\Models\Top;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function sendMoneyReport(){
      return view("Report.sendMoneyReport");
    }

    function sendMoneyReportFetch(){
         if(Auth::user()->role == 1){
            $request = SendMoney::orderBy('created_at', 'desc')->latest()->get();
        }
        $user = Auth::user()->name;
        return response()->json([
            'status'=>200,
            'request'=>$request,
            'user'=>$user
        ]);
    }
    function TransactionReport(){
        return view("Report.TransactionReport");
      }
    function TransactionReportFetch(){
        if(Auth::user()->role == 1){
            $request = Top::with('chennel')->with('bank')->with('user')->latest()->get();
        }
        $user = Auth::user()->name;
        return response()->json([
            'status'=>200,
            'request'=>$request,
            'user'=>$user
        ]);
    }
}
