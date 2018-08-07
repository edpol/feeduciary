
    <!-- Header -->
    <header class="intro-header">
        <div class="container">
            <div class="intro-message">
                <h1>Feeduciary</h1>
                <h4>Let The Annual Fee Set You Free</h4>
                <hr class="intro-divider" />

                <div class="bluebox" style="margin:0 auto; text-align:left; width:40%; min-width:280px;">
                    <form method="GET" action="{{url('/calculateFee')}}">
                        {{ csrf_field() }}
                        <div class="mb-3 text-center"> Please enter investment amount to calculate fees</div>
                        <div class="form-group mb-2 mb-md-3 row">
                            <label class="col-md-2 pt-2 px-0 text-right" for="amount">amount*&nbsp;</label>
                            <input type="text" class="form-control col-md-9 comma" name="amount" autofocus/>
                        </div>
                        <div class="form-group mb-2 mb-md-3 row">
                            <label class="col-md-2 pt-2 px-0 text-right" for="zipcode">zip code&nbsp;</label>
                            <input type="text" class="form-control col-md-9" id="zipcode" name="zipcode" />
                        </div>
                        <div class="form-group row">

                            <div class="col-md-6">
                                @if (auth()->check() or request()->cookie('email') )
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                @else
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#yourModal">popup</button>
                                @endif
                            </div>
                            <div class="col-md-5 pr-0">
                                <a href="https://twitter.com/feeduciary" target="_blank">
                                    <img align="right" src="{{ url('/images/social-twitter.png') }}" alt="twitter find advisor" />
                                </a>
                            </div>
                        </div>
                        @include ('layouts.errors') 
                    </form>
@if (auth()->check())
    advisor logged in
@else
    Not logged in
@endif
<br />
<!-- this is set to true or false before we get to this page -->
@if (request()->cookie('ask_for_email')===true)
    cookie ask_for_email is TRUE {{ session('ask_for_email') }}
@else
    cookie ask_for_email is NOT TRUE {{ session('ask_for_email') }}
@endif
<br />
@if (request()->cookie('email'))
    found cookie email {{ request()->cookie('email') }}
@else
    did NOT find cookie email
@endif
<br />
<?php
$number_of_bytes = 64;
$token = bin2hex(random_bytes($number_of_bytes));
echo strlen($token);
    echo "<pre>{$token}<br />";
    echo "123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 12345678 </pre>";

?>
                </div>
                @include('layouts.ask4email')
            </div>
        </div>
    </header>
