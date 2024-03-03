@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">

                <div class="card-header">
                    <div class="float-start">
                        <x-account-balance :account-balance="$account_balance"/>
                    </div>
                    <div class="float-end">
                        <a href="{{ route('transfers.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                  <form action="{{ route('transfers.store') }}" method="post" id="cash-transfer" name="cash-transfer">
                      @csrf


                      <div class="mb-3 row">
                      <label class="col-md-6 col-form-label text-md-end text-start">
                        <h4>Transfer Money</h4>
                      </label>
                      </div>
                      <div class="mb-3 row">
                          <label for="code" class="col-md-4 col-form-label text-md-end text-start">Email address</label>
                          <div class="col-md-6">
                            <input type="email" class="form-control @error('receiver_id') is-invalid @enderror" id="receiver_id" name="receiver_id" value="{{ old('receiver_id') }}">
                              @if ($errors->has('receiver_id'))
                                  <span class="text-danger">{{ $errors->first('receiver_id') }}</span>
                              @endif
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <label for="code" class="col-md-4 col-form-label text-md-end text-start">Amount</label>
                          <div class="col-md-6">
                            <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}">
                              @if ($errors->has('amount'))
                                  <span class="text-danger">{{ $errors->first('amount') }}</span>
                              @endif
                          </div>
                      </div>


                      <div class="mb-3 row">
                          <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Transfer Money">
                      </div>

                  </form>
              </div>


            </div>


        </div>
    </div>
</div>
@endsection
