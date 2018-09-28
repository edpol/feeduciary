<?php $tab = "Contact Us"; 
    $key = "AIzaSyALzhEzkuqN7XpucdVcJUxR12p2X0W5LnE"; 
    $key = "AIzaSyAWOL3Onr0xG3zs0U_vNDk15XOm82qb5wE";
    $q = "2719+Hollywood+Blvd,+Hollywood,+FL+33020+United+States";

    if (App::environment('local')) {
        // local captcha
        $siteKey = "6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI";
        $secret  = "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe";
    } else {
        // feeduciary.com captcha keys
        $siteKey = "6LdSt04UAAAAACh-RI4c9lpMTjxKIPvAt1jl4y9Z";
        $secret  = "6LdSt04UAAAAACJAQXJcKM-pGzjFZbaoGnQEhoUu";
    }
?>
@extends('layouts.captcha')

@section('box1')
<div class="paddingForHeader">
</div>
@endsection

@section('box2')
<div class="container">
    <div class="row">
        <div class="col-md-2"> </div>
        <div class="col-md-8 col-md-offset-2">

            <hr class="divider">
    		<h2 class="text-center text-lg text-uppercase my-0">
    	    	<strong>Feeduciary Contact Form</strong>
    		</h2>
		    <hr class="divider" />
		</div>
	</div>

<!--
    t=m type is map, hybrid, satellite
    z=6 is zoom, higher the number closer to ground
    iwloc=A for the box that asks if you want directions
    sll Latitude and logitude of pin
    ll latitude and longitude of map center
-->
    <div class="row">
        <div class="col-sm-2"> </div>
        <div class="col-sm-6">
            <div class="embed-responsive embed-responsive-16by9 map-container mb-4 mb-sm-0">
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
    <div class="row">
        <div class="col-sm-2"> </div>
        <div class="col-sm-8">
            <hr class="divider" />
            <h2 class="text-center text-lg text-uppercase my-0">Contact Form</h2>
            <hr class="divider" />
            <form id="contact" action="{{ url('contact') }}" method="post">
                {{ csrf_field() }}

                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="text-heading">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="text-heading">Email Address</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="text-heading">Phone Number</label>
                        <input type="tel" name="phone" class="form-control">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label class="text-heading">Message</label>
                        <textarea class="form-control" name="message" rows="6"></textarea>
                    </div>
                    <div class="form-group col-sm-12">

        <div id='recaptcha' class="g-recaptcha"
            data-sitekey="6LfWbVIUAAAAAJhi-Tz2TP1jmrR4vYKBIokA19CF"
            data-callback="onSubmit"
            data-size="invisible"></div>
        <button type="submit" id='submit' class="btn btn-primary">Submit</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection