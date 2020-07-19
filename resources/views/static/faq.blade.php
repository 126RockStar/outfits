@extends('layouts.app')
@section('title') 
  FAQ
@endsection
@section('styles') 
<style>
 .btn-link {
    color: #fff;
}
.btn-link:hover {
    color: #17a2b8;
}
.card-body {
    background-color: #17a2b8;
}
</style>
@endsection

@section('scripts') 

@endsection

@section('content')
  <div class="container" style="margin-top:30px;min-height:60vh">
    {!! $details !!}
    
  </div>
@endsection
