<?php $tab="Edit Rates"; ?>
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
                <form class="form-horimaximum_amtontal " method="GET" action="/newRate/{{ $advisor->id }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('roof') ? ' has-error' : '' }}">
                        <label for="roof" class="col-md-8 control-label">Roof</label>
                        <div class="col-md-8">
                            <input id="roof" type="text" class="form-control" name="roof" value="{{ old('roof') }}" autofocus />
                            @if ($errors->has('roof'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('roof') }}</strong>
                                </span>
                            @endif
                            {{ $msg }}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('rate') ? ' has-error' : '' }}">
                        <label for="rate" class="col-md-8 control-label">Rate</label>
                        <div class="col-md-8">
                            <input id="rate" type="rate" class="form-control" name="rate" value="{{ old('rate') }}" />
                            @if ($errors->has('rate'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('rate') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <input id="advisor_id" type="hidden" class="form-control" name="advisor_id" value="{{ $advisor->id }}" />
                    <input id="advisor"    type="hidden" class="form-control" name="advisor"    value="{{ $advisor }}" />

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">
                                Add Rate ({{ $advisor->name }})
                            </button>
                            <button style="float:right;" type="submit" class="btn btn-primary" formaction="/done/{{ $advisor->id }}">
                                Done
                            </button>
                        </div>
                    </div>
                    @include('layouts.errors')
                </form>
            </div>

            <!-- 2nd Column -->
            <div class="col-lg-6 bluebox">
                <form id="form1" action="/destroy/{{ $advisor->id }}" autocomplete="off" method="post"> <!-- onKeyDown="pressed(event)"> -->
                    {{ csrf_field() }}
                    <input id="advisor_id" type="hidden" class="form-control" name="advisor_id" value="{{ $advisor->id }}" />
                    <input id="advisor"    type="hidden" class="form-control" name="advisor"    value="{{ $advisor }}" />

                   <table border=0>
                        <tr><th>&nbsp;</th><th>Roof&nbsp;</th><th>Rate</th></tr>
                        @foreach ($rates as $rate)
                        <tr>
<?php                       $class = (!isset($class)||$class=="white") ? "grey" : "white"; ?>
                            <td class="<?= $class; ?>">
                                <button type="submit" name='delete' class='del_up' value='{{ $rate->id }}'>del</button>
                            </td>
                            <td class="<?= $class; ?>">${{ number_format($rate->roof, 0) }}</td>
                            <td class="<?= $class; ?>">{{ number_format($rate->rate*100, 3) }}%</td>
                            <td class="<?= $class; ?>">{{ $rate->rate*100 }}</td>
                        </tr>
                        @endforeach
                    </table>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection