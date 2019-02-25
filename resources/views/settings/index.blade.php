@extends('layouts.app')
@section('content')
@include('navs.main')
<header class="masthead text-white text-center">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
          <h2>{{$message}}</h2>
        </div>            
        @endif
        <h1 class="mb-5">{{Route::currentRouteName()}}</h1>
        <a class="btn btn-outline-light btn-lg font-weight-bold" href="{{action('SettingsController@edit', $settings->id)}}" role="button">Edit Settings</a>
      </div>
    </div>
  </div>
</header>
<div class="containerx px-2">
  <main class="pb-5">
  </main>
</div>
@endsection