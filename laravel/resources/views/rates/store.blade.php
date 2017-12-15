<?php $tab="Store Rates"; ?>
@extends('layouts.master')

@section('box1')
<div class="paddingForHeader">
</div>
@endsection

@section('box2')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
                <h1>Register</h1>
                <br />
                <div class="panel-body">

                    <form class="form-horimaximum_amtontal " method="POST" action="/storeRates">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('roof') ? ' has-error' : '' }}">
                            <label for="roof" class="col-md-4 control-label">Roof</label>
                            <div class="col-md-8">
                                <input id="roof" type="text" class="form-control" name="roof" value="{{ old('roof') }}" />
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
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    Add Rate ({{ $advisor->name }})
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="form-group">
                        <div class="col-md-6">
                            <form method="get" action="/update">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary">
                                    Done
                                </button>
                            </form>
                        </div>
                    </div>
                    @include('layouts.errors')
                </div>
            </div>
        </div>
        <div class="col-md-4">
                <h2>Rates Table</h2>
                @include('rates.display')
        </div>
    </div>
</div>
@endsection