<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreDepositRequest;
use App\Http\Requests\UpdateDepositRequest;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Transfer;

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

      $all_transactions = DB::select("
      SELECT deposits.amount,deposits.created_at, 'Credit' as type, '' as receiver FROM deposits WHERE deposits.account_id=".Auth::id()."
        UNION
      SELECT withdrawals.amount,withdrawals.created_at, 'Debit' as type,'' as receiver FROM withdrawals WHERE withdrawals.account_id=".Auth::id()."
        UNION
      SELECT transfers.amount, transfers.created_at,transfers.sender_id, transfers.receiver_id FROM transfers WHERE transfers.receiver_id=".Auth::id()." OR transfers.sender_id=".Auth::id()." ORDER BY created_at
      ");

      // dd($all_transactions);

      return view('account-statements.index', [
          'transactions' => $all_transactions,
      ]);
    }
}
