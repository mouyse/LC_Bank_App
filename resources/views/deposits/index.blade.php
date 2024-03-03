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
                          <a href="{{ route('deposits.create') }}" class="btn btn-success btn-sm my-2">Deposit Cash</a>
                      </div>
                  </div>
                <div class="card-body">
                    <h5>Deposits List</h5><br />
                    <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Sl. No.#</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Deposited on</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($deposits as $deposit)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $deposit->amount }}</td>
                                <td>{{ $deposit->created_at }}</td>
                                <td>
                                    <form action="{{ route('deposits.destroy', $deposit->deposit_id) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <!-- <a href="{{ route('deposits.show', $deposit->deposit_id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a> -->

                                        <a href="{{ route('deposits.edit', $deposit->deposit_id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>

                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this deposit?');"><i class="bi bi-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <td colspan="6">
                                    <span class="text-danger">
                                        <strong>No deposits found!</strong>
                                    </span>
                                </td>
                            @endforelse
                        </tbody>
                      </table>

                      {{ $deposits->links() }}

                </div>
            </div>


        </div>
    </div>
</div>
@endsection
