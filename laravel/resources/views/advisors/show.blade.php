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
            $key = "AIzaSyALzhEzkuqN7XpucdVcJUxR12p2X0W5LnE";
            $key = "AIzaSyAdmDDq3txX-zNf4BNXh8e3baSfkgyl1HA";

            $q = $advisor->address1 . " " . $advisor->address2 . " " . $advisor->city . " " . $advisor->st . " " . $advisor->zip . " Unites States";
            $q = preg_replace('/\s+/', ' ',$q);
            $q = str_replace(" ","+",$q);
?>

            <div class="col-lg-4">
                <div id="mymap-display" style="height:100%;width:100%;max-width:100%;">
                    <iframe style="height:100%;width:100%;border:0;" frameborder="0" 
                        src="https://www.google.com/maps/embed/v1/place?q=<?= $q ?>&key=<?=$key;?>">
                    </iframe>
                </div>
                <style>#mymap-display .text-marker{}.map-generator{max-width: 100%; max-height: 100%; background: none;</style>
            </div>

            <div class="clearfix"></div>

        </div>
    </div>
</section>
@endsection