<?php $tab = "Contact"; ?>
@extends('layouts.master')

@section('box1')
<div class="paddingForHeader">
</div>
@endsection

@section('box2')
<div class="bg-faded p-4 my-4">
    <hr class="divider">
    <h2 class="text-center text-lg text-uppercase my-0">
        <strong>Feeduciary Contact Form</strong>
    </h2>
    <hr class="divider" />
    <div class="row">

<?php   $key = "AIzaSyALzhEzkuqN7XpucdVcJUxR12p2X0W5LnE"; ?>

<!--
t=m type is map, hybrid, satellite
z=6 is zoom, higher the number closer to ground
iwloc=A for the box that asks if you want directions
sll Latitude and logitude of pin
ll latitude and longitude of map center
-->
        <div class="col-lg-8">
            <div class="embed-responsive embed-responsive-16by9 map-container mb-4 mb-lg-0">
                <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
                        src="http://maps.google.com/maps?center=-33.8569,151.2152&amp;zoom=10&amp;hl=en&amp;ie=UTF8
                        &amp;ll=37.0625,-95.677068&amp;spn=56.506174,79.013672&amp;t=m&amp;z=6&amp;output=embed"></iframe>
            </div>
        </div>

<!--
        <div style="overflow:hidden;max-width:100%;width:500px;height:500px;">
            <div id="mymap-display" style="height:100%; width:100%;max-width:100%;">
                <iframe style="height:100%;width:100%;border:0;" frameborder="0" 
                    src="https://www.google.com/maps/embed/v1/place?q=2451+Brickell+Ave,+12D+Miami,+FL+33129+United+States&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8">
                </iframe>
            </div>
            <style>#mymap-display .text-marker{}.map-generator{max-width: 100%; max-height: 100%; background: none;</style>
        </div>

        <div style="overflow:hidden;max-width:100%;width:500px;height:500px;">
            <div id="mymap-display" style="height:100%; width:100%;max-width:100%;">
                <iframe style="height:100%;width:100%;border:0;" frameborder="0" 
                src="https://www.google.com/maps/embed/v1/view?zoom=17&center=26.0054,-80.1356&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8">
                </iframe>
            </div>
            <style>#mymap-display .text-marker{}.map-generator{max-width: 100%; max-height: 100%; background: none;</style>
        </div>

        <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyALzhEzkuqN7XpucdVcJUxR12p2X0W5LnE'></script>
        <div style='overflow:hidden;height:400px;width:520px;'>
            <div id='gmap_canvas' style='height:400px;width:520px;'></div>
            <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
        </div> 
        <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=0771ce9aced1b4dff2fdfd40fffc7b51d081e21f'></script><script type='text/javascript'>function init_map(){var myOptions = {zoom:14,center:new google.maps.LatLng(25.9866988,-80.12890500000003),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(25.9866988,-80.12890500000003)});infowindow = new google.maps.InfoWindow({content:'<strong></strong><br>1835 East Hallandale Bch Blvd, Suite 817<br>33009 Hallandale Beach<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
-->


        <div class="col-lg-4">
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
<div class="bg-faded p-4 my-4">
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