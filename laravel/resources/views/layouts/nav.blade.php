    <!-- Navigation -->


    <div class="navbar-header">

                <button aria-expanded="false" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" type="button">

                <span class="sr-only">Toggle navigation</span>

                <span class="icon-bar"></span><span class="icon-bar"></span>

                <span class="icon-bar"></span></button>

                <a href="index.html" target="_self" title="SteuartHall.com">

                <img alt="" height="150" src="images/Steuart11310-1-72dpi-150px.jpg" width="150" /></a>

    </div>

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
                        <a class="nav-link" id="home"  href="{{ url('/') }}">Home</a>
                    </li>
<!--
                    <li class="nav-item">
                        <a class="nav-link" id="rss"  href="{{ url('/rss') }}">RSS</a>
                    </li>
-->
<!--
                    if   (Auth::check())
-->                 @if (auth()->check())

                        @if (auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" id="updateAdvisors" href="{{ url('/admin/advisors') }}">Update Advisors</a>
                            </li>
                        @endif

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"  href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li class="nav-item">
                                    <a  class="nav-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout 
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                                <li class="nav-item">
<!--
                                     if   (Auth::user()->isAdmin()) this works too
-->                                 @if (auth()->user()->isAdmin())
                                        <a class="nav-link" href="{{ url('/admin/advisors') }}">Update Advisors</a>
                                    @else
                                        <a class="nav-link" href="{{ url('/update') }}">Update</a>
                                    @endif
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"  href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                                Advisors <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/login') }}">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/register') }}">Register</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>

        </div>
    </nav>
