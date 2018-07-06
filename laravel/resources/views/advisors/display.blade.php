                <div class="row">

                    <div class="col-12"><h3>Advisor Information</h3></div>

                    <div class="col-4">name*:  </div> 
                    <div class="col-8">{{ $advisor->name     }} </div>

                    <div class="col-4">phone:  </div> 
                    <div class="col-8">{{ $advisor->phone()  }} </div>

                    @if(isset($hideEmail) && $hideEmail==false)
                    <div class="col-4">email*: </div> 
                    <div class="col-8">{{ $advisor->email    }} </div>
                    @endif

                    <div class="col-4">company: </div> 
                    <div class="col-8">
                        @if(isset($advisor->url) && !empty($advisor->url))
                            <a href="{{ $advisor->url }}" target="_blank">
                        @endif
                        {{ $advisor->company }} 
                        @if(isset($advisor->url) && !empty($advisor->url))
                            </a> 
                        @endif
                    </div>

                    <div class="col-4">address: </div> 
                    <div class="col-8">{{ $advisor->address1 }} </div>
                    
                    @if(isset($advisor->address2) && !empty($advisor->address2))
                    <div class="col-4">        </div> 
                    <div class="col-8">{{ $advisor->address2 }} </div>
                    @endif
                    
                    <div class="col-4">        </div> 
                    <div class="col-8"> 
                        {{ $advisor->city }},
                        @if(isset($advisor->st) && !empty($advisor->st))
                            {{ $advisor->st }}
                        @endif
                        {{ $advisor->zip }} 
                    </div>
                    
                    <div class="col-4">minimum amount: </div>
                    <div class="col-8">
                        @if(isset($advisor->minimum_amt) && !empty($advisor->minimum_amt))
                            ${{ number_format($advisor->minimum_amt, 0) }} 
                        @endif
                    </div>

<!--                <div class="col-4">maximum amount: </div> 
                    <div class="col-8">
                        @if(isset($advisor->maximum_amt) && !empty($advisor->maximum_amt))
                            ${{ number_format($advisor->maximum_amt, 0) }} 
                        @endif
                    </div>
-->
                    <div class="col-4">minimum fee: </div> 
                    <div class="col-8">
                        @if(isset($advisor->minimum_fee) && !empty($advisor->minimum_fee))
                            ${{ number_format($advisor->minimum_fee, 0) }} 
                        @endif
                    </div>

                    <div class="col-4">fee calculation*: </div> 
                    <div class="col-8">
                        @if ($advisor->feeCalculation==0) Cumulative rates per tier @endif
                        @if ($advisor->feeCalculation==1) Rate changes with investment amount @endif
                        @if ($advisor->feeCalculation==2) Rate is fixed amount @endif
                    </div>

                    <div class="col-4">Facebook: </div> 
                    <div class="col-8">
                        @if(isset($advisor->facebook) && !empty($advisor->facebook))
                            <a href="{{ $advisor->facebook }}" target="_blank">
                                {{ $advisor->facebook }} 
                            </a> 
                        @endif
                    </div>

                    <div class="col-4">Linkedin: </div>
                    <div class="col-8">
                        @if(isset($advisor->linkedin) && !empty($advisor->linkedin))
                            <a href="{{ $advisor->linkedin }}" target="_blank">
                                {{ $advisor->linkedin }} 
                            </a> 
                        @endif
                    </div>

                    <div class="col-4">Twitter: </div>
                    <div class="col-8">
                        @if(isset($advisor->twitter) && !empty($advisor->twitter))
                            <a href="{{ $advisor->twitter }}" target="_blank">
                                {{ $advisor->twitter }} 
                            </a> 
                        @endif
                    </div>

                    <div class="col-4">Finra Brokercheck: </div>
                    <div class="col-8">
                        @if(isset($advisor->finraBrokercheck) && !empty($advisor->finraBrokercheck))
                            <a href="{{ $advisor->finraBrokercheck }}" target="_blank">
                                {{ $advisor->finraBrokercheck }} 
                            </a> 
                        @endif
                    </div>

                    <div class="col-4">Discretionary AUM: </div>
                    <div class="col-8">
                        @if(isset($advisor->discretionaryAUM) && !empty($advisor->discretionaryAUM))
                            ${{ number_format($advisor->discretionaryAUM, 0) }} 
                        @endif
                    </div>

                    @if (auth()->check() && auth()->user()->isAdmin())
                    <div class="col-4">lat/lng: </div>
                    <div class="col-8"> {{ $advisor->lat }}   {{ $advisor->lng }} </div>
                    @endif

                    @if(isset($advisor->brochure) && !empty($advisor->brochure))
                        <div class="col-4"> </div>
                        <div class="col-8">
                            <a href="{{ $advisor->brochure }}" target="_blank">
                                Part 2 Brochure 
                            </a> 
                        </div>
                    @endif
                </div>

                <hr />

                @if (auth()->check())
                    <?php  
                            $user = Auth::user();
                    ?>
                    @if ($advisor->owner() || $user->isAdmin() )
                        <form class="form-group" method="GET" action="{{ url('/edit') }}/{{ $advisor->id }}">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Edit Advisor</button>
                            &nbsp;
                            <a href="/" class="btn btn-primary">Finished</a>
    <!-- this is just a display page, why are we including errors? -->
                        </form>
                    @endif
                @else
                    @if ($advisor->user_id==0)
                        <form id="claim" action="{{ url('claim') }}/{{ $advisor->id}}" method="get"> 
                            {{ csrf_field() }}
                            <button class="btn btn-info" type="submit">Claim this account</button>
                        </form>
                    @endif
                @endif
                @include('layouts.errors')
