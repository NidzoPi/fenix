@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-12">
				<form action="/p/image-upload/{{ $post->id }}"
			      class="dropzone"
			      id="my-awesome-dropzone-{{ $post->id }}">@csrf</form>
			 </div>
  		</div>
  		<div class="row">
  			@foreach($postImages as $image)
  			<img style="width: 300px;" src="{{asset($image->image_path)}}">
  			@endforeach
  		</div>
	</div>
	
@endsection