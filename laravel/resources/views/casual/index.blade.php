<?php $tab = "Home"; ?>
@extends('layouts.master')

@section('box1')
    @include('layouts.header')
@endsection

@section('box2')
<!-- Page Content -->
<section class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/uTYa43dExCU?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>

            <div class="col-12 col-md-5">
                <hr class="section-heading-spacer">
                <div class="clearfix"></div>
                <h2 class="section-heading">
                    OUR MISSION
                </h2>
                <p class="lead">
                    The singular focus of Feeduciary.com is to connect fee conscious investors seeking investment advice with fee-based financial advisors.
                    <br /><br />
                    Please enter the approximate amount you wish to invest and we can supply you with a list of advisors and their fees.
                </p>
            </div>
        </div>

        <div class="row" style="padding-top:24px;">
            <div class="col-sm-1"> </div>
            <div class="col-sm-10 text-center small"> 
<!--
                Information is provided 'as is' and solely for informational purposes, not for investment purposes or advice.<br />
                Feeduciary is not a fiduciary under ERISA. Feeduciary is not endorsed by or affiliated with FINRA.
                <br/> <br/>
-->
                Your use of this service is subject to our 
                <a href="{{ url('terms') }}">Terms of Use</a>
                and 
                <a href="{{ url('privacy') }}">Privacy Policy</a>.
            </div>
        </div>
     </div>
<!-- /.container -->
</section>
@endsection
