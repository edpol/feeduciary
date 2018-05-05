
    <div class="row">
@if ($advisor->feeCalculation==2) 
        <div style="float:left; padding-left:12px;">
            <div style="text-align:center;">Annual Fee </div>
            <hr style="padding:0; margin:0; border-top-color: blue;" />
            @foreach ($rates as $rate)
                <div style="text-align:right;">${{ number_format($rate->roof, 0) }}</div>
            @endforeach
@else
        <div style="float:left; padding-left:12px;">
            <div style="text-align:center;">Tiers</div>
            <hr style="padding:0; margin:0; border-top-color: blue;" />
            @foreach ($rates as $rate)
                <div style="text-align:right;">${{ number_format($rate->roof, 0) }}</div>
            @endforeach
        </div>
        <div style="float:left; padding-left:12px;">
            <div style="text-align:center;">Annual Rate</div>
            <hr style="padding:0; margin:0; border-top-color: blue;" />
            @foreach ($rates as $rate)
                <div style="text-align:right;">{{ number_format($rate->rate*100, 3) }}%</div>
            @endforeach
@endif
        </div>
        <br clear="all" />
    </div>
    <br />