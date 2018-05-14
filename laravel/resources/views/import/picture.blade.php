<?php $tab="Import Pictures"; ?>
@extends('layouts.master')

@section('box1')
<div class="paddingForHeader">
</div>
@endsection

@section('box2')
<div class="container">
    <div class="row">
        <div class="col-md-4"> </div>
        <div class="col-md-8 col-md-offset-4">

            <p>Upload image file. Will over write existing image</p>
            <form id="trackingFile" action="{{ url('upload') }}" method="post" enctype="multipart/form-data"> 
                {{ csrf_field() }}

                <p><input type="file"   class='btn btn-default' name="fileUpload" id="fileUpload" autocomplete="off" /></p>
                <p><input type="submit" class='btn btn-default' name="submit" value="Upload File" /></p>

            </form>
        </div>
    </div>
    @isset($success)
        <div class="alert alert-success"> {{ $success }} </div>
    @endisset

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            @include('layouts.errors')
        </div>
    </div>
    
</div>
@endsection
