@guest

@else    
<nav class="nav navbar nav-justified nav-pills flex-row flex-sm-row text-black navbar-light bg-white fixed-bottom d-md-none p-0">
    <a class="flex-sm-fill text-sm-center nav-item nav-link text-black pb-1 pt-2" href="{{url('/')}}">
      <i class="fas fa-lg fa-birthday-cake"></i><br><small>Party</small>
    </a>
    <a class="flex-sm-fill text-sm-center nav-item nav-link text-black pb-1 pt-2" href="{{route('playlist')}}">
      <i class="fas fa-lg fa-music"></i><br><small>Playlist</small>
    </a>
    @if (Auth::user()->usergroup_id < 3)
    <a class="flex-sm-fill text-sm-center nav-item nav-link text-black pb-1 pt-2" href="{{route('iamjob')}}">
      <i class="fas fa-lg fa-tasks"></i><br><small>Jobs</small>
    </a>
    @endif
    <a class="flex-sm-fill text-sm-center nav-item nav-link text-black pb-1 pt-2" href="{{route('profile')}}">
      <i class="fas fa-lg fa-user"></i><br><small>Profile</small>
    </a>
    <a class="flex-sm-fill text-sm-center nav-item nav-link text-black pb-1 pt-2" href="{{ route('logout') }}"
    onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
      <i class="fas fa-lg fa-lock"></i><br><small>Logout</small>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
    </a>
  </nav>

@endguest
