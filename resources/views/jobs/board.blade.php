
        {{-- <h3 class="text-uppercase">The Job Board</h3> --}}
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
                {{-- <a href="#job{{$job->id}}" class="btn btn-block text-center card-header-job_plus m-auto" data-toggle="collapse"><i class="fas fa-plus"></i></a> --}}
              </div>
              <div id="job{{$job->id}}" class="card-body collapse <?php if($datatoggle === $job->id) {echo "show";} ?>">
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
                        </div>
                        @endif
                      </div>
                    {{-- </div> --}}
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
              <div class="card-footer bg-white text-center py-0">
                <div class="row">
                  {{-- <div class="col-3 p-0">
                    <a href="#job{{$job->id}}" class="btn btn-block text-default px-0 py-3 m-0" data-toggle="collapse">Details</a>
                  </div> --}}
                  <div class="col-3 p-0">
                      <a class="btn btn-block text-default px-0 py-3 m-0" href="{{action('JobsController@edit', $job->id)}}" role="button">
                          <span class="d-md-none"><i class="fas fa-edit"></i></span>
                        <span class="d-none d-md-block"><i class="fas fa-edit"></i>&nbsp;&nbsp;Edit Job</span>
                      </a>    
                    </a>
                  </div>
                <div class="col-3 p-0">
                    <a href="#job{{$job->id}}" style="-pointer-events: none;" class="btn btn-block text-default px-0 py-3 m-0" data-toggle="collapse">
                      <span class="d-md-block"><i class="fas fa-comment"></i>&nbsp;&nbsp;{{count($job->comments)}}</span>
                    </a>
                  </div>
                  <div class="col-3 p-0">
                    <a href="#job{{$job->id}}" style="pointer-events: none;" class="btn btn-block text-default px-0 py-3 m-0 {{$text_colour}}" data-toggle="collapse"><i class="fas fa-users"></i>  {{count($job->users)}}/{{ $job->users_required }}</a>
                  </div>
                  <div class="col-3 p-0">
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
              <div class="card-footer bg-light text-center py-0">
                <div class="text-dark float-right"><small>Last Updated: {{ $job->updated_at->diffForHumans() }}</small></div>
              </div>           
            </div>
          </div>
          @endforeach
        </div>
      <a href="{{URL::to('/')}}/jobs/create" class="btn btn-success btn-outline float-right mr-3 col-5 col-md-4"><i class="fas fa-plus"></i> Add A Job</a>