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
                <img class="img-fluid" src="images/ipad.png" alt="">
            </div>
        </div>
    </div>
<!-- /.container -->
</section>
@endsection

@section('box3')
<section class="content-section-b">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mr-auto order-lg-2">
                <hr class="section-heading-spacer" />
                <div class="clearfix"></div>
                <h2 class="section-heading">
                    <strong>Please enter investment amount</strong>
                </h2>
                <p class="lead">
                    <div style="width:70%; min-width:100px;">
                        <form method="GET" action="/calculateFee">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="amount">Amount:</label>
                                <input type="text" class="form-control" id="amount" name="amount" />
                            </div>
                            <div class="form-group">
                                <label for="zipcode">Zipcode:</label>
                                <input type="text" class="form-control" id="zipcode" name="zipcode" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            @include ('layouts.errors') 
                        </form>
                    </div>
                </p>
                </div>
                <div class="col-lg-5 ml-auto order-lg-1">
                <img class="img-fluid" src="images/graph.jpg" alt="">
            </div>
        </div>
    </div>
    <!-- /.container -->
</section>
<!-- /.content-section-b -->

@endsection

@section('box4')
    @include('layouts.banner')
@endsection

