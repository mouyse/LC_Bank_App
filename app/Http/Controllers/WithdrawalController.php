<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWithdrawalRequest;
use App\Http\Requests\UpdateWithdrawalRequest;
use App\Models\Withdrawal;
use App\Models\Deposit;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Auth;

class WithdrawalController extends Controller
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
      return view('withdrawals.index', [
          'withdrawals' => Withdrawal::where('account_id',Auth::id())->latest()->paginate(3),
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
      return view('withdrawals.create',[
        'account_balance' => $this->account_balance
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWithdrawalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWithdrawalRequest $request) : RedirectResponse
    {
      $withdrawal = Withdrawal::create(
        [
          'account_id' => Auth::id(),
        'amount' => $request->input('amount'),
      ]
    );
    // $transaction = Transaction::create(
    //   [
    //     'transaction_type_id' => 1,
    //     'amount' => $request->input('amount'),
    //   ],
    // );
    return redirect()->route('withdrawals.index')
            ->withSuccess('Amount is Withdrawn successfully.');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Withdrawal  $Withdrawal
   * @return \Illuminate\Http\Response
   */
  public function show(Withdrawal $Withdrawal) : View
  {
      return view('withdrawals.show', [
          'withdrawal' => $Withdrawal,
          'account_balance' => $this->account_balance,
      ]);

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Withdrawal  $Withdrawal
   * @return \Illuminate\Http\Response
   */
  public function edit(Withdrawal $Withdrawal) : View
  {
      return view('withdrawals.edit', [
          'withdrawal' => $Withdrawal,
          'account_balance' => $this->account_balance,
      ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateWithdrawalRequest  $request
   * @param  \App\Models\Withdrawal  $Withdrawal
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateWithdrawalRequest $request, Withdrawal $Withdrawal) : RedirectResponse
  {
      $Withdrawal->update($request->all());
      return redirect('/withdrawals/')
              ->withSuccess('Withdrawaled amount is updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Withdrawal  $Withdrawal
   * @return \Illuminate\Http\Response
   */
  public function destroy(Withdrawal $Withdrawal) : RedirectResponse
  {
      $Withdrawal->delete();
      return redirect()->route('withdrawals.index')
              ->withSuccess('Withdrawaled amount is deleted successfully.');
  }
}
