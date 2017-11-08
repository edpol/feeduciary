<?php
use App\Pagination;

	$per_page = 10;

	$amount = session('amount');
	$zipcode = session('zipcode');
	$advisors = session('advisors');

	$page = (!isset($page)) ? 1 : (int)$page;

	$start_slice = ($page-1) * $per_page + 1;

	$output = $advisors->slice($start_slice, $per_page);
?>
@extends('layouts.master')

@section('box1')

	<p>
		<span style="font-weight:bold;">Investment Amount:</span> {{ number_format($amount["amount"],0) }}<br />
		<span style="font-weight:bold;">zipcode</span> {{ $zipcode["zipcode"] }}<br />
	</p>

	@foreach ( $output as $advisor ) 
		<?php
		if (!isset($class) || $class=="content-section-b" ) {
			$class = "content-section-a";
			$align = "margin-left:0; margin-right:auto;";
		} else {
			$class = "content-section-b";
			$align = "margin-left:auto; margin-right:0;";
		}
		?>

		<section class="<?= $class; ?>">
		    <div class="container">
		        <div class="row">
					<div style="width:400px; height:220px; padding:20px 8px; <?= $align; ?>  box-shadow: 10px 10px 5px #888888;  background: url({{ asset('images/paper.gif') }});">

						<p style="margin:0 auto; text-align:center; border-top:solid black 1px; border-bottom:solid black 1px; width:80%; ">
							<a href="/advisors/{{ $advisor->id }}">{{ $advisor->name }}</a> ({{ $advisor->id }})<br />
						</p>
						<p style="margin:0 auto; text-align:center;">
								{{ $advisor->company }}<br /><br />
						</p>
						<div style="float:right;">
							{{ $advisor->address1}}<br />
							@if (!empty($advisor->address2)) 
								{{ $advisor->address2 }}<br /> 
							@endif
							{{ $advisor->city }}, {{ $advisor->st }} {{ $advisor->zip }}<br />
							<br />
							@if (empty($advisor->address2)) 
								<br />
							@endif
						</div>
						<br clear="all" />
						Approx Fee: <?= "$".number_format($advisor->totalFee,0); ?>

					</div>
					<br />
				</div>
			</div>
		</section>
	@endforeach

	<section class="<?= $class; ?>">
	    <div class="container">
	        <div class="row">
				<div style="margin-left:auto; margin-right:auto;">
<?php
					$pagination = new pagination($page, $per_page, count($advisors));

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
		?>    	</div>
			</div>
    	</div>
	</section>
@endsection
