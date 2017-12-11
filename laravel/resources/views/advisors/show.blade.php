<?php $tab="Show Advisor"; ?>
@extends('layouts.master')

@section('box1')
<div class="container">
    &nbsp;
</div>
@endsection

@section('box2')
<section class="content-section-b">
    <div class="container">
        <div class="row">
            <div class="col-lg-6" style="float:left;">
                <div class="clearfix"></div>
<?php // this one is only returning one record so ->body works ?>
                @include('advisors.display')
            </div>

<?php
        $key[0] = "AIzaSyALzhEzkuqN7XpucdVcJUxR12p2X0W5LnE"; 
        $key[1] = "AIzaSyCdltmUqKisvFuUxvU-Ljf7CmTAjV0GZqw";
        $key[2] = "AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8";

        $q = $advisor->address1 . " " . $advisor->address2 . " " . $advisor->city . " " . $advisor->st . " " . $advisor->zip . " Unites States";
        $q = preg_replace('/\s+/', ' ',$q);
        $q = str_replace(" ","+",$q);
?>

        <div class="col-lg-6">
            <div id="mymap-display" style="height:100%; width:100%;max-width:100%;">
                <iframe style="height:100%;width:100%;border:0;" frameborder="0" 
                    src="https://www.google.com/maps/embed/v1/place?q=<?= $q ?>&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8">
                </iframe>
            </div>
            <style>#mymap-display .text-marker{}.map-generator{max-width: 100%; max-height: 100%; background: none;</style>
        </div>

            <br clear="all" />
        </div>
    </div>
</section>
@endsection