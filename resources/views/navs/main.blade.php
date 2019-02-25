<nav class="navbar navbar-expand-md navbar-semitransparent d-none d-md-block" id="mainNav">
  <div class="container navbar-nav text-uppercase">
    <a class="" href="{{ url('/') }}">
      <img src="{{ url('/') }}/favicon.ico" alt="" style="height: 2rem; color: black;">
    </a>
    @if (Route::currentRouteName() === NULL) &nbsp;&nbsp;The Party 
    @elseif (Route::currentRouteName() === 'profile') &nbsp;&nbsp; My {{Route::currentRouteName()}}
    @elseif (Route::currentRouteName() === 'iamjob') &nbsp;&nbsp; The Job List
    @else &nbsp;&nbsp;The {{Route::currentRouteName()}}
    @endif
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-brand navbar-nav mr-auto">
        {{-- <img src="favicon.ico" alt="" style="height: 2rem;">&nbsp;&nbsp;{{$settings['sitename']}} --}}
      </ul>
      
      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        {{-- <li class="nav-item">
          @if (Route::has('register'))
          <a class="nav-link js-scroll-trigger" href="{{ route('register') }}">{{ __('Register') }}</a>
          @endif
        </li> --}}
        @else
        @if (Auth::user()->usergroup_id === 1)
        <li class="nav-item">
          <a href="{{url('/settings/0/edit')}}" class="nav-link js-scroll-trigger"><i class="fas fa-cog"></i>  Settings</a>
        </li>
        @endif
        <li class="nav-item">
          <a href="{{url('/')}}" class="nav-link js-scroll-trigger"><i class="fas fa-birthday-cake"></i>  Party</a>
        </li>
        <li class="nav-item">
          <a href="{{route('playlist')}}" class="nav-link js-scroll-trigger"><i class="fas fa-music"></i>  Playlist</a>
        </li>
        @if (Auth::user()->usergroup_id < 3)
        <li class="nav-item">
          <a href="{{route('iamjob')}}" class="nav-link js-scroll-trigger"><i class="fas fa-tasks"></i>  Jobs</a>
          {{-- <a href="#features" class="nav-link js-scroll-trigger"><i class="fas fa-tasks"></i>  The Jobs</a> --}}
        </li>
        @endif
        <li class="nav-item">
          <a href="{{route('profile')}}" class="nav-link js-scroll-trigger"><i class="fas fa-user-circle"></i>  Profile</a>
        </li>
        <li class="nav-item">              
          <a class="nav-link js-scroll-trigger" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          {{-- Logout ({{ Auth::user()->name }}) --}}
          <i class="fas fa-lock"></i>  Logout
        </a>            
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
      @endguest
    </ul>
  </div>
</div>
</div>
</nav>