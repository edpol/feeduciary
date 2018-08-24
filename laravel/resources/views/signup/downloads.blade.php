<?php $tab = "Verified List"; ?>
@extends('layouts.master')

@section('box1')
<div class="paddingForHeader">
</div>
@endsection

@section('box2')
<!-- Page Content -->
<section>
    <div class="container">

        <form method="post" action="{{url('/signup/csv/create')}}">
            {{ csrf_field() }}
            <table class="table table-striped">
@if (count($list)>0)
                <tr>
                    <th colspan="5"> 
                        List of verified email addresses that were
                        @if($downloaded==1)
                        already downloaded
                        @else
                        never downloaded
                        @endif
                    </th>
                </tr>
                <tr><th>Select</th>
                    <th class="text-left">
                        <button type="submit" class="link" formaction="{{url('/signup/download/email')}}/{{$downloaded}}">email</button>
                    </th>
                    <th class="text-left">
                        <button type="submit" class="link" formaction="{{url('/signup/download/name')}}/{{$downloaded}}">name</button>
                    </th>
                    <th class="text-left">
                        <button type="submit" class="link" formaction="{{url('/signup/download/updated_at')}}/{{$downloaded}}">updated</button>
                    </th>
                    <th class="text-left">
                        <button type="submit" class="link" formaction="{{url('/signup/download/unsubscribe')}}/{{$downloaded}}">unsubscribed</button>
                    </th>
                </tr>
@else
    <tr><td class="text-left"> There are no emails to download</td></tr>
@endif

@foreach($list as $row)
                <tr @if($row->downloaded && !$row->unsubscribe) class="text-success" @endif @if($row->unsubscribe) class="text-danger" style="background-color:#fee;" @endif >
                    <td class="text-center">
                        <input type="checkbox" id="id{{$row->id}}" name="check_list[]" 
                        value="{{$row->id}},{{ $row->email }},{{ $row->name }},{{ $row->updated_at }}" 
                        @if(!$row->downloaded && !$row->unsubscribe) checked="checked" @endif />
                    </td>
                    <td class="text-left">{{ $row->email }}</td>
                    <td class="text-left">{{ $row->name }} </td>
                    <td class="text-left">{{ $row->updated_at }}</td>
                    <td class="text-left">{{ $row->unsubscribe }}</td>
                </tr>
@endforeach

            </table>

            <div class="row">
                <div style="margin:10px auto" class="pagination pagination-sm text-center">
                    {{ $list->render() }}
                </div>
            </div>
<!--
            <button class="btn btn-primary" type="submit">Download selected</button>
-->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#yourModal">
    Download
</button>

<?php
if ($downloaded==1) {
    $use = 0;
    $c = "btn-warning";
    $msg = "NOT Downloaded";
} else {
    $use = 1;
    $c = "btn-success";
    $msg = "View Downloaded";
}
$use = ($downloaded==1) ? 0 : 1; ?>
<button type="submit" class="btn {{$c}}" value="x" name="flag"
formaction="{{ url('/signup/download/name')}}/{{$use}}">
{{ $msg }}
</button>


@include('signup.popup')
        </form>
@include('layouts.errors')
    </div>
</section>
@endsection
