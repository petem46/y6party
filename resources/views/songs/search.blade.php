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
                <h1 class="mb-5">Song Search</h1>
            </div>
        </div>
    </div>
</header>
<div>
    @foreach ($response->results as $item)
        <div class="card">
            <h5>{{$item->artistName}} - {{$item->trackName}}</h5>
            <audio controls controlsList="nodownload">
                    <source src="{{$item->previewUrl}}" type="audio/mp4">
                  Your browser does not support the audio element.
            </audio>
        </div>
    @endforeach
</div>

    @endsection
    
    