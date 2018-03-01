<!-- Footer -->
<footer style="text-align: center;">
    Fees listed are subject to change. Please contact the advisor directly to verify fees. 
    <div class="container">
        <ul class="list-inline">
            <li class="list-inline-item"><a href="/">Home</a></li>
            <li class="footer-menu-divider list-inline-item">&sdot;</li>
<!--
            <li class="list-inline-item"><a href="/about">About</a></li>
            <li class="footer-menu-divider list-inline-item">&sdot;</li>

            <li class="list-inline-item"><a href="#services">Services</a></li>
            <li class="footer-menu-divider list-inline-item">&sdot;</li>
-->
            <li class="list-inline-item"><a href="/rss">RSS</a></li>
            <li class="footer-menu-divider list-inline-item">&sdot;</li>

            <li class="list-inline-item"><a href="/contact">Contact</a></li>
            <li class="footer-menu-divider list-inline-item">&sdot;</li>

            @if (Auth::check())
                <li class="list-inline-item"><a href="{{ route('logout') }}">Logout</a></li>
            @else
                <li class="list-inline-item"><a href="{{ route('login') }}">Login</a></li>
                <li class="footer-menu-divider list-inline-item">&sdot;</li>

                <li class="list-inline-item"><a href="{{ route('register') }}">Register</a></li>
            @endif
        </ul>
        <p class="copyright text-muted small">Copyright &copy; Feeduciary.com <?= date("Y"); ?>.&nbsp; All Rights Reserved</p>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
