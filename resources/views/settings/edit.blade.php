@extends('layouts.app')
@section('content')
@include('navs.main')
<header class="masthead text-white text-center">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <h1 class="mb-5">{{Route::currentRouteName()}}</h1>
      </div>
    </div>
  </div>
</header>
<div class="container">
  <main class="pb-5">
    <form action="{{action('SettingsController@update', $id)}}" method="POST" class="form-horizontal">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="PATCH" />
      <div class="form-group">
        <label for="setting-sitename">Sitename</label>
        <input type="text" name="sitename" id="setting-sitename" class="form-control" value="{{$setting->sitename}}" placeholder="sitename">
      </div>
      <div class="form-group">
        <label for="setting-partydate">partydate</label>
        <input type="date" name="partydate" id="setting-partydate" class="form-control" value="{{$setting->partydate}}" placeholder="partydate">
      </div>
      <div class="form-group">
        <label for="setting-starttime">starttime</label>
        <input type="time" name="starttime" id="setting-starttime" class="form-control" value="{{$setting->starttime}}" placeholder="starttime">
      </div>
      <div class="form-group">
        <label for="setting-endtime">endtime</label>
        <input type="time" name="endtime" id="setting-endtime" class="form-control" value="{{$setting->endtime}}" placeholder="endtime">
      </div>
      <div class="form-group">
        <label for="setting-venuename">venuename</label>
        <input type="text" name="venuename" id="setting-venuename" class="form-control" value="{{$setting->venuename}}" placeholder="venuename">
      </div>
      <div class="form-group">
        <label for="setting-venuelocation">venuelocation</label>
        <input type="text" name="venuelocation" id="setting-venuelocation" class="form-control" value="{{$setting->venuelocation}}" placeholder="venuelocation">
      </div>
      <div class="form-group">
        <label for="setting-venuemapurl">venuemapurl</label>
        <input type="text" name="venuemapurl" id="setting-venuemapurl" class="form-control" value="{{$setting->venuemapurl}}" placeholder="venuemapurl">
      </div>
      <div class="form-group">
        <button type="submit" class="col-md-4 btn btn-raised btn-primary">
          <i class="fas fa-check"></i> Save Settings    
        </button>    
        <button type="button" class="col-md-4 offset-md-2 btn btn-raised btn-link" onclick="goBack()">
          Cancel    
        </button>    
      </div>   
    </form>
  </main>
</div>
@endsection