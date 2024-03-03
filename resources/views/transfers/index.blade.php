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
                        <a href="{{ route('transfers.create') }}" class="btn btn-success btn-sm my-2">Transfer Money</a>
                    </div>
                </div>


                <div class="card-body">
                    <h5>Transfers List</h5><br />
                    <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Sl. No.#</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Sent to</th>
                            <th scope="col">Transferred on</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($transfers as $transfer)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $transfer->amount }}</td>
                                <td>{{ $transfer->receiver->email }}</td>
                                <td>{{ $transfer->created_at }}</td>
                                <td>
                                    <form action="{{ route('transfers.destroy', $transfer->transfer_id) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <!-- <a href="{{ route('transfers.show', $transfer->transfer_id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a> -->

                                        <a href="{{ route('transfers.edit', $transfer->transfer_id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>

                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this transfer?');"><i class="bi bi-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <td colspan="6">
                                    <span class="text-danger">
                                        <strong>No transfers found!</strong>
                                    </span>
                                </td>
                            @endforelse
                        </tbody>
                      </table>

                      {{ $transfers->links() }}

                </div>
            </div>


        </div>
    </div>
</div>
@endsection
