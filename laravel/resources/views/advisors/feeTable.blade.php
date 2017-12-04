<?php
use App\Pages;

	$per_page = 10;

	$amount = session('amount');
	$zipcode = session('zipcode');
	$advisors = session('advisors');

	$page = (!isset($page)) ? 1 : (int)$page;

	$start_slice = ($page-1) * $per_page + 1;

	$output = $advisors->slice($start_slice, $per_page);

	$tab = "Fees";
?>
@extends('layouts.master')

@section('box1')
    <header class="intro-header">
    </header>
@endsection

@section('box2')
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
						@foreach ( $output as $advisor ) 
<?php						$class = (!isset($class) || $class=="white" ) ? "grey" : "white"; ?>
							<tr class=<?= $class ?>>
								<td class='right'>{{ $advisor->id }}</td>
								<td><a href="/advisors/{{ $advisor->id }}">{{ $advisor->name }}</a></td>
								<td class='center'>{{ $advisor->feeCalculation }}</td>
								<td class='right'><?= "$".number_format($advisor->totalFee,0); ?></td>
							</tr>
						@endforeach
				</table>

<?php			$pagination = new pages($page, $per_page, count($advisors));

				if($pagination->total_pages() > 1) {

					if($pagination->has_previous_page()) { 
						echo '<a href="/advisors/page/' . $pagination->previous_page() . '">&laquo; Previous</a> '; 
					}

					for($i=1; $i <= $pagination->total_pages(); $i++) {
						if($i == $page) {
							echo " <span class=\"selected\">{$i}</span> ";
						} else {
							echo " <a href=\"/advisors/page/{$i}\">{$i}</a> "; 
						}
					}

					if($pagination->has_next_page()) { 
						echo ' <a href="/advisors/page/' . $pagination->next_page() . '">Next &raquo;</a> '; 
					}

				}
?>    		</div>
    	</div>
    </div>
</section>
@endsection
