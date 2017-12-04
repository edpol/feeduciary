<?php $tab="Add Advisor"; ?>
@extends('layouts.master')

@section('box1')
    <header class="intro-header">
    </header>
@endsection

@section('box2')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <h1>Register</h1>
                <br />
                <div class="panel-body">

                    <form class="form-horimaximum_amtontal " method="POST" action="/store">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-8 control-label">Name</label>
                            <div class="col-md-8 {{ $errors->has('name') ? ' has-error' : '' }}">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name',$user->name ) }}" required autofocus />
                                @if ($errors->has('name')) 
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-8 control-label">Phone</label>
                            <div class="col-md-8 {{ $errors->has('phone') ? ' has-error' : '' }}">
                                <input id="phone" type="tel" class="form-control" name="phone" value="{{ old('phone') }}" />
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-8 control-label">E-mail Address</label>
                            <div class="col-md-8 {{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" />
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
                            <label for="company" class="col-md-8 control-label">Company</label>
                            <div class="col-md-8 {{ $errors->has('company') ? ' has-error' : '' }}">
                                <input id="company" type="text" class="form-control" name="company" value="{{ old('company') }}" />
                                @if ($errors->has('company'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                            <label for="address1" class="col-md-8 control-label">Address 1</label>
                            <div class="col-md-8 {{ $errors->has('address1') ? ' has-error' : '' }}">
                                <input id="address1" type="text" class="form-control" name="address1" value="{{ old('address1') }}" />
                                @if ($errors->has('address1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                            <label for="address2" class="col-md-8 control-label">Address 2</label>
                            <div class="col-md-8 {{ $errors->has('address2') ? ' has-error' : '' }}">
                                <input id="address2" type="text" class="form-control" name="address2" value="{{ old('address2') }}" />
                                @if ($errors->has('address2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-8 control-label">City</label>
                            <div class="col-md-8" {{ $errors->has('city') ? ' has-error' : '' }}>
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" />
                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('st') ? ' has-error' : '' }}">
                            <label for="st" class="col-md-8 control-label">State</label>
                            <div class="col-md-8 {{ $errors->has('st') ? ' has-error' : '' }}">
 								@include('layouts.states')
                                @if ($errors->has('st'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('st') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                            <label for="zip" class="col-md-8 control-label">Zip</label>
                            <div class="col-md-8 {{ $errors->has('zip') ? ' has-error' : '' }}">
                                <input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip') }}" />
                                @if ($errors->has('zip'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('minimum_amt') ? ' has-error' : '' }}">
                            <label for="minimum_amt" class="col-md-8 control-label">Minimum Investment Amount</label>
                            <div class="col-md-8 {{ $errors->has('minimum_amt') ? ' has-error' : '' }}">
                                <input id="minimum_amt" type="text" class="form-control" name="minimum_amt" value="{{ old('minimum_amt') }}" />
                                @if ($errors->has('minimum_amt'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('minimum_amt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('maximum_amt') ? ' has-error' : '' }}">
                            <label for="maximum_amt" class="col-md-8 control-label">Maximum Amount of Investment</label>
                            <div class="col-md-8 {{ $errors->has('maximum_amt') ? ' has-error' : '' }}">
                                <input id="maximum_amt" type="text" class="form-control" name="maximum_amt" value="{{ old('maximum_amt', '10000000') }}" />
                                @if ($errors->has('maximum_amt'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('maximum_amt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('minimum_fee') ? ' has-error' : '' }}">
                            <label for="minimum_fee" class="col-md-8 control-label">Minimum Fee</label>
                            <div class="col-md-8 {{ $errors->has('minimum_fee') ? ' has-error' : '' }}">
                                <input id="minimum_fee" type="text" class="form-control" name="minimum_fee" value="{{ old('minimum_fee') }}" />
                                @if ($errors->has('minimum_fee'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('minimum_fee') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('brochure') ? ' has-error' : '' }}">
                            <label for="brochure" class="col-md-8 control-label">Part 2 Brochure URL</label>
                            <div class="col-md-8 {{ $errors->has('brochure') ? ' has-error' : '' }}">
                                <input id="brochure" type="url" class="form-control" name="brochure" value="{{ old('brochure') }}" />
                                @if ($errors->has('brochure'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('brochure') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('blurb') ? ' has-error' : '' }}">
                            <label for="blurb" class="col-md-8 control-label">About you and/or your company</label>
                            <div class="col-md-8 {{ $errors->has('blurb') ? ' has-error' : '' }}">
                                <textarea id="blurb" class="form-control" name="blurb" rows="4" cols="50" style="text-align: left;">{{ old('blurb') }}</textarea> 
                                @if ($errors->has('blurb'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('blurb') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('feeCalculation') ? ' has-error' : '' }}">
                            <label class="col-md-8 control-label">Fee Calculation Formula
								<a id="popup" target="_blank" href="/ratesInfo"><img src="{{ asset('images/information.gif') }}" alt="Rate Plans" title"information"/></a>
							</label>
                            <div class="col-md-8" {{ $errors->has('feeCalculation') ? ' has-error' : '' }}>
				                <input id="feeCalculation" type="radio" name="feeCalculation" value="0" /> Cumulative rates per tier<br />
				                <input id="feeCalculation" type="radio" name="feeCalculation" value="1" /> Rate changes with investment amount<br />
                                @if ($errors->has('feeCalculation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('feeCalculation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <input id="user_id" type="hidden" class="form-control" name="user_id" value="{{ $user->id }}" />

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Advisor
                                </button>
                            </div>
                        </div>

                        @include('layouts.errors')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
