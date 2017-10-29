@extends('layouts.master')

@section('box1')
<div class="bg-faded p-4 my-4">
    <?php // this one is only returning one record so ->body works ?>
    <h4>
        <div style="float:left; padding-right:6px;">
            name: <br />
            phone: <br />
            email: <br />
            company: <br />
            address: <br />
            <br />
            minimum amount: <br />
            maximum amount: <br />
            minimum fee: <br />
            fee calculatuin: <br />
            lat/lng: <br />
            brochure: <br />
            created: <br />
            updated: <br />
            desc: <br />
        </div>

        <div style="float:left;">
            {{ $advisor->name  }} <br />
            {{ $advisor->phone }} <br />
            {{ $advisor->email }} <br />

            @if(isset($advisor->url) && !empty($advisor->url))
                <a href="{{ $advisor->url }}" target="_blank"> 
            @endif
            {{ $advisor->company }} 
            @if(isset($advisor->url) && !empty($advisor->url))
                </a> 
            @endif
            <br />
            {{ $advisor->address1 }} 
            {{ $advisor->address2 }} <br />
            {{ $advisor->city }}, {{ $advisor->st }} {{ $advisor->zip }} <br />


            {{ number_format($advisor->minimum_amt, 0) }} <br />
            {{ number_format($advisor->maximum_amt, 0) }} <br />
            {{ number_format($advisor->minimum_fee, 0) }} <br />
            {{ $advisor->feeCalculation }} <br />
            {{ $advisor->lat }}   {{ $advisor->lng }} <br />
            <a href="{{ $advisor->brochure }}" target="_blank">Brochure</a> <br />
            {{ $advisor->blurb }} <br />
        </div>
        <br clear="all" />
    </h4>
</div>
@endsection