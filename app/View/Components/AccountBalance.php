<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Transaction;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Auth;

class AccountBalance extends Component
{
    protected $account_balance;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $deposited_amount = Deposit::where('account_id',Auth::id())->sum('amount');
        $withdrawn_amount = Withdrawal::where('account_id',Auth::id())->sum('amount');
        $this->account_balance = $deposited_amount - $withdrawn_amount;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.account-balance',[
          'account_balance' => $this->account_balance,
        ]);
    }
}
