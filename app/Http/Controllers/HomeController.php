<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\Withdrawal;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $deposited_amount = Deposit::where('account_id',Auth::id())->sum('amount');
        $withdrawan_amount = Withdrawal::where('account_id',Auth::id())->sum('amount');
        $account_balance = $deposited_amount - $withdrawan_amount;
        return view('home',[
          'user_email' => Auth::user()->email,
          'account_balance' => $account_balance,
        ]);
    }

}
