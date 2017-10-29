<?php
session_start();
$limit = 10;
$fcount = (!isset($_SESSION["fcount"])) ? 0 : $_SESSION["fcount"];
?>
@extends('layouts.master')

@section('box1')
<section class="content-section-a">
    <div class="container">
        <div class="row">
            <div>
                <hr class="section-heading-spacer">
                <div class="clearfix"></div>
		    	<p>
					<span style="font-weight:bold;">Investment Amount:</span> {{ number_format($amount["amount"],0) }}<br />
					<span style="font-weight:bold;">zipcode</span> {{ $zipcode["zipcode"] }}<br />
				</p>

				<table>
					<tr><th>id&nbsp;</th><th>Advisor</th><th>fee<br />type</th><th>Fee<br />Amount</th></tr>
<?php 		 			$output = array_slice($final_list, $fcount, $limit); ?>
						@foreach ( $output as $row )
<?php					$class = (!isset($class) || $class=="white" ) ? "grey" : "white"; ?>
							<tr class=<?= $class ?>>
								<td class='right'>{{ $row["id"] }}</td>
								<td><a href="/advisors/{{ $row["advisor"]["id"] }}">{{ $row["advisor"]["name"] }}</a></td>
								<td class='center'>{{ $row["advisor"]["feeCalculation"] }}</td>
								<td class='right'>{{ number_format($row["totalFee"],0) }}</td>
							</tr>
						@endforeach
				</table>
<?php 			echo "<a href='?'>&laquo;back</a> &nbsp; <a href='?'>next&raquo;</a>";
				$_SESSION["fcount"] = $fcount + $limit; 
				$_SESSION["fcount"] = $fcount - $limit; 
?>
    		</div>
    	</div>
    </div>
</section>
@endsection
