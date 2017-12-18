
                    <div style="float:left; padding-right:6px;">
                        name*: <br />
                        phone: <br />
                        email*: <br />
                        company: <br />
                        address: <br />
                        @if(isset($advisor->address2) && !empty($advisor->address2))
                            <br />
                        @endif
                        <br />
                        minimum amount: <br />
                        maximum amount: <br />
                        minimum fee: <br />
                        fee calculation*: <br />
                        Facebook: <br />
                        Finra Brokercheck: <br />
                        Linkedin: <br />
                        Twitter: <br />
                        Discretionary AUM: <br />
                        lat/lng: <br />
                        <br />
                    </div>

                    <div style="float:left;">
                        {{ $advisor->name  }} <br />
                        {{ $advisor->phone }} <br />
                        {{ $advisor->email }} <br />

                        @if(isset($advisor->url) && !empty($advisor->url))
                            <a href="{{ App\Http\Controllers\controller::addScheme($advisor->url) }}" target="_blank">
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

                        {{ $advisor->city }}
                        @if(isset($advisor->st) && !empty($advisor->st))
                            ,{{ $advisor->st }}
                        @endif
                        {{ $advisor->zip }} <br />

                        @if(isset($advisor->minimum_amt) && !empty($advisor->minimum_amt))
                            ${{ number_format($advisor->minimum_amt, 0) }} 
                        @endif
                        <br />

                        @if(isset($advisor->maximum_amt) && !empty($advisor->maximum_amt))
                            ${{ number_format($advisor->maximum_amt, 0) }} 
                        @endif
                        <br />

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
                            <a href="{{ App\Http\Controllers\controller::addScheme($advisor->facebook) }}" target="_blank">
                                {{ $advisor->facebook }} 
                            </a> 
                        @endif
                        <br />

                        @if(isset($advisor->finraBrokercheck) && !empty($advisor->finraBrokercheck))
                            <a href="{{ App\Http\Controllers\controller::addScheme($advisor->finraBrokercheck) }}" target="_blank">
                                {{ $advisor->finraBrokercheck }} 
                            </a> 
                        @endif
                        <br />

                        @if(isset($advisor->linkedin) && !empty($advisor->linkedin))
                            <a href="{{ App\Http\Controllers\controller::addScheme($advisor->linkedin) }}" target="_blank">
                                {{ $advisor->linkedin }} 
                            </a> 
                        @endif
                        <br />

                        @if(isset($advisor->twitter) && !empty($advisor->twitter))
                            <a href="{{ App\Http\Controllers\controller::addScheme($advisor->twitter) }}" target="_blank">
                                {{ $advisor->twitter }} 
                            </a> 
                        @endif
                        <br />

                        @if(isset($advisor->discretionaryAUM) && !empty($advisor->mindiscretionaryAUMimum_fee))
                            ${{ number_format($advisor->discretionaryAUM, 0) }} 
                        @endif
                        <br />

                        {{ $advisor->lat }}   {{ $advisor->lng }} <br />
                        @if(isset($advisor->brochure) && !empty($advisor->brochure))
                            <a href="{{ App\Http\Controllers\controller::addScheme($advisor->brochure) }}" target="_blank">
                                Part 2 Brochure 
                            </a> 
                        @endif
                    </div>
                    <br clear="all" />
                    <hr />
                    <div class="row">
                        <div class="col-lg-1">
                            Bio:
                        </div>
                        <div class="col-lg-11">
                            {{ $advisor->bio }}
                        </div>
                    </div>
                    <br />
