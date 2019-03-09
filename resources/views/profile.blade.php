@extends('layouts.app')
@section('content')
@include('navs.main')
@php
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
@if (session('messageSongDeleted'))
<script>
  $(function() {
    $.snackbar({content: "{{session('messageSongDeleted')}}",style: "bg-success", timeout: 3000});
  });
</script>
@endif
@if (session('messageHoodieUpdated'))
<script>
  $(function() {
    $.snackbar({content: "{{session('messageHoodieUpdated')}}",style: "bg-success", timeout: 3000});
  });
</script>
@endif
<header class="masthead masthead-myprofile text-center">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <h1 class="mb-5 text-white">My Profile</h1>
      </div>
    </div>
  </div>
</header>
<div class="container">
  <main class="pb-5">
    <div class="pt-3">
      <div class="row">
        <div class="col-lg-12 mb-3">
          <div class="card card-default">
            <div class="card-header bg-light py-3">
              <h3>My Details</h3>
            </div>
            <div class="card-header card-header-job">
              <div class="flex-1 capitalize">
                <div class="text-info text-uppercase"><small>Name</small></div>
                <div><h5>{{Auth::user()->name}}</h5></div>
              </div>
            </div>
            <div class="card-header card-header-job">
              <div class="flex-1">
                <div class="text-info text-uppercase"><small>Email</small></div>
                <div><h5>{{Auth::user()->email}}</h5></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @if (Auth::user()->usergroup_id < 3)
      <div class="row">
        <div class="col-lg-12 mb-3">
          <div class="card card-default">
            <div class="card-header bg-light py-3">
              <h3>Linked Children ({{count($user)}})</h3>
            </div>
            @foreach ($user as $kid)
            <div class="card-header card-header-job" id="{{ $kid->id }}">
              <div class="flex-1 capitalize">
                <div class="text-info text-uppercase"><small>Name</small></div>
                <div><h5>{{$kid->kidname}}</h5></div>
              </div>
            </div>
          </div>
          <div class="card card-default">
            <div class="card-header card-header-job">
              <div class="flex-1 capitalize">
                <form action="{{action('ProfileController@updateHoodieName', $kid->id)}}" method="POST" id="hoodieName" class="p-0 m-0">
                  {{ csrf_field() }}
                  <div class="text-info text-uppercase"><small>Hoodie Name</small></div>
                  <div class="p-0">
                    <input type="text" name="hoodieName" id="profile-hoodieName" class="form-control" placeholder="Hoodie Name" value="{{$kid->hoodiename}}">
                  </div>
                </div>
                <div class="pt-3 ml-5 mr-3">
                  <button type="submit" class="btn btn-success btn-outline d-none d-md-block">Save Choice</button>
                  <button type="submit" class="btn btn-success d-md-none py-0 "><i class="far fa-save fa-3x"></i></button>
                </div>
              </div>
            </form>
          </div>
          <div class="card card-default">
            <div class="card-header card-header-job">
              <div class="flex-1 capitalize">
                <form action="{{action('ProfileController@updateHoodieSize', $kid->id)}}" method="POST" id="hoodieSize" class="p-0 m-0">
                  {{ csrf_field() }}
                  <div class="text-info text-uppercase"><small>Hoodie Size</small></div>
                  <div class="p-0">
                    {{-- <input type="search" name="hoodieSize" id="profile-hoodieSize" class="form-control" placeholder="Hoodie Size" value="{{$kid->hoodiesize}}"> --}}
                    <select class="form-control" name="hoodieSize" id="profile-hoodieSize" selected="LARGE">
                      <option value="xsmall" @if ($kid->hoodiesize == "xsmall") selected="selected" @endif>EXTRA SMALL</option>
                      <option value="small" @if ($kid->hoodiesize == "small") selected="selected" @endif>SMALL</option>
                      <option value="medium" @if ($kid->hoodiesize == "medium") selected="selected" @endif>MEDIUM</option>
                      <option value="large" @if ($kid->hoodiesize == "large") selected="selected" @endif>LARGE</option>
                      <option value="xlarge" @if ($kid->hoodiesize == "xlarge") selected="selected" @endif>EXTRA LARGE</option>
                    </select>
                  </div>
                </div>
                <div class="pt-3 ml-5 mr-3">
                  <button type="submit" class="btn btn-success btn-outline d-none d-md-block">Save Choice</button>
                  <button type="submit" class="btn btn-success d-md-none py-0 "><i class="far fa-save fa-3x"></i></button>
                </div>
              </div>
            </form>
          </div>
          <div class="card card-default">
            <div class="card-body">
              <div class="card-text">
                <div class="text-info text-uppercase"><small>The Playlist</small></div>
                <div class=""><h4>{{substr($kid->kidname, 0, strrpos($kid->kidname," "))}}'s Song Choices</h4></div>
              </div>
              @php $t = 0; @endphp
              @foreach ($kid->songs as $song)
              @php $t++ @endphp
              <div class="card-text pb-3">
                <div class="text-danger text-uppercase"><small><strong>Track {{$t}}</strong></small></div>
                <div class="card-text">
                  {{$song->artist}} - {{$song->songname}}&nbsp;
                </div>
              </div>
              @endforeach
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 mb-3">
        <div class="card card-default">
          <div class="card-header bg-light py-3">
            <h3>My Jobs and Responsibilites ({{$jobcount}})</h3>
          </div>
        </div>
      </div>
    </div>
    @include('jobs.board')
    
    {{-- TEST SHOW ALL JOB DETAILS WITH COMMENTS AND HELPERS --}}
    
    @endif
    @if (Auth::user()->usergroup_id == 3)
    
    <div class="row">
      <div class="col-lg-12 mb-3">
        <div class="card card-default">
          <div class="card-header bg-light py-3">
            <h3>My Tracks</h3>
          </div>
          @php $i = 0; @endphp
          @foreach ($songs as $song)
          @php
          $i++;
          $voted = 0;
          @endphp
          
          <div class="card-header card-header-job">
            <div class="flex-1">
              <div class="text-muted"><small>Added by {{$song->kid->kidname}} - {{ $song->created_at->diffForHumans() }}</small></div>
              <div><h5>{{$i}}. {{$song->artist}} - {{$song->songname}}</h5></div>
            </div>
            @foreach ($song->votes as $vote)
            @if ($vote->kid_id == $kid)
            @php $voted = 'text-success'; @endphp
            @endif
            @endforeach
            <div class="col-2 p-0">
              <form class="p-0 m-0" action="{{url('songs', [$song->id])}}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-block text-default px-0 py-3 m-0 {{$voted}}">
                  <span class="d-md-none"><i class="fas fa-thumbs-up fa-lg"></i>&nbsp;&nbsp;{{count($song->votes)}}</span>
                  <span class="d-none d-md-block"><i class="fas fa-thumbs-up fa-lg"></i>&nbsp;&nbsp;{{count($song->votes)}} votes</span>
                </button>
              </form>
            </div>
            <div class="col-1 p-0">
              @if ($song->kid_id == $kid)
              <form class="p-0 m-0" action="{{url('songs', [$song->id])}}" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-block text-danger px-0 py-3 m-0">
                  <span class=""><i class="fas fa-trash-alt fa-lg"></i></span>
                </button>
              </form>  
              {{-- <a href="#song{{$song->id}}" style="-pointer-events: none;" class="btn btn-block text-danger px-0 py-3 m-0">
                <span class="d-md-block"><i class="fas fa-trash fa-lg"></i>&nbsp;&nbsp;</span>
              </a> --}}
              @endif
            </div>
          </div>
          <div class="card-footer bg-white text-center py-0 hidden">
            <div class="row">
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    {{-- <p class="text-dark">You can add <strong>five</strong> tracks to the playlist.</p> --}}
    @php if ($mysongcount[0]['songs_count'] == 1) {$addedtracks = 'track';} else {$addedtracks = 'tracks';} @endphp
    @php if ($mysongcount[0]['songs_count'] == 4) {$moretracks = 'track';} else {$moretracks = 'tracks';} @endphp
    @if ($mysongcount[0]['songs_count'] >= 5)
    <p class="text-danger"><strong>You have added {{$mysongcount[0]['songs_count']}} {{$addedtracks}} to the playlist.</strong></p>
    <p class="text-dark">You have <strong>unlimited</strong> votes (one per track).</p>
    @else
    <p class="text-dark">You have added {{0 + $mysongcount[0]['songs_count']}} {{$addedtracks}} to the playlist.</p>
    <p class="text-info"><strong>You can add {{5 - $mysongcount[0]['songs_count']}} more {{$moretracks}} to the playlist.</strong></p>
    <p class="text-dark">You have <strong>unlimited</strong> votes (one per track).</p>
    <p><a href="{{URL::to('/')}}/songs/search" class="btn btn-success btn-outline"><i class="fas fa-plus"></i> Add Song</a></p>
    @endif
    @endif
  </main>
</div>
@endsection
