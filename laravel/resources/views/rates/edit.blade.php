<?php $tab = "Edit Rates"; ?>
@extends('layouts.master')

@section('box1')
<div class="paddingForHeader">
</div>
@endsection

@section('box2')
<!--
        // they just pushed the edit rates button
        /*
            x 2,000,000 2.000%
            x 1,000,000 0.500% 

            roof:
            rate:
            add rate button -> /addRate{Rate} which calls itself until you press done
            done button -> /edit{advisor}
         */
-->
<section class="content-section-b">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2>Edit Rates for {{ $advisor->name }}</h2>
                <form class="form-horimaximum_amtontal" method="POST" action="{{ url('/storeRate/'.$advisor->id) }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('roof') ? ' has-error' : '' }}">

                        <div class="row">
                            <label for="roof" class="col-md-12 control-label">
<?php $advisor->feeCalculation = (int)$advisor->feeCalculation; ?>
                                @if ($advisor->feeCalculation==2)
                                    What is your fee?
                                @else
                                    @if ($rates->count()==0)
                                        What is the maximum dollar amount on the FIRST tier of your fee schedule?<br />(For example: $0 to 250,000.  Enter $250,000.00
                                    @else
                                        What is the maximum dollar amount on the NEXT tier of your fee schedule?
                                    @endif
                                @endif
                            </label>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" class="form-control comma" name="roof" value="{{ old('roof') }}" autofocus />
                                @if ($errors->has('roof'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('roof') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if ($advisor->feeCalculation!='2' && $advisor->feeCalculation!=2)
                    <div class="row form-group{{ $errors->has('rate') ? ' has-error' : '' }}">
                        <label for="rate" class="col-md-8 control-label">What is the annual rate for this tier?</label>
                        <div class="col-md-8">
                            <input id="rate" type="number" class="form-control" name="rate" value="{{ old('rate') }}" />
                            @if ($errors->has('rate'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('rate') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    @else
                            <input id="rate" type="hidden" class="form-control" name="rate" value="{{-1*$advisor->feeCalculation}}" />
                    @endif
                    <input id="advisor_id" type="hidden" class="form-control" name="advisor_id" value="{{ $advisor->id }}" />
                    <input id="advisor"    type="hidden" class="form-control" name="advisor"    value="{{ $advisor }}" />

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
<?php
/* if the fee calculation method equals 2 and the rates count is greater than 0 disable the add rate button */
                            if ($advisor->feeCalculation==2 && $rates->count()!=0) {
                                $disabled="disabled"; 
                            }else{
                                $disabled=""; 
                            }
?>
                            <button type="submit" {{ $disabled }} class="btn btn-primary">
                                Add Rate ({{ $advisor->name }})
                            </button>

                            @if (auth()->user()->isAdmin())
                                <button style="float:right;" type="submit" class="btn btn-primary" formaction="{{ url('/admin/advisors/'.$advisor->id) }}">
                            @else
                                <button style="float:right;" type="submit" class="btn btn-primary" formaction="{{ url('/done/'.$advisor->id) }}">
                            @endif
                                Done
                            </button>
                        </div>
                    </div>
                    @include('layouts.errors')
                </form>
            </div>

            <!-- 2nd Column -->
            <div class="col-lg-6 bluebox">
                <form id="form1" action="{{ url('/destroy/'.$advisor->id) }}" autocomplete="off" method="post"> <!-- onKeyDown="pressed(event)"> -->
                    {{ csrf_field() }}
                    <input id="advisor_id" type="hidden" class="form-control" name="advisor_id" value="{{ $advisor->id }}" />
                    <input id="advisor"    type="hidden" class="form-control" name="advisor"    value="{{ $advisor }}" />

                   <table border=0>
                        @if ($advisor->feeCalculation==2) 
                            <tr><th>&nbsp;</th><th>Annual Fee&nbsp;</th><th></th></tr>
                        @else
                            <tr><th>&nbsp;</th><th>Tiers&nbsp;</th><th>Annual Rate</th></tr>
                        @endif
                        @foreach ($rates as $rate)
                        <tr>
<?php                       $class = (!isset($class)||$class=="white") ? "grey" : "white"; ?>
                            <td class="<?= $class; ?>">
                                <button type="submit" name='delete' class='del_up' value='{{ $rate->id }}'>del</button>
                            </td>
                            <td class="<?= $class; ?>">${{ number_format($rate->roof, 0) }}</td>
                            @if ($advisor->feeCalculation!=2 || $rates->count()==0) 
                            <td class="<?= $class; ?>">{{ number_format($rate->rate*100, 3) }}%</td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection