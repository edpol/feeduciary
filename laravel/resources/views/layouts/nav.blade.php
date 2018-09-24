
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">

        <div class="container">

            <!-- Left Side Of Navbar -->
            <a class="navbar-brand" href="{{ env('APP_URL') }}">
                <div class="row m-0 p-0">
                    <div    class="col-md-2  col-2 px-0 mx-0">
                        <img class="col-md-12 px-0" src="{{ asset('images/logo.png') }}" />
                    </div>
                    <div    class="col-md-10 col-10 p-0  m-0" style="line-height: 90%;">
                        <h4 class="col-md-12   pt-1 px-0 m-0">Feeduciary</h4>
                        <h6 class="p-0 m-0 font11" style="color:green;">Let The Annual Fee Set You Free</h6>
                    </div>
                </div>
            </a>

            <!-- the navigation bar is hidden on small screens and replaced by a button in the top right corner -->
            <button class="navbar-toggler px-0 mr-1" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">

                <!-- Middle and Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- if we are displaying advisors, we show the search option -->
                    @if ($tab == "Display Advisor")
                        <!-- Search Section -->
                        <form id='myform' action="{{ url('/search') }}" method="GET">
<!--                            <li class="nav-item"> -->
                                {{ csrf_field() }}
<?php                           if (auth()->check() && auth()->user()->isAdmin()) {
                                    $target='/admin/advisors/list';
                                } else {
                                    $target='/advisors';
                                }
?>                              <button type="submit" class="btn btn-primary" formaction="{{ url($target) }}">Reset Search</button> 
                                <button type="submit" class="btn btn-primary"><image src="{{ asset('/images/search.png')}}"/></button>
                                <input class="search" type="text" name="search" placeholder="search" />
<!--                            </li>  -->
                        </form>
                    @endif

                    <!-- Right Side Of Navbar -->
                    <li class="nav-item">
                        <a class="nav-link" id="home"  href="{{ url('/') }}">Home</a>
                    </li>
<!--                <li class="nav-item">
                        <a class="nav-link" id="rss"  href="{{ url('/rss') }}">RSS</a>
                    </li>
-->
                    @if (auth()->check())
<!--
                        @if (auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" id="updateAdvisors" href="{{ url('/admin/advisors/list') }}">Update Advisors</a>
                            </li>
                        @endif
-->
                        <!-- Drop down menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"  href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li class="nav-item">
                                    <a  class="nav-link" href="{{ url('/logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout 
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="GET" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                                <li class="nav-item">
<!--
                                     if   (Auth::user()->isAdmin()) this works too
-->                                 @if (auth()->user()->isAdmin())
                                        <a class="nav-link" href="{{ url('/admin/advisors/list') }}">Update Advisors</a>
                                        <a class="nav-link" href="{{ url('/admin/create')        }}">Create Advisor </a>
                                        <a class="nav-link" href="{{ url('/signup/download')     }}">Download Emails</a>
                                        <a class="nav-link" href="{{ url('/advisors/download')   }}">Advisors Emails</a>
                                        <a class="nav-link" href="{{ url('/history/download')    }}">Search History </a>
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
