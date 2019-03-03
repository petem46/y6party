<?php
$countdown = date_diff(date_create($settings['partydate']), today())->format("%a");
$partydate = date('l, jS F Y' , strtotime($settings['partydate']));
$starttime = date('g:i A', strtotime($settings['starttime']));
$endtime = date('g:i A', strtotime($settings['endtime']));
?>
@extends('layouts.app')
@section('content')
@guest
<header class="masthead text-uppercase text-white text-center vh-100">
@else
@include('navs.main')
<header class="masthead text-uppercase text-white text-center vh-50">
@endguest
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <h1 class=""><i class="fas fa-birthday-cake"></i></h1>
        <h1 class="mb-5">2019 Leavers Party</h1>
        @guest
        <a class="btn btn-raised btn-info btn-lg font-weight-bold" href="{{ route('login') }}" role="button">Login Here</a>
        {{-- <a class="btn btn-outline-light btn-lg font-weight-bold" href="{{ route('login') }}" role="button">Parent Login</a> --}}
        @else
        <h2>Welcome</h2>
        <h4>{{Auth::user()->name}}</h4>
        @endguest
      </div>
    </div>
  </div>
</header>
{{-- @guest --}}

{{-- @else --}}
<!-- Icons Grid -->
<section class="features-icons bg-light text-center p-3">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
          <div class="features-icons-icon d-flex">
            <i class="material-icons text-danger mx-auto mb-5 mb-lg-0 mb-lg-3">
              access_time
            </i>
          </div>
          <h3>The Time</h3>
          @guest
            <p class="lead mb-0"><a class="font-weight-bold" href="{{ route('login') }}">Login</a> to see the date and time</p>
          @else
            <p class="lead mb-0">{{$partydate}}</p>
            <p class="lead mb-0">{{$starttime}} until {{$endtime}}</p>
          @endguest
        </div>
      </div>
      <div class="col-lg-4">
        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
          <div class="features-icons-icon d-flex">
            <i class="material-icons text-info mx-auto mb-5 mb-lg-0 mb-lg-3">
              place
            </i>
          </div>
          <h3>The Place</h3>
          @guest
            <p class="lead mb-0"><a class="font-weight-bold" href="{{ route('login') }}">Login</a> to see the location</p>
          @else
            <p class="lead mb-0">{{$settings['venuename']}}, {{$settings['venuelocation']}} </p>
          @endguest
        </div>
      </div>
      <div class="col-lg-4">
        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
          <div class="features-icons-icon d-flex">
            <i class="material-icons text-success mx-auto mb-5 mb-lg-0 mb-lg-3">
              event
            </i>
          </div>
          <h3>The Countdown</h3>
          @guest
            <p class="lead mb-0"><a class="font-weight-bold" href="{{ route('login') }}">Login</a> for this information</p>
          @else
            <p class="lead mb-0">There are only <span class="text-info font-weight-bold">{{$countdown}}</span> days to go!</p>
            <p class="lead mb-0">Are you nearly ready?</p>
          @endguest
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Image Showcases -->
<section class="showcase">
  <div class="container-fluid p-0">
    <div class="row no-gutters">

      <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/bg-showcase-1.jpg');"></div>
      <div class="col-lg-6 order-lg-1 my-auto showcase-text">
        <h2>Fun, Food & Games</h2>
        @guest
        <p class="lead">The date has been confirmed! The venue has been booked!</p>
        @else
        <p class="lead">The date has been confirmed! The venue has been booked, and there are only <span class="text-primary font-weight-bold">{{$countdown}}</span> days until party time!</p>
        @endguest
        <p class="lead">We are planning to have lots of fun and games at the leaver's party!  We would like to tell you more, but we are keeping some details of the games a mystery for now!</p>
        <p class="lead">Do you think you'll be hungry? Don't worry, there will be cakes, burgers, hot dogs and sweets?</p>
        <p class="lead">Don't forget about the music, singing and dancing...</p>
      </div>
    </div>
    <div class="row no-gutters">
      <div class="col-lg-6 text-white showcase-img" style="background-image: url('img/bg-showcase-2.jpg');"></div>
      <div class="col-lg-6 my-auto showcase-text">
        <h2>Music, Singing & Dancing</h2>
        <p class="lead">The party music will come straight from a playlist compiled by the children.  Check out the current <a href="{{route('playlist')}}" class="font-weight-bold">playlist</a> and add your child's song choices on <a href="{{route('playlist')}}" class="font-weight-bold">the playlist</a> page.</p>
        <p class="lead">The most popular songs will be played at the party along with some of the alternative choices.</p>
        <p class="lead mb-0">We are also hoping that in addition to all the fun and games some of the children will be stepping up to sing their favourite karaoke songs.</p>
      </div>
    </div>
    @guest
        
    @else
    @if (Auth::user()->usergroup_id < 3)
    <div class="row no-gutters">
      <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/bg-showcase-3.jpg');"></div>
      <div class="col-lg-6 order-lg-1 my-auto showcase-text">
        <h2>The Boring Bits</h2>
        <p class="lead"><span class="text-primary font-weight-bold">Adults, we need your help and support.</span>  The planning and preparation has started but there is a list of tasks and jobs we need your help with.</p>
        <li class="lead">Maybe you can help with supplies and party food?</li>
        <li class="lead">Maybe you can help out on the day, helping setup the venue or during the party?</li>
        <p class="lead mt-3">Check <a href="{{route('iamjob')}}" class="font-weight-bold">The Jobs</a> page to see how you can help out!</p>
        <p class="lead">We will also be asking you for some other contributions to help make the party a success, some of these requests will not be very exciting but some will be fun.</p>
        <p class="lead mb-0">Check the <a href="{{route('profile')}}" class="font-weight-bold">My Profile</a> page to for more details!</p>
      </div>
    </div>
  </div>
  @endif
  @endguest

</section>

    <!-- Testimonials -->
    <section class="testimonials text-center bg-light pb-5">
      <div class="container">
        <h2 class="mb-5">What people are saying...</h2>
        <div class="row">
          <div class="col-lg-4">
            <div class="testimonial-item mx-auto mb-5 mb-lg-0">
              <img class="img-fluid rounded-circle mb-3" src="img/testimonials-1.jpg" alt="">
              <h5>Margaret E.</h5>
              <p class="font-weight-light mb-0">"Pineapples with sun glasses!? They are fantastic! I really hope there will be pineapples with sunlgasses at the party!"</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="testimonial-item mx-auto mb-5 mb-lg-0">
              <img class="img-fluid rounded-circle mb-3" src="img/testimonials-2.jpg" alt="">
              <h5>Fred S.</h5>
              <p class="font-weight-light mb-0">"I cannot wait to for the leaver's PARTY! I am so excited! My dancing shoes are polished and ready to rock."</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="testimonial-item mx-auto mb-5 mb-lg-0">
              <img class="img-fluid rounded-circle mb-3" src="img/testimonials-3.jpg" alt="">
              <h5>Sarah	W.</h5>
              <p class="font-weight-light mb-0">"OMG! Just wait until you see my dress!"</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <h2 class="mb-5 text-center my-auto py-4">The Location & Directions</h2>
      @guest
      <p class="lead text-center">Please <a class="font-weight-bold" href="{{ route('login') }}">login</a> to see the map.</p>
      @else
  <div class="vh-75 d-flex map-container pb-3" id="map">
    <iframe src="{{$settings['venuemapurl']}} " width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
  </div>
  @endguest
</section>
{{-- @endguest --}}
{{-- @include('includes.footer') --}}
@endsection