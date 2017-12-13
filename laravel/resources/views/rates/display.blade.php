    <table border=0>
        <tr><th>Roof</th><th>Rate</th></tr>
        @foreach ($rates as $rate)
        <tr>
            <td>${{ number_format($rate->roof, 0) }}</td>
            <td>{{ number_format($rate->rate*100, 3) }}%</td>
        </tr>
        @endforeach
    </table>
    <br />