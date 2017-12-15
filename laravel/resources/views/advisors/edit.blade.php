<?php $tab="Edit"; ?>
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
                <h3>Advisor Information</h3>
                @include('advisors.display')
                <form class="form-horimaximum_amtontal " method="POST" action="/edit/{{ $advisor->id }}">
                    {{ csrf_field() }}
                    <input id="advisor_id" type="hidden" class="form-control" name="advisor_id" value="{{ $advisor->id }}" />
                    <input id="advisor"    type="hidden" class="form-control" name="advisor"    value="{{ $advisor }}" />

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Edit Advisor
                            </button>
                        </div>
                    </div>

                    @include('layouts.errors')
                </form>
            </div>

            <div class="col-lg-3">
                <h3>Rates Information</h3>
                @include('rates.display')
                <form class="form-horimaximum_amtontal " method="POST" action="/rates/{{ $advisor->id }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Edit Rates
                            </button>
                        </div>
                    </div>

                    @include('layouts.errors')
                </form>
            </div>

            <br clear="all" />
        </div>
    </div>
</section>
@endsection
