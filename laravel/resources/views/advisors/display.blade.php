
                <div class="row">
                    <div class="col-sm-4">
                        name*: <br />
                        phone: <br />
<?php if(isset($hideEmail) && $hideEmail==false) { ?>
                        email*: <br />
<?php } ?>
                        company: <br />
                        address: <br />
                        @if(isset($advisor->address2) && !empty($advisor->address2))
                            <br />
                        @endif
                        <br />
                        minimum amount: <br />
<!--                    maximum amount: <br />
-->                     minimum fee: <br />
                        fee calculation*: <br />
                        Facebook: <br />
                        Finra Brokercheck: <br />
                        Linkedin: <br />
                        Twitter: <br />
                        Discretionary AUM: <br />
                        @if (auth()->check() && auth()->user()->isAdmin())
                            lat/lng: <br />
                        @endif
                        <br />
                    </div>

                    <div class="col-sm-8">
                        <div style="float:left;padding-right:20px;">
                            {{ $advisor->name  }} <br />
                            {{ $advisor->phone }} <br />
                        </div>

<?php if(isset($hideEmail) && $hideEmail==true && !empty($advisor->email)) { ?>
                        <div style="float:right;">
                            <form action="/contact/{{ $advisor->id }}" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary">email</button>
                            </form>
                        </div>
<?php } ?>
                        <br clear="all" /> 

<?php if(isset($hideEmail) && $hideEmail==false) { ?>
                        {{ $advisor->email }} <br />
<?php } ?>

                        @if(isset($advisor->url) && !empty($advisor->url))
                            <a href="{{ $advisor->url }}" target="_blank">
                        @endif
                        {{ $advisor->company }} 
                        @if(isset($advisor->url) && !empty($advisor->url))
                            </a> 
                        @endif
                        <br />

                        {{ $advisor->address1 }} <br />
                        @if(isset($advisor->address2) && !empty($advisor->address2))
                            {{ $advisor->address2 }}<br />
                        @endif

                        {{ $advisor->city }},
                        @if(isset($advisor->st) && !empty($advisor->st))
                            {{ $advisor->st }}
                        @endif
                        {{ $advisor->zip }} <br />

                        @if(isset($advisor->minimum_amt) && !empty($advisor->minimum_amt))
                            ${{ number_format($advisor->minimum_amt, 0) }} 
                        @endif
                        <br />
<!--
                        @if(isset($advisor->maximum_amt) && !empty($advisor->maximum_amt))
                            ${{ number_format($advisor->maximum_amt, 0) }} 
                        @endif
                        <br />
-->
                        @if(isset($advisor->minimum_fee) && !empty($advisor->minimum_fee))
                            ${{ number_format($advisor->minimum_fee, 0) }} 
                        @endif
                        <br />

                        @if ($advisor->feeCalculation==0) 
                            Cumulative rates per tier
                        @else
                            Rate changes with investment amount
                        @endif
                        <br />

                        @if(isset($advisor->facebook) && !empty($advisor->facebook))
                            <a href="{{ $advisor->facebook }}" target="_blank">
                                {{ $advisor->facebook }} 
                            </a> 
                        @endif
                        <br />

                        @if(isset($advisor->finraBrokercheck) && !empty($advisor->finraBrokercheck))
                            <a href="{{ $advisor->finraBrokercheck }}" target="_blank">
                                {{ $advisor->finraBrokercheck }} 
                            </a> 
                        @endif
                        <br />

                        @if(isset($advisor->linkedin) && !empty($advisor->linkedin))
                            <a href="{{ $advisor->linkedin }}" target="_blank">
                                {{ $advisor->linkedin }} 
                            </a> 
                        @endif
                        <br />

                        @if(isset($advisor->twitter) && !empty($advisor->twitter))
                            <a href="{{ $advisor->twitter }}" target="_blank">
                                {{ $advisor->twitter }} 
                            </a> 
                        @endif
                        <br />

                        @if(isset($advisor->discretionaryAUM) && !empty($advisor->discretionaryAUM))
                            ${{ number_format($advisor->discretionaryAUM, 0) }} 
                        @endif
                        <br />

                        @if (auth()->check() && auth()->user()->isAdmin())
                            {{ $advisor->lat }}   {{ $advisor->lng }} <br />
                        @endif

                        @if(isset($advisor->brochure) && !empty($advisor->brochure))
                            <a href="{{ $advisor->brochure }}" target="_blank">
                                Part 2 Brochure 
                            </a> 
                        @endif
                    </div>
                </div>

                <br clear="all" />
                <div class="row">
                    <div class="col-lg-1">
                        Bio:
                    </div>
                    <div class="col-lg-11">
                        {{ $advisor->bio }}
                    </div>
                    <br />
                </div>
                <hr clear="all" />

                @if (!auth()->check())
                <div class="row">
                    <div class="col-lg-12 alert alert-info">
                        <a href="/claim/{{ $advisor->id }}">Claim this account</a>
                    </div>
                </div>
                <br />
                @endif
