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
                    A website <b>worth visitng</b>
                </h2>
                <p class="lead">
                    Here at feeduciary.com we know advisors fee's can be confusing, our goal is to help you compare  apples to apples, oranges to oranges.  
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
