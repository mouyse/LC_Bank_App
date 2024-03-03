<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreDepositRequest;
use App\Http\Requests\UpdateDepositRequest;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Transaction;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Auth;
use DB;


class AccountStatementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : View
    {
      
      return view('account-statements.index', [
          'statement' => Deposit::where('account_id',Auth::id())->latest()->paginate(1)
      ]);
    }
}
