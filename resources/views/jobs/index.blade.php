@extends('layouts.app')
@section('content')
@include('navs.main')
@php
$counter = 0;
$datatoggle = 0;
@endphp
@if (session('job_id'))
  <?php $datatoggle = session('job_id'); ?>
@endif
@if (session('commentdeleted'))
<script>
  $(function() {
    $.snackbar({content: "{{session('commentdeleted')}}",style: "bg-danger", timeout: 3500});
  });
</script>
@endif
@if (session('commentadded'))
<script>
  $(function() {
    $.snackbar({content: "{{session('commentadded')}}",style: "bg-success", timeout: 3500});
  });
</script>
@endif
@if (session('signedup'))
<script>
  $(function() {
    $.snackbar({content: "You signed up for the job: <br> {{session('signedup')}}",style: "bg-info", timeout: 3500});
  });
</script>
@endif
@if (session('cancelsignup'))
<script>
  $(function() {
    $.snackbar({content: "You are no longer signed up for the job: <br> {{session('cancelsignup')}}",style: "bg-warning", timeout: 3500});
  });
</script>
@endif
<header class="masthead masthead-joblist text-white text-center">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <h1 class="mb-5">The Jobs List</h1>
      </div>
    </div>
  </div>
</header>

<!-- Icons Grid -->
<section class="features-icons bg-light text-center p-3 d-none d-lg-block">
  {{-- <section class="features-icons bg-light text-center d-none d-md-block"> --}}
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="material-icons text-danger mx-auto mb-5 mb-lg-0 mb-lg-3">
                assignment
              </i>
            </div>
            <h3>{{$jobcount}} Jobs</h3>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="material-icons text-info mx-auto mb-5 mb-lg-0 mb-lg-3">
                assignment_ind
              </i>
            </div>
            @foreach ($helpercount as $helpcount) <?php $counter += $helpcount->users_count; ?> @endforeach
            <h3> {{$counter}} out of {{$helpersrequired}} Helpers</h3>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="material-icons text-success mx-auto mb-5 mb-lg-0 mb-lg-3">
                assignment_turned_in
              </i>
            </div>
            <h3>{{$completedjobs}} Jobs Complete</h3>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="container">
      <main class="pb-5">
        <div class="pt-3">
  @include('jobs.board')
        </div>
      </main>
  </div>

  @endsection