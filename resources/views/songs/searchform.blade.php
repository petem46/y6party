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
<header class="masthead masthead-playlist text-white text-center">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <h1 class="mb-5">Songs Search Form</h1>
      </div>
    </div>
  </div>
</header>
<section id="searchsong" class="mb-5 mt-3">
  <div class="container">
    {{-- @include('common.errors') --}}
    
    <form action="{{route('songsearch')}}" method="POST" class="form-horizontal">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="song-artist">Artist</label>
        <input type="text" name="artist" id="song-artist" class="form-control" placeholder="Enter Artist or Band name">
      </div>
      <div class="form-group">
        <label for="song-track">Track</label>
        <input type="text" name="track" id="song-track" class="form-control" placeholder="Enter Track name">
      </div>
      <div class="form-group mt-4 ms-0">
        <div class="row mx-0">
          <button type="button" onclick="goBack()" class="col-6 btn btn-danger text-left">
            <i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Cancel    
          </button>    
          <button type="submit" class="col-6 btn btn-success text-right">
            <i class="fas fa-plus"></i>&nbsp;&nbsp;Search Song    
          </button>    
        </div>
        
      </div>  
    </form>
  </div>
</section>
@endsection

