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
            <!-- Column 1 -->
            <div class="col-12 col-sm-6">
                <?php $hideEmail = false; ?>
                @include('advisors.display')
            </div>

            <!-- Column 2 -->
            <div class="col-12 col-sm-3">
                @include('import.display')
            </div>

            <!-- Column 3 -->
            <div class="col-12 col-sm-3">
                @include('rates.display')
            </div>
        </div>

        <!-- Bio Bottom Row -->
        <div class="row-fluid">
            <span class='alert alert-success' style="padding: 4px;">Bio:</span> &nbsp; {{ $advisor->bio }}
        </div>

        <div class="row" style="padding-top:12px;">
            @if (auth()->check() && auth()->user()->isAdmin())
                <div class="col-sm-12"> 
                    <form id="form1" class="form-horimaximum_amtontal " method="POST" action="{{ url('/admin/advisor') }}/{{ $advisor->id }}/delete">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger mt-1" id="inactive" name="inactive">
                            Delete Advisor
                        </button>
                        &nbsp;
                        <button type="submit" class="btn btn-primary mt-1" id="inactive" name="inactive" formaction="{{ url('/admin/advisor') }}/{{ $advisor->id }}/inactive">
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

    </div>
</section>
@endsection
