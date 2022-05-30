<?php $tab = "Update Advisor"; ?>
@extends('layouts.master')

@section('box1')
<div class="paddingForHeader">
</div>
@endsection

@section('box2')
<!-- Page Content -->
<section class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 ml-auto">
                <div class="clearfix"></div>
                <h3 class="section-heading">Update Advisor Information</h3>
                <form class="form-horimaximum_amtontal " method="GET" action="{{ url('/update/advisor') }}/{{ $advisor->id }}" id="frmContact">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-8 control-label">Name*</label>
                        <div class="col-md-8 {{ $errors->has('name') ? ' has-error' : '' }}">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name',$advisor->name ) }}" tabindex="1"/>
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
                            <input id="phone" type="tel" class="form-control phone" name="phone" value="{{ old('phone',$advisor->phone) }}" tabindex="2"/>
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-8 control-label">E-mail Address*</label>
                        <div class="col-md-8 {{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $advisor->email) }}" tabindex="3"/>
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
                            <input id="company" type="text" class="form-control" name="company" value="{{ old('company',$advisor->company) }}" tabindex="4"/>
                            @if ($errors->has('company'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('company') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                        <label for="url" class="col-md-8 control-label">Company URL</label>
                        <div class="col-md-8 {{ $errors->has('url') ? ' has-error' : '' }}">
                            <input id="url" type="url" class="form-control" name="url" value="{{ old('url',$advisor->url) }}" tabindex="5"/>
                            @if ($errors->has('url'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('url') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                        <label for="address1" class="col-md-8 control-label">Address 1</label>
                        <div class="col-md-8 {{ $errors->has('address1') ? ' has-error' : '' }}">
                            <input id="address1" type="text" class="form-control" name="address1" value="{{ old('address1',$advisor->address1) }}" tabindex="6"/>
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
                            <input id="address2" type="text" class="form-control" name="address2" value="{{ old('address2',$advisor->address2) }}" onkeypress="return myKeyPress(event)" tabindex="7"/>
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
                            <input id="city" type="text" class="form-control" name="city" value="{{ old('city',$advisor->city) }}" tabindex="8"/>
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
                            <!-- html_entity_decode -->
                            @php $tabindex=9 @endphp
                            {!! optionState($advisor->st,$tabindex) !!}  
                            @if ($errors->has('st'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('st') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                        <label for="zip" class="col-md-8 control-label">Zip*</label>
                        <div class="col-md-8 {{ $errors->has('zip') ? ' has-error' : '' }}">
                            <input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip',$advisor->zip) }}" tabindex="10"/>
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
                            <input id="minimum_amt" type="text" class="form-control comma" name="minimum_amt" value="{{ old('minimum_amt', number_format($advisor->minimum_amt),0) }}" tabindex="11"/>
                            @if ($errors->has('minimum_amt'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('minimum_amt') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
<!--
                    <div class="form-group{{ $errors->has('maximum_amt') ? ' has-error' : '' }}">
                        <label for="maximum_amt" class="col-md-8 control-label">Maximum Amount of Investment</label>
                        <div class="col-md-8 {{ $errors->has('maximum_amt') ? ' has-error' : '' }}">
                            <input id="maximum_amt" type="text" class="form-control" name="maximum_amt" value="{{ old('maximum_amt', number_format($advisor->maximum_amt),0) }}" tabindex="12"/>
                            @if ($errors->has('maximum_amt'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('maximum_amt') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
-->
                    <div class="form-group{{ $errors->has('minimum_fee') ? ' has-error' : '' }}">
                        <label for="minimum_fee" class="col-md-8 control-label">Minimum Annual Fee</label>
                        <div class="col-md-8 {{ $errors->has('minimum_fee') ? ' has-error' : '' }}">
                            <input id="minimum_fee" type="text" class="form-control comma" name="minimum_fee" value="{{ old('minimum_fee', number_format($advisor->minimum_fee),0) }}" tabindex="13"/>
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
                            <input id="brochure" type="url" class="form-control" name="brochure" value="{{ old('brochure',$advisor->brochure) }}" tabindex="14"/>
                            @if ($errors->has('brochure'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('brochure') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('bio') ? ' has-error' : '' }}">
                        <label for="bio" class="col-md-8 control-label">About you and/or your company</label>
                        <div class="col-md-8 {{ $errors->has('bio') ? ' has-error' : '' }}">
                            <textarea id="bio" class="form-control" name="bio" rows="4" cols="50" style="text-align: left;" tabindex="15">{{ old('bio',$advisor->bio) }}</textarea> 
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
                            <input id="facebook" type="url" class="form-control" name="facebook" value="{{ old('facebook', $advisor->facebook) }}" tabindex="16"/>
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
                            <input id="finraBrokercheck" type="url" class="form-control" name="finraBrokercheck" value="{{ old('finraBrokercheck', $advisor->finraBrokercheck) }}" tabindex="17"/>
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
                            <input id="linkedin" type="url" class="form-control" name="linkedin" value="{{ old('linkedin', $advisor->linkedin) }}" tabindex="18"/>
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
                            <input id="twitter" type="url" class="form-control" name="twitter" value="{{ old('twitter', $advisor->twitter) }}" tabindex="19"/>
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
                            <input id="discretionaryAUM" type="text" class="form-control comma" name="discretionaryAUM" value="{{ old('discretionaryAUM', number_format($advisor->discretionaryAUM),0) }}" tabindex="20"/>
                            @if ($errors->has('discretionaryAUM'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('discretionaryAUM') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        @include('rates.info')
                        <div class="col-md-8 {{ $errors->has('feeCalculation') ? ' has-error' : '' }}">
                            <input required id="feeCalculation" type="radio" name="feeCalculation" value="0" @if ($advisor->feeCalculation == 0) checked @endif tabindex="21"/> Cumulative rates per tier 
                            <a href="#myModal1" class="btn-xs" data-toggle="modal"><img src="{{ asset('images/information.gif') }}" alt="Rate Plans" title="information"/></a><br />

                            <input required id="feeCalculation" type="radio" name="feeCalculation" value="1" @if ($advisor->feeCalculation == 1) checked @endif /> Total Portfolio, Single Rate
                            <a href="#myModal2" class="btn-xs" data-toggle="modal"><img src="{{ asset('images/information.gif') }}" alt="Rate Plans" title="information"/></a><br />

                            <input required id="feeCalculation" type="radio" name="feeCalculation" value="2" @if ($advisor->feeCalculation == 2) checked @endif /> Fee Only
                            <a href="#myModal3" class="btn-xs" data-toggle="modal"><img src="{{ asset('images/information.gif') }}" alt="Rate Plans" title="information"/></a><br />

                            @if ($errors->has('feeCalculation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('feeCalculation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <input id="user_id"    type="hidden" class="form-control" name="user_id"    value="{{ $advisor->user_id }}" />

                    @include('layouts.errors')
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary" tabindex="22" @if (count($errors)) autofocus @endif>
                                Update Advisor
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
<!-- /.container -->
</section>

@endsection