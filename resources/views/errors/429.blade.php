@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-danger  text-white">
                <div class="card-header">{{ __('Verify Your Email Address') }}: <b class="text-dark">{{Auth::user()->email}}</b></div>

                <div class="card-body">
                   <h1 class="text-white text-center">Too Many Requests</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
