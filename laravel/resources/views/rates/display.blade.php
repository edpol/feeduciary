
                <h3>Rates Information</h3>
                <div class="row">
                    <div class="col-5 pr-1">
                        <div class="text-center">
                        @if ($advisor->feeCalculation!=2) 
                            Tiers
                        @else
                            Annual Fee 
                        @endif
                        </div>
                        <hr style="padding:0; margin:0; border-top-color: blue;" />
                        @foreach ($rates as $rate)
                            <div style="text-align:right;">${{ number_format($rate->roof, 0) }}</div>
                        @endforeach
                    </div>

                    @if ($advisor->feeCalculation!=2) 
                        <div class="col-5">
                            <div class="text-center">Annual Rate</div>
                            <hr style="padding:0; margin:0; border-top-color: blue;" />
                            @foreach ($rates as $rate)
                                <div class="text-right">{{ number_format($rate->rate*100, 3) }}%</div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <hr />

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <a href="{{ url('/rates') }}/{{ $advisor->id }}" class="btn btn-primary">Edit Rates</a>
                    </div>
                </div>