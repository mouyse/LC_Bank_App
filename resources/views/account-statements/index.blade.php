@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif

            <div class="card">

                <div class="card-header">
                    <div class="float-start">
                        <x-account-balance/>
                    </div>
                    <div class="float-end">
                    </div>
                </div>


                <div class="card-body">
                    <h5>Account Statement</h5><br />
                    <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Sl. No.#</th>
                            <th scope="col">Datetime</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Type</th>
                            <th scope="col">Details</th>
                            <th scope="col">Balance</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php $balance = 0; @endphp
                            @forelse ($transactions as $transaction)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $transaction->created_at }}</td>
                                <td>{{ $transaction->amount }}</td>
                                <td>
                                  @if ($transaction->type!="Debit" && $transaction->type!="Credit")
                                    @if ($transaction->type==Auth::id())
                                      Debit
                                    @else
                                      Credit
                                    @endif
                                  @else
                                  {{ $transaction->type }}
                                  @endif
                                </td>
                                <td>
                                  @if ($transaction->type!="Debit" && $transaction->type!="Credit")
                                          @if ($transaction->type==Auth::id())
                                            Transferred to {{ App\Models\User::find($transaction->type)->email }}
                                          @else
                                            Received from {{ App\Models\User::find($transaction->type)->email }}
                                          @endif
                                  @else
                                          @if ($transaction->type=="Debit")
                                            Withdraw
                                          @else
                                            Deposit
                                          @endif
                                  @endif
                                </td>
                                <td>
                                  @if ($transaction->type!="Debit" && $transaction->type!="Credit")
                                          @if ($transaction->type==Auth::id())
                                            @php $balance -= $transaction->amount @endphp
                                          @else
                                            @php $balance += $transaction->amount @endphp
                                          @endif
                                  @else
                                          @if ($transaction->type=="Debit")
                                            @php $balance -= $transaction->amount @endphp
                                          @else
                                            @php $balance += $transaction->amount @endphp
                                          @endif
                                  @endif
                                  {{ $balance }}
                                </td>
                            </tr>
                            @empty
                                <td colspan="6">
                                    <span class="text-danger">
                                        <strong>No transactions found!</strong>
                                    </span>
                                </td>
                            @endforelse
                        </tbody>
                      </table>


                </div>
            </div>


        </div>
    </div>
</div>
@endsection
