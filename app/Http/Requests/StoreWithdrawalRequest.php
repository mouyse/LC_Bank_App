<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Withdrawal;
use App\Models\Deposit;
use App\Models\Transfer;
use Auth;
use DB;

class StoreWithdrawalRequest extends FormRequest
{
    protected $available_balance;

    public function __construct(){

        $deposited_amount = Deposit::where('account_id',Auth::id())->sum('amount');
        $withdrawn_amount = Withdrawal::where('account_id',Auth::id())->sum('amount');
        $transferred_amount = Transfer::where('sender_id',Auth::id())->sum('amount');
        $received_amount = Transfer::where('receiver_id',Auth::id())->sum('amount');
        $this->account_balance = $deposited_amount - $withdrawn_amount - $transferred_amount + $received_amount;

    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(){

        return [
            'amount' => 'required|numeric|lte:'.$this->account_balance,
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => 'Please enter the amount',
            'amount.numeric' => 'Please enter the valid amount in numbers only',
            'amount.lte' => 'You do not have sufficient balance. Available balance: '.$this->account_balance,
        ];
    }
}
