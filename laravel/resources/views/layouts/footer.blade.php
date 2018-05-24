<!-- Footer -->
<footer class="text-center small">
    <div class="container">
        <div class="row">
            <div class="col-sm-2"> </div>
            <div class="col-sm-8">
                Advisor information, including fees, are subject to change. Please view public disclosures on Securities Exchange Commission database or contact the advisor directly to verify all information posted on Feeduciary.com.        
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"> </div>
            <div class="col-sm-8">
                <ul class="list-inline" style="margin:6px 0;">

                    <li class="list-inline-item"><a href="/">Home</a></li>
                    <li class="footer-menu-divider list-inline-item">&sdot;</li>
<!--
                    <li class="list-inline-item"><a href="{{ url('about') }}">About</a></li>
                    <li class="footer-menu-divider list-inline-item">&sdot;</li>

                    <li class="list-inline-item"><a href="#services">Services</a></li>
                    <li class="footer-menu-divider list-inline-item">&sdot;</li>

                    <li class="list-inline-item"><a href="{{ url('rss') }}">RSS</a></li>
                    <li class="footer-menu-divider list-inline-item">&sdot;</li>
-->
                    <li class="list-inline-item"><a href="{{ url('contact') }}">Contact</a></li>
                    <li class="footer-menu-divider list-inline-item">&sdot;</li>

                    <li class="list-inline-item"><a href="{{ url('terms') }}">Terms of Use</a></li>
                    <li class="footer-menu-divider list-inline-item">&sdot;</li>

                    <li class="list-inline-item"><a href="{{ url('privacy') }}">Privacy Policy</a></li>
                    <li class="footer-menu-divider list-inline-item">&sdot;</li>

                    @if (Auth::check())
                        <li class="list-inline-item"><a href="{{ route('logout') }}">Logout</a></li>
                    @else
                        <li class="list-inline-item"><a href="{{ route('login') }}">Login</a></li>
                        <li class="footer-menu-divider list-inline-item">&sdot;</li>

                        <li class="list-inline-item"><a href="{{ route('register') }}">Register</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-sm-2"> </div>
        </div>
        <div class="row">
            <div class="col-sm-2"> </div>
            <div class="col-sm-8">
                <span class="copyright text-muted small">Copyright &copy; Feeduciary.com <?= date("Y"); ?>.&nbsp; All Rights Reserved</span>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
