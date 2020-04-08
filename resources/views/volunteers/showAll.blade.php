@extends('layouts.app')

@section('content')
@if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
@endif
<div class="container">

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

@foreach($models as $m)
     <tr>
     	<th scope="col"> <img src="/storage/{{ $m['volunteer']->image }}" class="rounded-circle w-100" style="max-width: 50px;"> </th>
     	<td> <a href="/v/{{$m['volunteer']->id}}"> {{$m['volunteer']->first_and_last_name}} </a> </td>
      <td> {{$m['number']}} </td>
      <td> {{$m['hours']}} </td>
     </tr>
@endforeach

</tbody>
</table>
</div>

@endsection
