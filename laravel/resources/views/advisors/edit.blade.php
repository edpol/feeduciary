<?php $tab="Edit"; ?>
@extends('layouts.master')

@section('box1')
<div class="paddingForHeader">
</div>
@endsection

@section('box2')
<section class="content-section-b" id="section">
    <div class="container" id="container" style="border-radius: 10px; @if(!$advisor->is_active) background-color:#fee; @endif" >
        <div class="row">
            <div class="col-lg-6">
                <h3>Advisor Information</h3>
<?php           $hideEmail = false;   ?>
                @include('advisors.display')
                <form class="form-horimaximum_amtontal " method="GET" action="/edit/{{ $advisor->id }}">
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
<!-- this is just a display page, why are we including errors? -->
                    @include('layouts.errors')
                </form>
            </div>

            <div class="col-lg-3">
                <h3>Rates Information</h3>
                @include('rates.display')
                <form class="form-horimaximum_amtontal " method="GET" action="/rates/{{ $advisor->id }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Edit Rates
                            </button>
                        </div>
                    </div>
                </form>
                @if (auth()->user()->isAdmin())
<!--
<h2>Button Colors</h2>
<p>
<button type="button" class="btn">Basic</button>
<button type="button" class="btn btn-default">Default</button>
<button type="button" class="btn btn-primary">Primary</button>
<button type="button" class="btn btn-success">Success</button>
<button type="button" class="btn btn-info">Info</button>
<button type="button" class="btn btn-warning">Warning</button>
<button type="button" class="btn btn-danger">Danger</button>
<button type="button" class="btn btn-link">Link</button> 
</p>
<hr>
-->
                    <div style="position: absolute; bottom: 0; padding-bottom:16px;">
                    <form id="form1" class="form-horimaximum_amtontal " method="POST" action="/admin/advisor/{{ $advisor->id }}">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger" id="inactive" name="inactive">
                            Delete Advisor
                        </button>
                    </form>
                    &nbsp;<br />
                    <form id="form1" class="form-horimaximum_amtontal " method="POST" action="/admin/inactive/{{ $advisor->id }}">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary" id="inactive" name="inactive">
                        @if ($advisor->is_active)
                            Deactivate Advisor
                        @else
                            Activate Advisor
                        @endif
                        </button>
                    </form>
                    </div>
                </form>
                @endif
            </div>

            <br clear="all" />
        </div>
    </div>
</section>
@endsection
