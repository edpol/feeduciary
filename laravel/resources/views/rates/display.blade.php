
    <div class="row">
        <div class="col-lg-6">
            <div style="text-align:center;">Roof</div>
            <hr style="padding:0; margin:0; border-top-color: blue;" />
            @foreach ($rates as $rate)
                <div style="text-align:right;">${{ number_format($rate->roof, 0) }}</div>
            @endforeach
        </div>
        <div class="col-lg-4">
            <div style="text-align:center;">Rate</div>
            <hr style="padding:0; margin:0; border-top-color: blue;" />
            @foreach ($rates as $rate)
                <div style="text-align:right;">{{ number_format($rate->rate*100, 3) }}%</div>
            @endforeach
        </div>
    </div>
    <br />