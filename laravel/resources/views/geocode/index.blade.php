<?php $tab = "Geocode"; ?>
@extends('layouts.master')

@section('box1')
    @include('layouts.header')
@endsection

@section('box2')
<div class="bg-faded p-4 my-4">
<?php

/*

DB::

get address from database the advisor

pass it to google api

update database

*/

?>
  <ul>
    @foreach ($advisors as $advisor) 
      <li>
        <a href="/advisors/{{ $advisor->id }}"> 
            {{ $advisor->name }} <br />
      	</a>
            {{ $advisor->address1 }} 
            {{ $advisor->address2 }} <br />
            {{ $advisor->city }}, {{ $advisor->st }} {{ $advisor->zip }} <br />
            {{ $advisor->lat }}   {{ $advisor->lng }} <br />

      </li>
    @endforeach
  </ul>

</div>
@endsection