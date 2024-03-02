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
                <div class="card-header">Withdrawal List</div>
                <div class="card-body">
                    <a href="{{ route('withdrawals.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Withdraw Cash</a>
                    <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Sl. No.#</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Withdrawan on</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($withdrawals as $withdrawal)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $withdrawal->amount }}</td>
                                <td>{{ $withdrawal->created_at }}</td>
                                <td>
                                    <form action="{{ route('withdrawals.destroy', $withdrawal->withdrawal_id) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <!-- <a href="{{ route('withdrawals.show', $withdrawal->withdrawal_id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a> -->

                                        <a href="{{ route('withdrawals.edit', $withdrawal->withdrawal_id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>

                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this withdrawal?');"><i class="bi bi-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <td colspan="6">
                                    <span class="text-danger">
                                        <strong>No withdrawals found!</strong>
                                    </span>
                                </td>
                            @endforelse
                        </tbody>
                      </table>

                      {{ $withdrawals->links() }}

                </div>
            </div>


        </div>
    </div>
</div>
@endsection
