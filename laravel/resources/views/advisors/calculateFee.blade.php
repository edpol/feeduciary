<?php $tab = "Fee Calculation";

	use feeduciary\Pages;

	$class    = "content-section-b";
	$amount   = session('amount');
	$zip      = session('zip');
	$advisors = session('advisors');
	$displayCount = session('displayCount',count($advisors));
	$newOrder = session('newOrder');
	$output   = session('output');
	$range    = session('range');
	$page     = session('page',1);

	// SOMETIMES, on page refresh, I seem to lose the contents of the array
	if (isset($range) && !empty($range)) {
		$step   = $range["step"];
		$min    = $range["min"];
		$max    = $range["max"];
		$feeStep= $range["feeStep"];
		$feeMin = $range["feeMin"];
		$feeMax = $range["feeMax"];
	} else {
		$zip = "";
	}
	$miles = session('miles',$max);  // default is max
	$fee   = session('fee',$feeMax);

?>
@extends('layouts.master')

@section('box1')
<div class="paddingForHeader">
</div>
@endsection

@section('box2')
	<section class="content-section-b">
	    <div class="container">
	    	<div class="row">

		        <div class="col-md-4">
					<span style="font-weight:bold;">Investment Amount:</span> ${{ number_format($amount,0) }}<br />
					@if(isset($zip) && $zip!="")
						<span style="font-weight:bold;">Zip-code:</span> {{ $zip }}<br />
					@endif	
				</div>

				<!-- Button to sort by Fee or distance. If no zip code can only show/sort fee -->
		        <div class="col-md-2" style="margin-top:8px;">
					@if(isset($zip) && $zip!="")
						<a class="btn btn-primary" href="/advisors/resort/<?= $newOrder['val'];?>"><?= $newOrder['text']; ?></a>
					@endif
				</div>

				<div class="col-md-6" style="margin-top:8px;">
				@if(isset($zip) && $zip!="")
					<input id="myRange" name="slider"    class="slider" type="range" step="<?= $step; ?>"    min="<?= $min; ?>"    max="<?= $max; ?>"    value="<?= $miles; ?>" />
					&nbsp; Distance: <span id="displayDistance"></span>
					<br /><br /> 
				@endif
					<input id="myFee"   name="feeSlider" class="slider" type="range" step="<?= $feeStep; ?>" min="<?= $feeMin; ?>" max="<?= $feeMax; ?>" value="<?= $fee;   ?>" />
					&nbsp; Fee: $<span id="displayFee"></span>
				</div>

			</div>
			<i>Fees listed are subject to change.  Please contact the advisor directly to verify fees.</i>
		</div>
	</section>

	@foreach($output as $advisor) 

		@if($advisor->distance<= $miles && $advisor->is_active) 

			<?php
// and check distance
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
						<div style="width:400px; height:240px; padding:20px 8px; <?= $align; ?>  box-shadow: 10px 10px 5px #888888;  background: url({{ asset('images/paper.gif') }});">

							<p style="margin:0 auto; text-align:center; border-top:solid black 1px; border-bottom:solid black 1px; width:80%; ">
								<a href="{{ url('/advisors') }}/{{ $advisor->id }}">{{ $advisor->name }}</a> ({{ $advisor->id }})<br />
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
							Approx Annual Fee: <?= "$".number_format($advisor->totalFee,0); ?> <br />
<?php						if ($advisor->distance>0) {
								echo "Approx Distance: " . number_format($advisor->distance,0) . " miles"; 
							} ?>
						</div>
						<br />
					</div>
				</div>
			</section>
		@endif
	@endforeach

	<section class="<?= $class; ?>">
	    <div class="container">
	        <div class="row">
	        	<div class="col-md-2"></div>
				<div class="col-md-6 pagination pagination-lg">
<?php				$pages = new Pages($displayCount, $page);
					echo $pages->pageLinks();
?>		    	</div>
			</div>
    	</div>
	</section>
@endsection
