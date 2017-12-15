
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/Black-logo.png') }}" height="40" /> 
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">

                    <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                    <li class="nav-item">
                        <a class="nav-link" id="home"  href="/">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="rss"  href="/rss">RSS</a>
                    </li>

                    @if (Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/update">Update</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Register</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
