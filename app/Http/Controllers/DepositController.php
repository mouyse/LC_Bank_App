<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepositRequest;
use App\Http\Requests\UpdateDepositRequest;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Transaction;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Auth;

class DepositController extends Controller
{
    protected $account_balance;

    public function __construct(){


        $this->middleware(function ($request, $next) {
            $deposited_amount = Deposit::where('account_id',Auth::id())->sum('amount');
            $withdrawn_amount = Withdrawal::where('account_id',Auth::id())->sum('amount');
            $this->account_balance = $deposited_amount - $withdrawn_amount;

            return $next($request);
        });

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : View
    {
      return view('deposits.index', [
          'deposits' => Deposit::where('account_id',Auth::id())->latest()->paginate(10),
          'account_balance' => $this->account_balance,
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() : View
    {
      return view('deposits.create',[
        'account_balance' => $this->account_balance,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDepositRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepositRequest $request) : RedirectResponse
    {
      $deposit = Deposit::create(
        [
          'account_id' => Auth::id(),
          'amount' => $request->input('amount'),
        ]
      );
      return redirect()->route('deposits.index')
              ->withSuccess('Amount is deposited successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function show(Deposit $deposit) : View
    {
        return view('deposits.show', [
            'deposit' => $deposit,
            'account_balance' => $this->account_balance,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function edit(Deposit $deposit) : View
    {
        return view('deposits.edit', [
            'deposit' => $deposit,
            'account_balance' => $this->account_balance,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDepositRequest  $request
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepositRequest $request, Deposit $deposit) : RedirectResponse
    {
        $deposit->update($request->all());
        return redirect('/deposits/')
                ->withSuccess('Deposited amount is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deposit $deposit) : RedirectResponse
    {
        $deposit->delete();
        return redirect()->route('deposits.index')
                ->withSuccess('Deposited amount is deleted successfully.');
    }
}
