<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
<div class="container">
  <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Year 6 Party App') }}
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
              
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
              <li class="nav-item">
                <a href="{{route('home')}}" class="nav-link js-scroll-trigger"><i class="fas fa-birthday-cake"></i>  The Party</a>
              </li>
              <li class="nav-item">
                <a href="{{route('thejobs')}}" class="nav-link js-scroll-trigger"><i class="fas fa-tasks"></i>  The Jobs</a>
                {{-- <a href="#features" class="nav-link js-scroll-trigger"><i class="fas fa-tasks"></i>  The Jobs</a> --}}
              </li>
              <li class="nav-item">
                <a href="{{route('theplaylist')}}" class="nav-link js-scroll-trigger"><i class="fas fa-music"></i>  The Playlist</a>
              </li>
              <li class="nav-item">
                  <a href="{{route('profile')}}" class="nav-link js-scroll-trigger"><i class="fas fa-user-circle"></i>  My Profile</a>
              </li>
              {{-- <li class="nav-item">              
                <a class="nav-link js-scroll-trigger" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                Logout ({{ Auth::user()->name }})
              </a>            
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li> --}}
            @endguest
          </ul>
        </div>
      </div>
    </div>
      </nav>