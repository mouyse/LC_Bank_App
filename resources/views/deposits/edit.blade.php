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
                        <a href="{{ route('deposits.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('deposits.update', $deposit->deposit_id) }}" method="post">
                        @csrf
                        @method("PUT")

                      <div class="mb-3 row">
                        <label class="col-md-6 col-form-label text-md-end text-start">
                          <h4>Edit deposit amount</h4>
                        </label>
                      </div>

                      <div class="mb-3 row">
                          <label for="code" class="col-md-4 col-form-label text-md-end text-start">Amount</label>
                          <div class="col-md-6">
                            <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ $deposit->amount }}">
                              @if ($errors->has('amount'))
                                  <span class="text-danger">{{ $errors->first('amount') }}</span>
                              @endif
                          </div>
                      </div>

                      <div class="mb-3 row">
                          <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update Deposited Amount">
                      </div>


                  </form>
              </div>


            </div>


        </div>
    </div>
</div>
@endsection
