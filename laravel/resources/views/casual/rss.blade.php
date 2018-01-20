<?php $tab="RSS"; ?>
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
                <h1>Financial Advisor - Online Articles</h1>
                <br />
                <div class="panel-body">
                    <?= htmlspecialchars_decode($msg); ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection