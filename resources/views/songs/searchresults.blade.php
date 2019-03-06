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
        <h1 class="mb-5">Song Search Results</h1>
      </div>
    </div>
  </div>
</header>
<section id="addsong" class="mb-5 mt-3">
  <div class="container">
    <div class="row">
      @foreach ($response->results as $item)
      @if ($item->trackExplicitness == 'explicit')
      @continue
      @endif
      <div class="col-xl-4 col-md-6 my-3">
        <div class="card">
          <div class="card-header" style="
          height: 7rem;
          background: url({{$item->artworkUrl100}}) no-repeat center center lightgrey;
          background-size: contain;  
          ">
          {{-- <img src="{{$item->artworkUrl100}}" alt="Card image cap"> --}}
        </div>
        <div class="card-body">
          <h5>{{$item->artistName}} - {{$item->trackName}}</h5>
          <audio class="w-100" controls controlsList="nodownload">
            <source src="{{$item->previewUrl}}" type="audio/mp4">
              Your browser does not support the audio element.
            </audio>
            <form action="/songs" method="POST" class="form-horizontal">
              {{ csrf_field() }}
              <div class="form-group hidden">
                <label for="song-artist">Artist</label>
                <input type="text" name="artist" id="song-artist" class="form-control" placeholder="{{$item->artistName}}" value="{{$item->artistName}}">
              </div>
              <div class="form-group hidden">
                <label for="song-name">Song</label>
                <input type="text" name="songname" id="song-name" class="form-control" placeholder="{{$item->trackName}}" value="{{$item->trackName}}">
              </div> 
              <div class="form-group hidden">
                <label for="song-artworkUrl">Artwork URL</label>
                <input type="text" name="artworkUrl" id="song-name" class="form-control" placeholder="{{$item->artworkUrl100}}" value="{{$item->artworkUrl100}}">
              </div> 
              <div class="form-group hidden">
                <label for="song-previewUrl">Preview URL</label>
                <input type="text" name="previewUrl" id="song-previewUrl" class="form-control" placeholder="{{$item->previewUrl}}" value="{{$item->previewUrl}}">
              </div> 
              <div class="form-group">
                <label for="song-kid">Requested By</label>
                {{-- <input type="text" name="kid_id" id="song-kid" class="form-control" placeholder="Requested by"> --}}
                <select class="form-control" name="kid_id" id="song-kid">
                  @foreach ($kids as $kid)
                  <option value="{{ $kid->id }}"
                    >{{ $kid->kidname}}
                  </option>
                  @endforeach
                </select>
              </div> 
              <button type="submit" class="btn btn-block btn-raised btn-success mt-3">Select Track</button>
            </form>
          </div>
        </div>
      </div>
      @endforeach
      
    </div>
        <div class="row mx-0">
          <button type="button" onclick="goBack()" class="col-6 btn btn-danger text-left">
            <i class="fas fa-search"></i>&nbsp;&nbsp;Search again    
          </button>    
          <a href="{{route('playlist')}}" class="col-6 btn btn-info text-right"><i class="fas fa-music"></i>&nbsp;&nbsp;The Playlist</a>
        </div>
  </div>
</section>
@endsection

