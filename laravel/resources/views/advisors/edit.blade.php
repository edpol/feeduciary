<?php $tab = "Edit Info"; ?>
@extends('layouts.master')

@section('box1')
<div class="paddingForHeader"></div>
@endsection

@section('box2')
<section class="content-section-b" id="section">
    <div class="container" id="container" style="border-radius: 10px; padding:12px; 
@if(!$advisor->is_active) background-color:#fee; 
@else 
    @if(isset($advisor->robo) && $advisor->robo->is_robo==1) background-color:#ddd; @endif 
@endif" >

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

                <div class="col-sm-12 mt-2"> 
                    <form id="form2" class="form-horimaximum_amtontal " method="POST" action="{{ url('/admin/advisor') }}/{{ $advisor->id }}/robo">
                        {{ csrf_field() }}
                        <input type="checkbox" name="robo" @if(isset($advisor->robo) && $advisor->robo->is_robo==1) checked @endif onChange="this.form.submit()" /> Robo Advisor<br />
                    </form>
                </div>
            @endif
        </div>

    </div>
</section>
@endsection
