
    <div class="row">
        <div class="col-lg-8">
            Roof<hr style="padding:0; margin:0; border-top-color: blue;" />
            @foreach ($rates as $rate)
                {{ number_format($rate->roof, 0) }}<br />
            @endforeach
        </div>
        <div class="col-lg-4">
            Rate<hr style="padding:0; margin:0; border-top-color: blue;" />
            @foreach ($rates as $rate)
                {{ number_format($rate->rate*100, 3) }}%<br />
            @endforeach
        </div>
    </div>
    <br />