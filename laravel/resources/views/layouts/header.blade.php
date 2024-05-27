
    <!-- Header -->
    <header class="intro-header">
        <div class="container">
            <div class="intro-message">
                <h1 class="d-none d-sm-block">Feeduciary</h1>
                <h4 class="font18 pt-4 pt-sm-0">Let The Annual Fee Set You Free</h4>
                <hr class="intro-divider" />
                <?php
                if (!isset($verified)) $verified = "";
                if (!isset($name))  $name  = "";
                if (!isset($email)) $email = "";
                ?>

                @if (auth()->check() || $verified===true)
                    <form id="frmContact" method="GET" action="{{url('/calculateFee')}}">
                    {{ csrf_field() }}
                @else
                    <form id="frmContact" method="get" action="{{url('/signup/store')}}">
                    {{ csrf_field() }}
                @endif

                    <div class="bluebox text-left" style="margin:0 auto; width:40%; min-width:280px;">
                        <h4 class="mb-3 text-center font18"> Please enter investment amount to calculate fees</h4>
                        <div class="form-group">
                            <label for="amount" class="d-none d-sm-block">Amount*</label>
                            <input type="text" class="form-control comma" id="amount"  name="amount"  placeholder="Amount" autofocus/>
                        </div>
                        <div class="form-group">
                            <label for="zipcode" class="d-none d-sm-block">Zip Code</label>
                            <input type="text" class="form-control"       id="zipcode" name="zipcode" placeholder="Zip Code" />
                        </div>
                        <div class="form-group row">

                            <div class="col-6 pl-3">
                                @if (auth()->check() || $verified===true)
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                @else
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#yourModal">
                                        @if ($verified==="") 
                                            Submit Email
                                        @else
                                            @if ($verified===false) 
                                                Want to Resend?
                                            @else
                                                @if ($verified===true) 
                                                    Submit
                                                @else
                                                    None {{ $verified }}
                                                @endif
                                            @endif
                                        @endif
                                    </button>
                                @endif
                            </div>
                            <div class="col-6">
                                <a href="https://twitter.com/feeduciary" target="_blank">
<img align="right" src="{{ asset('/images/social-twitter.png') }}" alt="feeduciary on twitter" />
                                </a>
                            </div>
                        </div>
                        @include ('layouts.errors') 

@include('signup.debug')

                    </div>
<!-- if its true the submit button will not call this, this will never execute -->
                    @include('signup.ask4email')
                </form>
            </div>
        </div>
    </header>
