@extends('layouts.app')

@section('scriptandlinks')


<script>

	Dropzone.options.myDropzone = {

		maxFiles: 4,
		maxFilesize: 10,
		acceptedFiles: "image/*",


		init: function() {
          console.log('init');
          this.on("maxfilesexceeded", function(file){
                alert("No more files please!");
                this.removeFile(file);
          });
		},


		success: function (file, response){
			if (file.status == 'success'){
				handleDropzoneFileUpload.handleSuccess(response);
				console.log(response);
			}
			else{
				handleDropzoneFileUpload.handleError(response);
			}
		}
	};
		var handleDropzoneFileUpload = {
		handleError: function(response){
			console.log(response);
		},
		handleSuccess: function(response){
			
			var baseUrl = "{{ asset('/') }}";
			var imageSrc =  baseUrl + '' + response.image_path;
			var deleteSrc = baseUrl + 'p/delete-image/' + response.post_id + '/' + response.id;
			//var selector = document.getElementById('fuckimgs');
			//selector.innerHTML = '<h1>string of html content</h1>';
			$('#fuckimgs').append(' <div class="col-sm-4 pt-5 pl-2"> <img src="'+ imageSrc +'" width="300"> <form class="pl-5 pt-2" name="delete-image" action="'+ deleteSrc +'" method="DELETE"> {{ csrf_field() }}  <input type="submit" value="Delete" class="btn btn-danger btn-sm"> </form></div> ');
		}
	};
	</script>

@endsection

@section('content')
@if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
@endif

	<div class="container">
		<div class="row">
			<div  class="col-12">
				<form name="file" action="/p/image-upload/{{ $post->id }}"
			      class="dropzone"
			      id="my-dropzone" method="POST">{{ csrf_field() }}</form>
			 </div>
  		</div>

  		<div class="row pt-5" id="fuckimgs">
  			@foreach($post->images as $image)
  			<div class="col-sm-4 pt-5 pl-2"> 
  				<img style="width: 300px;" src="{{asset($image->image_path)}}">
  				 <form class="pl-5 pt-2" name = "delete-image" action="/p/delete-image/{{ $post->id }}/{{ $image->id }}" method="DELETE">
					{{ csrf_field() }}
					<input type="submit" value="Delete" class="btn btn-danger btn-sm">
				</form>
  			</div>
  			@endforeach
  		</div>
	</div>
	

	

@endsection