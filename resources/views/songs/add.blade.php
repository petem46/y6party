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
                <h1 class="mb-5">Songs.Add</h1>
            </div>
        </div>
    </div>
</header>
{{-- <div>
    @foreach ($response1->results as $item)
        <div class="card">
            <h5>{{$item->artistName}} - {{$item->trackName}}</h5>
            <audio controls controlsList="nodownload">
                    <source src="{{$item->previewUrl}}" type="audio/mp4">
                  Your browser does not support the audio element.
            </audio>
        </div>
    @endforeach
</div> --}}
<section id="addsong" class="mb-5 mt-3">
    <div class="container">
    {{-- @include('common.errors') --}}
    
    <form action="/songs" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="song-artist">Artist</label>
            <input type="text" name="artist" id="song-artist" class="form-control" placeholder="Enter Artist or Band name">
        </div>
        <div class="form-group">
            <label for="song-name">Song</label>
            <input type="text" name="songname" id="song-name" class="form-control" placeholder="Enter Song or Track name">
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
        {{-- <div class="form-group">
            <button type="submit" class="col-md-4 btn btn-success btn-raised">
                Add Song    
            </button>    
            <button type="button" class="col-md-4 offset-md-2 btn btn-danger btn-raised">
                Cancel    
            </button>    
        </div>    --}}
        <div class="form-group mt-4 ms-0">
                <div class="row mx-0">
                <button type="button" onclick="goBack()" class="col-6 btn btn-danger text-left">
                  <i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Cancel    
                </button>    
                <button type="submit" class="col-6 btn btn-success text-right">
                  <i class="fas fa-plus"></i>&nbsp;&nbsp;Add Song    
                </button>    
                </div>
          
              </div>  
    </form>
    </div>
</section>
    @endsection
    
    