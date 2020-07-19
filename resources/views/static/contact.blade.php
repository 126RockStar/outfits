@extends('layouts.app')
@section('title') 
  Contact Us
@endsection
@section('styles') 
  <style>
.bg-success {
    background-color: #17a2b8!important;
}
.alert {
    border: 1px solid #ffffff;
}
  </style>
@endsection

@section('scripts') 

@endsection

@section('content')
  <div class="container" style="margin-top:30px;min-height:60vh">
    <!--Section: Contact v.2-->
<section class="mb-4">
<div class="card">
	<div class="card-header">{{ __('Contact Us') }}</div>
  <!--Section description-->
  <div class="row justify-content-center">

      <!--Grid column-->
          <form class="col-md-6 mb-md-0 mb-5" name="contact-form" action="{{route('contact')}}" method="POST">
              @csrf
              <!--Grid row-->
              <div class="row">

                  <!--Grid column-->
                  <div class="col-md-6">
                      <div class="md-form mb-0">
                          <input type="text" id="name" name="name" class="form-control" required>
                          <label for="name" class="">Your name</label>
                      </div>
                  </div>
                  <!--Grid column-->

                  <!--Grid column-->
                  <div class="col-md-6">
                      <div class="md-form mb-0">
                          <input type="email" id="email" name="email" class="form-control" required>
                          <label for="email" class="">Your email</label>
                      </div>
                  </div>
                  <!--Grid column-->

              </div>
              <!--Grid row-->

              <!--Grid row-->
              <div class="row">
                  <div class="col-md-12">
                      <div class="md-form mb-0">
                          <input type="text" id="subject" name="subject" class="form-control" required>
                          <label for="subject" class="">Subject</label>
                      </div>
                  </div>
              </div>
              <!--Grid row-->

              <!--Grid row-->
              <div class="row">

                  <!--Grid column-->
                  <div class="col-md-12">

                      <div class="md-form">
                          <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea" required></textarea>
                          <label for="message">Your message</label>
                      </div>

                  </div>
              </div>
              <!--Grid row-->

          <div class="text-center mb-2">
              <button type="submit" class="btn btn-primary">Send</button>
          </div>
          <div class="status"></div>
        </form>
      <!--Grid column-->

  </div>
</div>
</section>
<!--Section: Contact v.2-->
    
  </div>
@endsection
