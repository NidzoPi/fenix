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
</div>
@endsection
