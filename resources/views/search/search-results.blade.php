@extends('layouts.app')

@section('content')
<div class="container"> 
	<h1> Rezultati pretrage </h1>
  	<p> {{ $users->count() }} rezultat(a) za  '{{ request()->input('search') }}' </p>
  	<hr>

	@foreach ($users as $u)
	<a href="/profile/{{ $u->username }}">
		<div class="row pt-3">
			<div class="col-md-2"> 
				<img style="width: 200px;" src = "/storage/{{ $u->profile->image ?? '/profile/noimage.jpg' }}"> 
			</div>
			<div class="col-md-2 pl-5 pt-5">
				<h2> {{ $u->name }} </h2>
			</div>
		</div>
	</a>
	@endforeach
</div>
@endsection