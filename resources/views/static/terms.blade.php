@extends('layouts.app')
@section('title') 
  Terms
@endsection
@section('styles') 
  <style>
 ul {
list-style:none
 }	 
  </style>
@endsection

@section('scripts') 

@endsection

@section('content')

  <div class="container" style="margin-top:30px;min-height:60vh">
	  <div class="card">
    {!! $details !!}
  </div>
@endsection
