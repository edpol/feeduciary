use App\Http\Controllers;

<?php $tab="Edit"; ?>
@extends('layouts.master')

@section('box1')
<div class="container">
    &nbsp;
</div>
@endsection

@section('box2')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <h1>Edit Advisor Information</h1>
                <br />
                <div class="panel-body">

@include('advisors.display')

                    <form class="form-horimaximum_amtontal " method="POST" action="/edit/{{ $advisor->id }}">
                        {{ csrf_field() }}


                        <input id="advisor_id" type="hidden" class="form-control" name="advisor_id" value="{{ $advisor->id }}" />
                        <input id="advisor"    type="hidden" class="form-control" name="advisor"    value="{{ $advisor }}" />

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Edit Advisor
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
