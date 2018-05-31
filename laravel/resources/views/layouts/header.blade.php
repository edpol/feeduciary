
    <!-- Header -->
    <header class="intro-header">
        <div class="container">
            <div class="intro-message">
                <h1>Feeduciary</h1>
                <h4>Let The Annual Fee Set You Free!</h4>
                <hr class="intro-divider" />
                    <div class="bluebox" style="margin:0 auto; text-align:left; width:40%; min-width:280px;">
                        <form method="GET" action="{{url('/calculateFee')}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="amount">Please enter investment amount:</label>
                                <input type="text" class="form-control comma" name="amount" autofocus/>
                            </div>
                            <div class="form-group">
                                <label for="zipcode">Zip Code:</label>
                                <input type="text" class="form-control" id="zipcode" name="zipcode" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="https://twitter.com/feeduciary" target="_blank">
                                    <img align="right" src="{{ url('/images/social-twitter.png') }}" alt="twitter find advisor" />
                                </a>
                            </div>
                            @include ('layouts.errors') 
                        </form>
                    </div>

<!--
                <ul class="list-inline intro-social-buttons">
                    <li class="list-inline-item">
                        <a href="https://twitter.com/feeduciary" class="btn btn-secondary btn-lg">
                            <i class="fa fa-twitter fa-fw"></i>
                            <span class="network-name">Twitter</span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="btn btn-secondary btn-lg">
                            <i class="fa fa-github fa-fw"></i>
                            <span class="network-name">Github</span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="btn btn-secondary btn-lg">
                            <i class="fa fa-linkedin fa-fw"></i>
                            <span class="network-name">Linkedin</span>
                        </a>
                    </li>
                </ul>
-->
            </div>
        </div>
    </header>
