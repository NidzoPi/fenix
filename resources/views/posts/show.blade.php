@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">


    <div class="col-4">
    	<div>

      		<div class="d-flex align-items-center">
      			<div>
      				<img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 50px;">
      			</div>
      			<div class="pl-3">
      				<h5> <a href="/profile/{{ $post->user->id }}"> @ {{ $post->user->username }} </a> </h5>
      			</div>
     		 </div>
         <div class="d-flex align-items-center pt-3">
            <div> <h6> <b> {{ $post->title }} </b> </h6> </div>
            <div class="pl-5"></div>
            <div class="pl-5"> </div>
            @can ('update', $post)
             <div class="pl-5 pb-2"> <a href="/p/{{ $post->id }}/edit"> Edituj akciju </a></div>
            @endcan
         </div>

     		 <hr>

     		 <div class="pt-1">
        		<p> {{ $post->description }}</p>
        	</div>

    	</div>
    </div>

    <div class="col-8">
      <img src="/storage/{{ $post->image }} " class="w-100" />
    </div>


  </div>

  <div class="row">
    <div class="col-12 d-flex">
      <div> <a href="/{{$post->id}}/h/create"> Dodaj volontera </a> </div>
      <div class="pl-5"> <a href=""> Ko je učestvovao? </a> </div>
    </div>
  </div>
  <hr>
  <div class="row"> 
    @foreach($models as $m)
     
       <div class="pl-3">  {{ $m['volunteer']->first_and_last_name }}  {{$m['sum']}}h | </div>
     
    @endforeach
</div>
</div>

@endsection
