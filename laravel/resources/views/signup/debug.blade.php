@if (env("APP_ENV")!="production")
    <div class="form-group text-warning">
        Verified: @if ($verified) true @else false @endif <br />
        Name: {{ $name }} <br />
        Email: {{ $email }} <br />

        @if (auth()->check())
            advisor logged in
        @else
            Not logged in
        @endif
        <br />

        @if ($verified==="")
            verified is null, no cookie
        @else
<?php
        $json_cookie = Cookie::get('signup');
        $cookie = json_decode($json_cookie,true);
        if ($cookie!==null) {
            foreach ($cookie as $key => $value) {
                echo "\$cookie[{$key}] = $value <br />\n";
            }
        }
 ?>
        @endif

        @if ($verified===true)
            verified is true, found cookie
        @endif

        @if ($verified===false)
            verified is false, found cookie
        @endif
        <br />

        @if(COOKIE_NAME!==null)
        Cookie Name: {{ COOKIE_NAME }} <br />
        @endif

    </div>
@endif
