<?php $tab = "Show Advisor"; 
    $key = "AIzaSyAWOL3Onr0xG3zs0U_vNDk15XOm82qb5wE";
    $q = $advisor->address1 . " " . $advisor->address2 . $advisor->city . " " . $advisor->st . " " . $advisor->zip;
    $q = htmlentities($q);
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
            <div class="col-12 col-sm-6">
                <?php $hideEmail = true; ?>
                @include('advisors.display')
            </div>

            <div class="col-12 col-sm-3">
                @include('import.display')
            </div>

            <div class="col-12 col-sm-3" id="map">
            </div>
        </div>
<br />
        <!-- Bio Bottom Row -->
        <div class="row-fluid">
            <span class='alert alert-success' style="padding: 4px;">Bio:</span> &nbsp; {{ $advisor->bio }}
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