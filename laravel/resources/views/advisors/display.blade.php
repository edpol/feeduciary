
                    <div style="float:left; padding-right:6px;">
                        name: <br />
                        phone: <br />
                        email: <br />
                        company: <br />
                        address: <br />
                        <br />
                        minimum amount: <br />
                        maximum amount: <br />
                        minimum fee: <br />
                        fee calculation: <br />
                        Facebook: <br />
                        Finra Brokercheck: <br />
                        Linkedin: <br />
                        Twitter: <br />
                        Discretionary AUM <br />
                        lat/lng: <br />
                        <br />
                    </div>

                    <div style="float:left;">
                        {{ $advisor->name  }} <br />
                        {{ $advisor->phone }} <br />
                        {{ $advisor->email }} <br />

                        @if(isset($advisor->url) && !empty($advisor->url))
                            <a href="{{ App\Advisor::addScheme($advisor->url) }}" target="_blank">
                        @endif
                        {{ $advisor->company }} 
                        @if(isset($advisor->url) && !empty($advisor->url))
                            </a> 
                        @endif
                        <br />
                        {{ $advisor->address1 }} 
                        {{ $advisor->address2 }} <br />
                        {{ $advisor->city }}, {{ $advisor->st }} {{ $advisor->zip }} <br />

                        {{ number_format($advisor->minimum_amt, 0) }} <br />
                        {{ number_format($advisor->maximum_amt, 0) }} <br />
                        {{ number_format($advisor->minimum_fee, 0) }} <br />
                        @if ($advisor->feeCalculation==0) 
                            Cumulative rates per tier
                        @else
                            Rate changes with investment amount
                        @endif
                        <br />
                        {{ $advisor->facebook         }} <br />
                        {{ $advisor->finraBrokercheck }} <br />
                        {{ $advisor->linkedin         }} <br />
                        {{ $advisor->twitter          }} <br />
                        {{ $advisor->discretionaryAUM }} <br />
                        {{ $advisor->lat }}   {{ $advisor->lng }} <br />
                        <a href="{{ $advisor->brochure }}" target="_blank">Part 2 Brochure</a> <br />
                    </div>
                    <br clear="all" />
                    <p>
                        Bio: &nbsp; {{ $advisor->bio }} 
                    </p>
