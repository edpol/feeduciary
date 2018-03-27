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
            <div class="col-lg-5 ml-auto">
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
            <div class="col-lg-5 mr-auto">
                <img class="img-fluid" src="images/graph.jpg" alt="">
            </div>
        </div>
    </div>
<!-- /.container -->
</section>
@endsection
