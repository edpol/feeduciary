<?php 
    $tab = "Contact Us"; 
    $key = "AIzaSyAWOL3Onr0xG3zs0U_vNDk15XOm82qb5wE";
    $q = "2719+Hollywood+Blvd+Hollywood,+FL+33020+United+States";
    $lat =  26.0113118;
    $lng = -80.1618834;
?>
@extends('layouts.captcha')

@section('box1')
<div class="paddingForHeader">
</div>
@endsection

@section('box2')
<section class="content-section-b">
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

        <div class="row">
            <div class="col-md-2"> </div>
            <div class="col-md-6 col-sm-3" id="map" style="min-height:100px">
            </div>
            <div class="col-md-4">
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
</section>
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

<script>
    function initMap() {
        var myLatLng = {lat: <?=$lat; ?>, lng: <?=$lng; ?>};

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            center: myLatLng
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: '<?= $q; ?>'
        });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=$key;?>&callback=initMap">
</script>
