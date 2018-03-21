<?php $tab = "Contact"; ?>
@extends('layouts.master')

@section('box1')
<div class="paddingForHeader">
</div>
@endsection

@section('box2')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <hr class="divider">
    		<h2 class="text-center text-lg text-uppercase my-0">
    	    	<strong>Feeduciary Contact Form</strong>
    		</h2>
		    <hr class="divider" />
		</div>
	</div>
    <div class="row">

<?php   $key = "AIzaSyALzhEzkuqN7XpucdVcJUxR12p2X0W5LnE"; 
        $q="2719+Hollywood+Blvd,+Hollywood,+FL+33020+United+States";
?>

<!--
t=m type is map, hybrid, satellite
z=6 is zoom, higher the number closer to ground
iwloc=A for the box that asks if you want directions
sll Latitude and logitude of pin
ll latitude and longitude of map center
-->
        <div class="col-sm-8">
            <div class="embed-responsive embed-responsive-16by9 map-container mb-4 mb-lg-0">
                <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
                        src="http://maps.google.com/maps?center=-33.8569,151.2152&amp;zoom=10&amp;hl=en&amp;ie=UTF8
                        &amp;q=<?= $q; ?>&amp;ll=26.0107972,-80.1629978&amp;spn=56.506174,79.013672&amp;t=m&amp;z=14&amp;output=embed"></iframe>
            </div>
        </div>


        <div class="col-sm-4">
            <h5 class="mb-0">Phone:</h5>
            <div class="mb-4">973-932-0683</div>
            <h5 class="mb-0">Email:</h5>
            <div class="mb-4">
                <a href="mailto:info@feeduciary.com">info@feeduciary.com</a>
            </div>
            <h5 class="mb-0">Address:</h5>
            <div class="mb-4">
                2719 Hollywood Blvd.<br />
                Hollywood, FL 33020<br />
            </div>
        </div>
    </div>
</div>
@endsection

@section('box3')
<div class="container">


    <hr class="divider">
    <h2 class="text-center text-lg text-uppercase my-0">Contact
        <strong>Form</strong>
    </h2>
    <hr class="divider" />
    <form>
        <div class="row">
            <div class="form-group col-lg-4">
                <label class="text-heading">Name</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group col-lg-4">
                <label class="text-heading">Email Address</label>
                <input type="email" class="form-control">
            </div>
            <div class="form-group col-lg-4">
                <label class="text-heading">Phone Number</label>
                <input type="tel" class="form-control">
            </div>
            <div class="clearfix"></div>
            <div class="form-group col-lg-12">
                <label class="text-heading">Message</label>
                <textarea class="form-control" rows="6"></textarea>
            </div>
            <div class="form-group col-lg-12">
                <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection