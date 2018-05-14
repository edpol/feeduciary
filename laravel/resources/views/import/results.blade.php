<?php $tab="Import Results"; ?>
@extends('layouts.master')

@section('box1')
<div class="paddingForHeader">
</div>
@endsection

@section('box2')
<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">

            <form id="trackingFile" action="/" method="get">
                {{ csrf_field() }}
                <p><input type="submit" class='btn btn-default' name="submit" 
                    value="Return Home" /></p>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            @isset($success)
                <p class="alert alert-success">{{ $success }}</p>
            @endisset
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            @include('layouts.errors')
        </div>
    </div>

</div>
@endsection
