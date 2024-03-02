@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">

                <div class="card-header">
                    <div class="float-start">
                        Add New Deposit - Account balance: <b>{{ $account_balance }}</b>
                    </div>
                    <div class="float-end">
                        <a href="{{ route('deposits.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                  <form action="{{ route('deposits.store') }}" method="post">
                      @csrf

                      <div class="mb-3 row">
                          <label for="code" class="col-md-4 col-form-label text-md-end text-start">Amount</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}">
                              @if ($errors->has('amount'))
                                  <span class="text-danger">{{ $errors->first('amount') }}</span>
                              @endif
                          </div>
                      </div>


                      <div class="mb-3 row">
                          <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Deposit">
                      </div>

                  </form>
              </div>


            </div>


        </div>
    </div>
</div>
@endsection
