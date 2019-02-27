@extends('layouts.app')
@section('content')
@include('navs.main')
<header class="masthead masthead-joblist text-white text-center">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <h1 class="mb-5">Jobs.Create</h1>
      </div>
    </div>
  </div>
</header>
<section id="addsong" class="mb-5 mt-3">
    <div class="container">
  {{-- @include('common.errors') --}}
  <form action="/jobs" method="POST" class="form-horizontal">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="job-name" class="bmd-label-floating">Job/Task Name</label>
      <input type="text" name="name" id="job-name" class="form-control">
      <span class="bmd-help">Enter a simple title to describe the job/task.</span>
      {{-- <input type="text" name="name" id="job-name" class="form-control" placeholder="Enter Job or Task"> --}}
    </div>
    <div class="form-group">
      <label for="jobtype" class="bmd-label-floating">Type</label>
      <select class="form-control" name="jobtype_id" id="jobtype">
        <option value="" disabled selected>--- Select type ---</option>
        @foreach ($types as $type)
        <option value="{{ $type->id }}"
            >{{ $type->type}}
          </option>
          @endforeach
        </select>
      </div> 
      <div class="form-group">
        <label for="job-details" class="bmd-label-floating">Enter Details of the Job/Task</label>
        <textarea rows="4" name="details" id="job-details" class="form-control"></textarea>
        <span class="bmd-help">Enter a details or description of the job/task.</span>
      </div>
      <div class="form-group">
        <label for="job-users_required" class="bmd-label-floating">How many people needed?</label>
        {{-- <input type="text" name="users_required" id="job-users_required" class="form-control" placeholder="Enter number of helper needed for this job"> --}}
        <input type="number" name="users_required" id="job-users_required" class="form-control" min="1" max="25" value="3">
        <span class="bmd-help">Enter the ideal number of volunteers needed for this job/task.</span>
    </div> 
    <div class="form-group mt-4 ms-0">
      <div class="row mx-0">
      <button type="button" onclick="goBack()" class="col-4 btn btn-danger">
        <i class="fas fa-arrow-left"></i> Cancel    
      </button>    
      <button type="submit" class="col-4 offset-4 btn btn-success">
        <i class="fas fa-plus"></i>  Add Job    
      </button>    
      </div>

    </div>   
  </form>
</div>
</section>
@endsection

