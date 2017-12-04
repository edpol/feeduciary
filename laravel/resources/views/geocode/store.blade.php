<?php $tab = "Geocode"; ?>
@extends('layouts.master')

@section('box1')
    @include('layouts.header')
@endsection

@section('box2')
<div class="bg-faded p-4 my-4">
    <div style='color:red;'>{{ $msg }}</div>
    <a href="/advisors/{{ $advisor->id }}"> 
        {{ $advisor->id }} <br />
        {{ $advisor->name }} <br />
    </a>
    {{ $advisor->address1 }} 
    {{ $advisor->address2 }} <br />
    {{ $advisor->city }}, {{ $advisor->st }} {{ $advisor->zip }} <br />
    {{ $advisor->lat }}   {{ $advisor->lng }} <br />
    <br />
</div>
@endsection