@extends('layouts.app')

@section('content')


  <style>
  .fakeimg {
    height: 200px;
    background: #aaa;
  }
  </style>

<div class="card" style="margin-bottom:0">
<div class="text-center" style="font-size:30px">Character Fashion Contests and more!</div>
</div>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-3">
      <div class="card">
Recently Added

<style type="text/css" scoped>
.GeneratedMarquee {
font-family:'Comic Sans MS';
font-size:1em;
line-height:1.3em;
color:white;
// background-color:#CCFFFF;
padding:1.5em;

}
</style>

<!-- HTML Code -->
<marquee class="GeneratedMarquee" direction="left" scrollamount="4" behavior="scroll">Dog contest... Funny hair contest... Most bestest contest... Contest for poor people</marquee>

</div>
      <h3>Some Links</h3>
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
      </ul>
      <hr class="d-sm-none">
    </div>
    <div class="col-sm-3">
      <div class="card">somethingcan be here<br><br><br></div>
      <br>
      <div class="card">something</div>
    </div>
  </div>
</div>


@endsection
