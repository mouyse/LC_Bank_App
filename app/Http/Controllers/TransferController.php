<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransferRequest;
use App\Http\Requests\UpdateTransferRequest;
use App\Models\Transfer;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Withdrawal;
use App\Models\Transaction;


use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Auth;

class TransferController extends Controller
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

        return view('transfers.index', [
            'transfers' => Transfer::where('sender_id',Auth::id())->latest()->paginate(10),
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
      return view('transfers.create',[
        'account_balance' => $this->account_balance,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransferRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransferRequest $request) : RedirectResponse
    {
      $transfer = Transfer::create(
        [
          'sender_id' => Auth::id(),
          'receiver_id' => User::where('email',$request->input('receiver_id'))->first()->id,
          'amount' => $request->input('amount'),
        ]
      );
        return redirect()->route('transfers.index')
                ->withSuccess('Amount is transferred successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function show(Transfer $transfer) : View
    {
        return view('transfers.show', [
            'transfer' => $trasnfer,
            'account_balance' => $this->account_balance,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(Transfer $transfer) : View
    {
        return view('transfers.edit', [
            'transfer' => $transfer,
            'account_balance' => $this->account_balance,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransferRequest  $request
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransferRequest $request, Transfer $transfer) : RedirectResponse
    {
        $transfer->update(
            [
              'sender_id' => Auth::id(),
              'receiver_id' => User::where('email',$request->input('receiver_id'))->first()->id,
              'amount' => $request->input('amount'),
            ]
        );
        return redirect('/transfers/')
                ->withSuccess('Transferred amount is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer) : RedirectResponse
    {

        $transfer->delete();
        return redirect()->route('transfers.index')
                ->withSuccess('Transferred amount is deleted successfully.');
    }
}
