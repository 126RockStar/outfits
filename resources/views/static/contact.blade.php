@extends('layouts.app')
@section('title') 
  Contact Us
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
    <!--Section: Contact v.2-->
<section class="mb-4">

  <!--Section heading-->
  <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
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

          <div class="text-center">
              <button type="submit" class="btn btn-lg  btn-secondary">Send</button>
          </div>
          <div class="status"></div>
        </form>
      <!--Grid column-->

  </div>

</section>
<!--Section: Contact v.2-->
    
  </div>
@endsection
