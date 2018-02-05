<?php $tab="Show Advisor"; ?>
@extends('layouts.master')

@section('box1')
<div class="paddingForHeader">
</div>
@endsection

@section('box2')
<section class="content-section-b">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
<?php           $hideEmail = true;   ?>
                @include('advisors.display')
            </div>
<?php
            $key = "AIzaSyAWOL3Onr0xG3zs0U_vNDk15XOm82qb5wE";
            $q = $advisor->address1 . " " . $advisor->address2 . $advisor->city . " " . $advisor->st . " " . $advisor->zip;
            $q = htmlentities($q);
?>
            <div id="map" class="col-lg-4">

        </div>
    </div>
</section>


<script>
    function initMap() {
        var myLatLng = {lat: <?=$advisor->lat; ?>, lng: <?=$advisor->lng; ?>};

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
@endsection