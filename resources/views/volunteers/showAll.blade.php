@extends('layouts.app')

@section('content')
<div class="container">

    <!-- <div class="row">
	     <div class="d-flex pl-2">
	     	<div> Slika </div>
		    <div class="pl-4"> Ime i prezime </div>
		    <div class="pl-4"> Br. akcija </div>
		    <div class="pl-4"> Br. volonterskih sati </div>
	 	</div>
 	</div><hr> !-->

 <table class="table">
  <thead>
    <tr>
      <th scope="col">Slika</th>
      <th scope="col">Ime i prezime</th>
      <th scope="col">Broj akcija</th>
      <th scope="col">Broj volonterskih sati</th>
    </tr>
  </thead>
  <tbody>

    <!-- @foreach(auth()->user()->volunteers as $v)
     <div class="row">
	     <div class="d-flex">
	     	<div> <img src="/storage/{{ $v->image }}" class="rounded-circle w-100" style="max-width: 50px;"> </div>
		    <div class="pl-4"> {{$v->first_and_last_name}} </div>
		    <?php $sum = 0; ?>
		    <div class="pl-5"> @foreach ($rv as $r)   @if($v->id == $r->volunteer_id) <?php $sum++; ?>  @endif @endforeach {{$sum}} </div>
		    <?php $sumH = 0; ?>
		    <div class="pl-5"> @foreach ($rv as $r)   @if($v->id == $r->volunteer_id) <?php $sumH+=$r->hours; ?>  @endif @endforeach {{$sumH}} </div>
	 	</div>
 	</div><hr>
     @endforeach !-->

@foreach(auth()->user()->volunteers as $v)
     <tr>
     	<th scope="col"> <img src="/storage/{{ $v->image }}" class="rounded-circle w-100" style="max-width: 50px;"> </th>
     	<td> <a href="/v/{{$v->id}}"> {{$v->first_and_last_name}} </a> </td>
     	<?php $sum = 0; ?>
     	<td> @foreach ($rv as $r)   @if($v->id == $r->volunteer_id) <?php $sum++; ?>  @endif @endforeach {{$sum}} </td>
     	<?php $sumH = 0; ?>
     	<td> @foreach ($rv as $r)   @if($v->id == $r->volunteer_id) <?php $sumH+=$r->hours; ?>  @endif @endforeach {{$sumH}} </td>
     </tr>
@endforeach


</tbody>
</table>
</div>
@endsection
