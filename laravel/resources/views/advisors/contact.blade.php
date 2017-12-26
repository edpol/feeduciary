<?php $tab = "Contact Advisor"; ?>
@extends('layouts.master')

@section('box1')
<div class="paddingForHeader">
</div>
@endsection

@section('box2')
<div class="container">
    <div class="bg-faded p-4 my-4">
        <hr class="divider">
        <h2 class="text-center text-lg text-uppercase my-0">
            <strong>Feeduciary Contact Form</strong>
        </h2>
        <hr class="divider" />
        <div class="row">
            <form action="/send" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="title"       value="User Message" />
                <input type="hidden" name="id"          value="{{ $advisor->id }}" />
                <input type="hidden" name="advisorName" value="{{ $advisor->id }}" />
                <input type="hidden" name="toEmail"     value="{{ $advisor->email }}" />
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label class="text-heading">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group col-lg-4">
                        <label class="text-heading">Email Address</label>
                        <input type="email" name="fromEmail" class="form-control">
                    </div>
                    <div class="form-group col-lg-4">
                        <label class="text-heading">Phone Number</label>
                        <input type="tel" name="phone" class="form-control">
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-lg-12">
                        <label class="text-heading">Message</label>
                        <textarea class="form-control" name="message" rows="6"></textarea>
                    </div>
                    <div class="form-group col-lg-12">
                        <button type="submit" class="btn btn-secondary">Submit to {{ $advisor->name }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection