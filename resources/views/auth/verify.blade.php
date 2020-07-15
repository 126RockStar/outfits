@extends('layouts.app')
@section('title')
  Verify
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">{{ __('Check your inbox for the verification link at') }}: <div class="text-info text-center">{{Auth::user()->email}}</div></div>
				<div class="card-body">Sometimes emails just don't make it to your inbox.<br>Our email should be there within minutes, check your spam/junk folder if it is not.<br><br>If you can't find it anywhere please use the link below to try again.<br> If all fails, contact us.</div>
                <div class="card-footer">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification email has been sent to the above email address.') }}
                        </div>
                    @else
                       
                        {{ __('Didn\'t get it yet?') }}
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf 
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-warning">{{ __('Request one more') }}</button>.
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
