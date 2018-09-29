<?php $tab = "History"; ?>
@extends('layouts.master')

@section('box1')
<div class="paddingForHeader">
</div>
@endsection

@section('box2')
<!-- Page Content -->
<section>
    <div class="container">

        <form method="post" action="{{url('/history/csv/create')}}">
            {{ csrf_field() }}
            <table class="table table-striped">
@if (count($list)>0)
                <tr>
                    <th colspan="5"> 
                        History of searches that were
                        @if($downloaded==1)
                        already downloaded
                        @else
                        never downloaded
                        @endif
                    </th>
                </tr>
                <tr>
                    <th>Select</th>
                    <th class="text-left">
                        <button type="submit" class="link" formaction="{{url('/history/download/zipcode')}}/{{$downloaded}}"  >zipcode</button>
                    </th>
                    <th class="text-right">
                        <button type="submit" class="link" formaction="{{url('/history/download/amount')}}/{{$downloaded}}"   >amount</button>
                    </th>
                    <th class="text-left">
                        <button type="submit" class="link" formaction="{{url('/history/download/signup_id')}}/{{$downloaded}}">Signup ID</button>
                    </th>
                    <th class="text-left">
                        <button type="submit" class="link" formaction="{{url('/history/download/name')}}/{{$downloaded}}"     >name</button>
                    </th>
                </tr>
@else
                <tr><td class="text-left"> There is no search history to download</td></tr>
@endif

@foreach($list as $row)
                <tr @if($row->downloaded) class="text-success" @endif>
                    <td class="text-center">
                        <input type="checkbox" id="id{{$row->id}}" name="check_list[]" 
                        value="{{$row->id}},{{ $row->zipcode }},{{$row->amount}}, {{$row->signup_id}}, {{ $row->name }}" 
                        @if(!$row->downloaded) checked="checked" @endif />
                    </td>
                    <td class="text-left">{{ $row->zipcode   }} </td>
                    <td class="text-right">{{ number_format($row->amount) }} </td>
                    <td class="text-left">{{ $row->signup_id }} </td>
                    <td class="text-left">{{ $row->name      }} </td>
                </tr>
@endforeach

            </table>

            <div class="row">
                <div style="margin:10px auto" class="pagination pagination-sm text-center">
                    {{ $list->render() }}
                </div>
            </div>

            <!-- opens layouts.popup -->
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
?>
            <button type="submit" class="btn {{$c}}" value="x" name="flag"
            formaction="{{ url('/history/download/name')}}/{{$use}}">
            {{ $msg }}
            </button>

@php ($table = "history")
@include('layouts.popup')
        </form>
@include('layouts.errors')
    </div>
</section>
@endsection
