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

		        <div class="col-sm-4 mb-2">
					<span style="font-weight:bold;">Investment Amount:</span> ${{ number_format($amount,0) }}<br />
					@if(isset($zip) && $zip!="")
						<span style="font-weight:bold;">Zip Code:</span> {{ $zip }}<br />
					@endif	
				</div>

				<!-- Button to sort by Fee or distance. If no zip code can only show/sort fee -->
		        <div class="col-sm-2 mb-4">
					@if(isset($zip) && $zip!="")
						<a class="btn btn-primary" href="{{ url('/advisors/resort/'.$newOrder['val']) }}">{{ $newOrder['text'] }}</a>
					@endif
				</div>
				<div class="col-sm-1"> </div>
				<div class="col-sm-5">
					@if(isset($zip) && $zip!="")
						<div class="row">
							<div class="col-sm-6">
								<input id="myRange" name="slider" class="slider" type="range" step="<?= $step; ?>" min="<?= $min; ?>"    max="<?= $max; ?>"    value="<?= $miles; ?>" />
							</div>
							<div class="col-sm-6 mb-2 ml-0">
								&nbsp; Distance: <span id="displayDistance"></span><br />
							</div>
						</div>
					@endif
					<div class="row">
						<div class="col-sm-6">
							<input id="myFee"   name="feeSlider" class="slider" type="range" step="<?= $feeStep; ?>" min="<?= $feeMin; ?>" max="<?= $feeMax; ?>" value="<?= $fee;   ?>" />
						</div>
						<div class="col-sm-6 mb-2">
							&nbsp; Fee: $<span id="displayFee"></span><br />
						</div>
					</div>
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
						<div style="width:400px; height:240px; padding:20px 20px 40px 20px; <?= $align; ?>  box-shadow: 10px 10px 5px #888888;  background: url({{ asset('images/paper.gif') }});">

							<p style="margin:0 auto; text-align:center; border-top:solid black 1px; border-bottom:solid black 1px; width:80%; ">
								<a href="{{ url('/advisors') }}/{{ $advisor->id }}">{{ $advisor->name }}</a><br />
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
								@if (empty($advisor->address2)) 
									<br />
								@endif
							</div>
							<br clear="all" />
							<div style="padding-top:12px;">
								Approx Annual Fee: <?= "$".number_format($advisor->totalFee,0); ?> <br />
<?php							if ($advisor->distance>0) {
									echo "Approx Distance: " . number_format($advisor->distance,0) . " miles"; 
								} ?>
							</div>		
						</div>
						<br />
					</div>
				</div>
			</section>
		@endif
	@endforeach

		<section class="<?= $class; ?>" style="padding-top:4px;">
	        <div class="row">
				<div class="col-sm-12 center" style="color:grey;">
					Annual fees do not include internal costs and expenses associated with investments inside of a fee based portfolio.
				</div>
			</div>
			<br />
	        <div class="row">
				<div class="col-sm-12">
					<div class="pagination center pagination-sm">
<?php					$pages = new Pages($displayCount, $page);
						echo $pages->pageLinks();
?>					</div>
		    	</div>
			</div>
		</section>
@endsection
