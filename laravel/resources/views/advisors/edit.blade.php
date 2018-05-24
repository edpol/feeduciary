<?php $tab = "Edit Info"; ?>
@extends('layouts.master')

@section('box1')
<div class="paddingForHeader">
</div>
@endsection

@section('box2')
<section class="content-section-b" id="section">
    <div class="container" id="container" style="border-radius: 10px; @if(!$advisor->is_active) background-color:#fee; @endif" >
        <div class="row">
            <div class="col-lg-7">
                <h3>Advisor Information</h3>
<?php           $hideEmail = false;   ?>
                @include('advisors.display')
                <form class="form-group" method="POST" action="{{ url('/edit') }}/{{ $advisor->id }}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary">
                        Edit Advisor
                    </button>
                    &nbsp;
                    <a href="/" class="btn btn-primary">Finished</a>
<!-- this is just a display page, why are we including errors? -->
                    @include('layouts.errors')
                </form>
            </div>

            <div class="col-lg-5">
                <h3>Rates Information</h3>
                @include('rates.display')
                <form class="form-horimaximum_amtontal " method="POST" action="{{ url('/rates') }}/{{ $advisor->id }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">Edit Rates</button>
                        </div>
                    </div>
                </form>
                @if (auth()->check() && auth()->user()->isAdmin())
                    <div style="position: absolute; bottom: 0; padding-bottom:16px;">
                        <form id="form1" class="form-horimaximum_amtontal " method="POST" action="{{ url('/admin/advisor') }}/{{ $advisor->id }}/delete">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger" id="inactive" name="inactive">
                                Delete Advisor
                            </button>
                            &nbsp;
                            <button type="submit" class="btn btn-primary" id="inactive" name="inactive" formaction="{{ url('/admin/advisor') }}/{{ $advisor->id }}/inactive">
                            @if ($advisor->is_active)
                                Deactivate Advisor
                            @else
                                Activate Advisor
                            @endif
                            </button>
                        </form>
                    </div>
                @endif
            </div>

            <br clear="all" />
        </div>
    </div>
</section>
@endsection
