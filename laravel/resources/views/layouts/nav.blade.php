    <!-- Navigation -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <div style="float:left; padding-top:10px;"><img src="{{ asset('images/logo.png') }}" height="40" /></div>
                <div style="float:left;vertical-align: top;">
                    <div style="color:black; font-size:26px; padding:0; margin:0;">Feeduciary</div>
                    <div style="color:green; font-size:14px; padding:0; margin:0; margin-top:-6px;">Let The Annual Fee Set You Free</div>
                </div>
                <br clear="all" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">

                    <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
@if ($tab == "Display Advisor")
                        <form id='myform' action="{{ url('/search') }}" method="GET">
                            <li class="nav-item">
                                {{ csrf_field() }}
<?php                           if (auth()->check() && auth()->user()->isAdmin()) {
                                    $target='/admin/advisors/list';
                                } else {
                                    $target='/advisors';
                                }
?>                              <button type="submit" class="btn btn-primary" formaction="{{ url($target) }}">Reset Search</button> 
                                <button type="submit" class="btn btn-primary"><image src="{{ asset('/images/search.png')}}"/></button>
                                <input class="search" type="text" name="search" placeholder="search" />
                            </li>
                        </form>
@endif

                    <li class="nav-item">
                        <a class="nav-link" id="home"  href="{{ url('/') }}">Home</a>
                    </li>
<!--                <li class="nav-item">
                        <a class="nav-link" id="rss"  href="{{ url('/rss') }}">RSS</a>
                    </li>
-->
                    @if (auth()->check())

                        @if (auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" id="updateAdvisors" href="{{ url('/admin/advisors/list') }}">Update Advisors</a>
                            </li>
                        @endif

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
                                        <a class="nav-link" href="{{ url('/admin/create') }}">Create Advisor</a>
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
