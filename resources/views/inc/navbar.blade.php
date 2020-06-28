<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
  <div class="container">
      <a class="navbar-brand" @if(Auth::check()) href="{{ url('/timeline') }}" @else href="{{ url('/') }}" @endif>
          {{ config('app.name') }}
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
              @if(Auth::check())
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/timeline') }}">Timeline <span class="sr-only">(current)</span></a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="{{ url('/friends') }}">Friends</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/channel') }}">Chat</a>
              </li>
                <form class="form-inline active-cyan-3 active-cyan-4" action="{{ route('search.results') }}">
                <div class="input-group md-form form-sm form-2 pl-0">
                  <input class="form-control my-0 py-1" type="text" placeholder="Search" aria-label="Search" name="query">
                  <div class="input-group-append">
                    <button type="submit" id="something">
                      <span class="input-group-text cyan lighten-2" id="basic-text1"><img src="{{ asset('img/misc/search.png') }}"></span>
                    </button>
                    
                  </div>
              </div>
              </form>
              @endif
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
                    <a id="notification" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i class="fa fa-bell"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notification">

                    @for($i = 0; $i < 10; $i++)
                        <a class="dropdown-item" href="something">fff</a>
                    @endfor
                    
                        
                    </div>
                  </li>
              <!-- Authentication Links -->
              @guest
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                  @if (Route::has('register'))
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                      </li>
                  @endif
              @else

              <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.profile', ['username' => Auth::user()->name]) }}">
                        @if(is_null(Auth::user()->profile))
                              <img  class="avatar-profile" src="{{ asset('img/misc/mysteryman.png') }}" width="20" height="20">
                        @else
                              <img src="{{ asset('img/avatar/') . Auth::user()->profile }}" class="avatar-profile">
                        @endif
                    
                    </a>
                  </li>
                  <li class="nav-item dropdown">

                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                          <a class="dropdown-item" href="{{ route('user.profile', ['username' => Auth::user()->name]) }}">Profile</a>
                          <a class="dropdown-item" href="{{ route('profile.edit') }}">Update Profile</a>
                          <a class="dropdown-item" href="{{ url('/settings') }}"><svg height="16px" width="16px" version="1.1" viewBox="0 0 16 16" x="0px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" y="0px" class="svgIcon"><path d="M15.5,8.9V7.1l-2.2-0.5c-0.1-0.5-0.3-0.9-0.6-1.3l1.2-1.9l-1.2-1.2l-1.9,1.2C10.3,3,9.9,2.8,9.4,2.7L8.9,0.5 H7.1L6.6,2.7C6.1,2.8,5.7,3,5.2,3.2L3.3,2.1L2.1,3.3l1.2,1.9C3,5.7,2.8,6.1,2.7,6.6L0.5,7.1v1.7l2.2,0.5c0.1,0.5,0.3,0.9,0.6,1.3 l-1.2,1.9l1.2,1.2l1.9-1.2c0.4,0.2,0.9,0.4,1.3,0.6l0.5,2.2h1.7l0.5-2.2c0.5-0.1,0.9-0.3,1.3-0.6l1.9,1.2l1.2-1.2l-1.2-1.9 c0.2-0.4,0.4-0.9,0.6-1.3L15.5,8.9z M8,11c-1.7,0-3-1.3-3-3c0-1.7,1.3-3,3-3c1.7,0,3,1.3,3,3C11,9.7,9.7,11,8,11z" fill="#bec2c9" stroke="#bec2c9"></path></svg> Settings</a>
                          <hr>
                          <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                      </div>
                  </li>

              @endguest
          </ul>
      </div>
  </div>
</nav>