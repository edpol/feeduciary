
    <div class="row">
        <div style="float:left; padding-left:12px;">
            <div style="text-align:center;">Roof</div>
            <hr style="padding:0; margin:0; border-top-color: blue;" />
            @foreach ($rates as $rate)
                <div style="text-align:right;">${{ number_format($rate->roof, 0) }}</div>
            @endforeach
        </div>
        <div style="float:left; padding-left:12px;">
            <div style="text-align:center;">Rate</div>
            <hr style="padding:0; margin:0; border-top-color: blue;" />
            @foreach ($rates as $rate)
                <div style="text-align:right;">{{ number_format($rate->rate*100, 3) }}%</div>
            @endforeach
        </div>
        <br clear="all" />
    </div>
    <br />