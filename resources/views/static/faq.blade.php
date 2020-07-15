@extends('layouts.app')
@section('title') 
  FAQ
@endsection
@section('styles') 
  <style>
    .fakeimg {
      height: 200px;
      background: #aaa;
    }

    .GeneratedMarquee {
      font-family:'Comic Sans MS';
      font-size:1em;
      line-height:1.3em;
      color:white;
      // background-color:#CCFFFF;
      padding:1.5em;

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
