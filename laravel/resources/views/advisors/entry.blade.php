<?php $tab="Add Advisor"; ?>
@extends('layouts.master')

@section('box1')
<div class="paddingForHeader">
</div>
@endsection

@section('box2')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <h1>Register</h1>
                <br />
                <div class="panel-body">

                    <form class="form-horimaximum_amtontal" method="POST" action="/store">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-8 control-label">Name</label>
                            <div class="col-md-8 {{ $errors->has('name') ? ' has-error' : '' }}">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name',$user->name ) }}" autofocus />
                                @if ($errors->has('name')) 
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 

                        <div class="form-group">
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

                        <div class="form-group">
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

                        <div class="form-group">
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

                        <div class="form-group">
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

                        <div class="form-group">
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


                        <div class="form-group">
                            <label for="city" class="col-md-8 control-label">City</label>
                            <div class="col-md-8 {{ $errors->has('city') ? ' has-error' : '' }}">
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" />
                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="st" class="col-md-4 control-label">State</label>
                            <label for="zip" class="col-md-4 control-label">Zip</label>

                            <div style="float:left;" class="col-md-4 {{ $errors->has('st') ? ' has-error' : '' }}">
                                {!! $state !!}
                                @if ($errors->has('st'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('st') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div style="float:left;" class="col-md-4 {{ $errors->has('zip') ? ' has-error' : '' }}">
                                <input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip') }}" />
                                @if ($errors->has('zip'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br clear="both" />
                        </div>

                        <div class="form-group">
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

                        <div class="form-group">
                            <label for="maximum_amt" class="col-md-8 control-label">Maximum Amount of Investment</label>
                            <div class="col-md-8 {{ $errors->has('maximum_amt') ? ' has-error' : '' }}">
                                <input id="maximum_amt" type="text" class="form-control" name="maximum_amt" value="{{ old('maximum_amt', '10,000,000') }}" />
                                @if ($errors->has('maximum_amt'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('maximum_amt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
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

                        <div class="form-group">
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

                        <div class="form-group">
                            <label for="bio" class="col-md-8 control-label">About you and/or your company</label>
                            <div class="col-md-8 {{ $errors->has('bio') ? ' has-error' : '' }}">
                                <textarea id="bio" class="form-control" name="bio" rows="4" cols="50" style="text-align: left;">{{ old('bio') }}</textarea> 
                                @if ($errors->has('bio'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bio') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="facebook" class="col-md-8 control-label">
                                <a href="https://facebook.com" target="_blank">Facebook</a>
                            </label>
                            <div class="col-md-8 {{ $errors->has('facebook') ? ' has-error' : '' }}">
                                <input id="facebook" type="url" class="form-control" name="facebook" value="{{ old('facebook') }}" />
                                @if ($errors->has('facebook'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('facebook') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="finraBrokercheck" class="col-md-8 control-label">
                                <a href="https://brokercheck.finra.org/" target="_blank">Finra Brokercheck</a>
                            </label>
                            <div class="col-md-8 {{ $errors->has('finraBrokercheck') ? ' has-error' : '' }}">
                                <input id="finraBrokercheck" type="url" class="form-control" name="finraBrokercheck" value="{{ old('finraBrokercheck') }}" />
                                @if ($errors->has('finraBrokercheck'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('finraBrokercheck') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="linkedin" class="col-md-8 control-label">
                                <a href="https://linkedin.com/" target="_blank">LinkedIn</a>
                            </label>
                            <div class="col-md-8 {{ $errors->has('linkedin') ? ' has-error' : '' }}">
                                <input id="linkedin" type="url" class="form-control" name="linkedin" value="{{ old('linkedin') }}" />
                                @if ($errors->has('linkedin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('linkedin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="twitter" class="col-md-8 control-label">
                                <a href="https://twitter.com/" target="_blank">Twitter</a>
                            </label>
                            <div class="col-md-8 {{ $errors->has('twitter') ? ' has-error' : '' }}">
                                <input id="twitter" type="url" class="form-control" name="twitter" value="{{ old('twitter') }}" />
                                @if ($errors->has('twitter'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('twitter') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="discretionaryAUM" class="col-md-8 control-label">Discretionary AUM</label>
                            <div class="col-md-8 {{ $errors->has('discretionaryAUM') ? ' has-error' : '' }}">
                                <input id="discretionaryAUM" type="text" class="form-control" name="discretionaryAUM" value="{{ old('discretionaryAUM') }}" />
                                @if ($errors->has('discretionaryAUM'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('discretionaryAUM') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
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
