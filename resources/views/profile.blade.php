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
          <div class="card-header card-header-job">
            <div class="flex-1 capitalize">
              <div class="text-info text-uppercase"><small>Name</small></div>
              <div><h5>{{$kid->kidname}}</h5></div>
            </div>
          </div>
        </div>
        <div class="card card-default">
          <div class="card-header card-header-job">
            <div class="flex-1 capitalize">
              <div class="text-info text-uppercase"><small>Hoodie Name</small></div>
              <div><h5>{{$kid->hoodiename}}</h5></div>
            </div>
            <div class="pt-2">
                <a class="btn btn-success btn-raised disabled">Save Choice</a>
              </div>
          </div>
        </div>
        <div class="card card-default">
          <div class="card-header card-header-job">
            <div class="flex-1 capitalize">
              <div class="text-info text-uppercase"><small>Hoodie Size</small></div>
              <div class="text-muted"><h5>{{$kid->hoodiesize}}</h5></div>
            </div>
            <div class="pt-2">
              <a class="btn btn-success btn-raised disabled">Save Choice</a>
            </div>
          </div>
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
      </div>
    </div>
    @endforeach
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
    
    {{-- TEST SHOW ALL JOB DETAILS WITH COMMENTS AND HELPERS --}}
    <div class="row">
        @foreach ($jobs as $job)
        <?php $signedup = 0; ?>
        @if (count($job->users) === 0)
        <?php $text_colour = 'text-danger'; ?>
        @elseif (count($job->users) < $job->users_required)
        <?php $text_colour = 'text-black' ;?>
        @elseif (count($job->users) === $job->users_required)
        <?php $text_colour = 'text-black' ;?>
        @endif
        <div class="col-lg-12 mb-3" id="j{{$job->id}}">
          <div class="card card-default">
            {{-- <h5 class="card-header bg-primary text-white">{{$job->name}}</h5> --}}
            <div class="card-header card-header-job pb-0 bg-light">
              <div class="flex-1 capitalize">
                <a href="#job{{$job->id}}" class="btn btn-block text-left p-0 m-0" data-toggle="collapse">
                <div class="text-info"><small>{{$job->jobtype->type}}</small></div>
                <div class=""><h5>{{$job->name}}</h5></div>
                </a>
              </div>
              <div class="col-4 hidden">
                <a href="#job{{$job->id}}" class="btn btn-block text-default px-0 py-3 m-0" data-toggle="collapse">
                  {{-- <a href="{{url("/jobs/{$job->id}")}}" class="btn btn-block text-default px-0 py-3 m-0"> --}}
                  <span class="d-md-none"><i class="fas fa-info"></i>&nbsp;&nbsp;</span>
                  <span class="d-none d-md-block"><i class="fas fa-info"></i>&nbsp;&nbsp;Info</span>
                </a>
              </div>
              {{-- <a href="#job{{$job->id}}" class="btn btn-block text-center card-header-job_plus m-auto" data-toggle="collapse"><i class="fas fa-plus"></i></a> --}}
            </div>
            <div id="job{{$job->id}}" class="card-body collapse">
              <div class="card-text">
                <h6 class="card-subtitle mb-2 text-dark">Details</h6>
                <div class="card-text">{{$job->details}}&nbsp;</div>
                {{-- <div class="card-text p-0">
                  <a href="#" class="btn btn-block btn-success btn-square px-0 py-2">SIGN UP</a>
                </div> --}}
                @if (count($job->users) > 0)
                <hr>
                <div class="card-text">
                  <h6 class="card-subtitle mb-2 text-primary"><i class="fas fa-user-check"></i>&nbsp;&nbsp;Helpers</h6>
                  @foreach ($job->users as $user)
                  @if ($user->id == Auth::id()) <?php $signedup = 1; ?>@endif
                  <?php 
                  $left = strpos($user->name," ");
                  if($left == 0) {$left = strlen($user->name);}
                  ?>             
                  <div>{{substr($user->name,0, $left + 2)}}</div>
                  @endforeach
                </div>
                @endif
                
                <!-- JOB COMMENTS SECTION START -->
                <hr>
                <h6 id="#job{{$job->id}}comments" class="card-subtitle mb-2 text-info"><i class="fas fa-comment"></i>&nbsp;&nbsp;Comments</h6>
                @if (count($job->comments) > 0)
                @foreach ($job->comments as $comment)
                <?php 
                $left = strpos($comment->author->name," ");
                if($left == 0) {$left = strlen($comment->author->name);}
                ?>             
                {{-- <div class="card"> --}}
                  <div class="flex">
                    <div class="flex-1">
                      <div class="card-body p-0 m-0">
                        <div><span class="text-info">{{substr($comment->author->name,0, $left + 2)}}</span>&nbsp;&nbsp;<small>{{ $comment->created_at->diffForHumans() }}</small></div>
                        <div><p class="mb-0">{{$comment->comment}}</p></div>
                      </div>
                    </div>
                    @if ($comment->author->id == Auth::id())
                    <div class="col-1 text-muted">
                      <div class="dropdown">
                        <button class="btn bmd-btn-icon dropdown-toggle" type="button" id="ex#job{{$job->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="material-icons">more_vert</i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="ex#job{{$job->id}}">
                          
                          <button type="submit" class="btn btn-block text-default text-left disabled">
                            <span class=""><i class="fas fa-edit"></i>&nbsp;&nbsp;Edit</span>
                          </button>
                          
                          <form class="p-0 m-0" action="{{url('comments', [$comment->id])}}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-block text-danger text-left">
                              <span class=""><i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Delete</span>
                            </button>
                          </form>                            
                          
                          
                          {{-- <a class="dropdown-item" href="#job{{$job->id}}"><i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Delete</a> --}}
                        </div>
                      </div>
                      {{-- </div> --}}
                      @endif
                    </div>
                  </div>
                <br>
                @endforeach
                @endif
                <form class="" method="POST" action="/jobs/{{ $job->id }}/comments">
                  {{ csrf_field() }}
                  <div class="input-group pt-0">
                    <textarea name="comment" placeholder="Add a new comment" class="form-control"></textarea>
                    <div class="input-group-append mx-3">
                      <button type="submit" class="btn btn-primary float-right input-group-text" id="basic-addon2"><i class="far fa-2x fa-arrow-alt-circle-right"></i></button>
                    </div>
                  </div>
                </form>
                <!-- JOB COMMENTS SECTION END -->
              </div>  
            </div>
            <div class="card-footer bg-light text-center py-0">
              <div class="row">
                {{-- <div class="col-3 p-0">
                  <a href="#job{{$job->id}}" class="btn btn-block text-default px-0 py-3 m-0" data-toggle="collapse">Details</a>
                </div> --}}
                <div class="col-4 p-0">
                  <a href="#job{{$job->id}}" style="-pointer-events: none;" class="btn btn-block text-default px-0 py-3 m-0" data-toggle="collapse">
                    <span class="d-md-block"><i class="fas fa-comment"></i>&nbsp;&nbsp;{{count($job->comments)}}</span>
                  </a>
                </div>
                <div class="col-4 p-0">
                  <a href="#job{{$job->id}}" style="pointer-events: none;" class="btn btn-block text-default px-0 py-3 m-0 {{$text_colour}}" data-toggle="collapse"><i class="fas fa-users"></i>  {{count($job->users)}}/{{ $job->users_required }}</a>
                </div>
                <div class="col-4 p-0">
                  @if ($signedup == 1)
                  <form class="p-0 m-0" action="{{url('jobs', [$job->id])}}" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-block text-success px-0 py-3 m-0">
                      <span class="d-md-none"><i class="fas fa-user-check"></i></span>
                      <span class="d-none d-md-block"><i class="fas fa-user-check"></i>&nbsp;&nbsp;Signed Up</span>
                    </button>
                  </form>
                  @elseif ($job->users_required - count($job->users) == 0) 
                  <button disabled="disabled" style="pointer-events: none;" class="btn btn-block text-default px-0 py-3 m-0">
                    <span class="d-md-none"><i class="fas fa-user-check"></i></span>
                    <span class="d-none d-md-block"><i class="fas fa-user-check"></i>&nbsp;&nbsp;Job Full</span>
                  </button>
                  @else 
                  <form class="p-0 m-0" action="{{url('jobs', [$job->id])}}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-block text-default px-0 py-3 m-0">
                      <span class="d-md-none"><i class="fas fa-user-plus"></i></span>
                      <span class="d-none d-md-block"><i class="fas fa-user-plus"></i>&nbsp;&nbsp;Sign Up</span>
                    </button>
                  </form>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @endif
      @if (Auth::user()->usergroup_id == 3)
          
      <div class="row">
        @php $i = 0; @endphp
        <div class="col-lg-12 mb-3">
          <div class="card card-default">
            <div class="card-header bg-light py-3">
              <h3>My Tracks</h3>
            </div>
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
        <p><a href="{{URL::to('/')}}/songs/create" class="btn btn-success btn-outline"><i class="fas fa-plus"></i> Add Song</a></p>
        @endif
      @endif
  </main>
</div>
@endsection
