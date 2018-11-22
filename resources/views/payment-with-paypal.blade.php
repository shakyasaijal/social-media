@extends('layouts.app')
    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Payment with paypal') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('addmoney.paypal') }}" aria-label="{{ __('Paypal') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Amount In USD') }}</label>
                                    <div class="col-md-6">
                                        <input id="amount" type="text" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ $amount ?? old('amount') }}" required autofocus>
                                        @if ($errors->has('amount'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Pay') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop