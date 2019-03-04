@extends('layouts.app')
@section('content')
@include('navs.main')
@if (session('messageDuplicateSong'))
<script>
  $(function() {
    $.snackbar({content: "{{session('messageDuplicateSong')}}",style: "bg-danger", timeout: 3000});
  });
</script>
@endif
@if (session('messageDuplicateVote'))
<script>
  $(function() {
    $.snackbar({content: "{{session('messageDuplicateVote')}}",style: "bg-danger", timeout: 3000});
  });
</script>
@endif
@if (session('messageSongAdded'))
<script>
  $(function() {
    $.snackbar({content: "{{session('messageSongAdded')}}",style: "bg-success", timeout: 3000});
  });
</script>
@endif
@if (session('messageVoted'))
<script>
  $(function() {
    $.snackbar({content: "{{session('messageVoted')}}",style: "bg-success", timeout: 3000});
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
<header class="masthead masthead-playlist text-white text-center">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <h1 class="mb-5">The Playlist 2019</h1>
      </div>
    </div>
  </div>
</header>
<!-- Icons Grid -->
<section class="features-icons bg-light text-center p-3 d-none d-lg-block">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
          <div class="features-icons-icon d-flex">
            <i class="material-icons text-danger mx-auto mb-5 mb-lg-0 mb-lg-3">
              music_video
            </i>
          </div>
          <h3>{{$songcount}} Songs</h3>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
          <div class="features-icons-icon d-flex">
            <i class="material-icons text-info mx-auto mb-5 mb-lg-0 mb-lg-3">
              mic
            </i>
          </div>
          <h3>{{$artistcount}}&nbsp;Artists & Bands</h3>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
          <div class="features-icons-icon d-flex">
            <i class="material-icons text-success mx-auto mb-5 mb-lg-0 mb-lg-3">
              thumb_up
            </i>
          </div>
          <h3>{{$votecount}} Votes</h3>
        </div>
      </div>
    </div>
  </div>
</section>
  <div class="container">
  <main class="pb-0">
    <div class="pt-3">
      <div class="row">
        @php $i = 0; @endphp
        @foreach ($songs as $song)
        @php
          $i++;
          $voted = 0;
        @endphp
        
        <div class="col-lg-12 mb-3" id="song{{$song->id}}">
          <div class="card card-default">
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
          </div>
        </div>
        @endforeach
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
    </div>
  </main>
  </div>

  @endsection
  
  