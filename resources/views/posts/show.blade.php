@extends('layouts.app')

@section('scriptandlinks')


<script>
$(document).ready(function(){

  $("#show").click(function(){
    $("#tableView").toggle(500);
  });

});
</script>

<script>
  let modalId = $('#image-gallery');

$(document)
  .ready(function () {

    loadGallery(true, 'a.thumbnail');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current) {
      $('#show-previous-image, #show-next-image')
        .show();
      if (counter_max === counter_current) {
        $('#show-next-image')
          .hide();
      } else if (counter_current === 1) {
        $('#show-previous-image')
          .hide();
      }
    }

    /**
     *
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */

    function loadGallery(setIDs, setClickAttr) {
      let current_image,
        selector,
        counter = 0;

      $('#show-next-image, #show-previous-image')
        .click(function () {
          if ($(this)
            .attr('id') === 'show-previous-image') {
            current_image--;
          } else {
            current_image++;
          }

          selector = $('[data-image-id="' + current_image + '"]');
          updateGallery(selector);
        });

      function updateGallery(selector) {
        let $sel = selector;
        current_image = $sel.data('image-id');
        $('#image-gallery-title')
          .text($sel.data('title'));
        $('#image-gallery-image')
          .attr('src', $sel.data('image'));
        disableButtons(counter, $sel.data('image-id'));
      }

      if (setIDs == true) {
        $('[data-image-id]')
          .each(function () {
            counter++;
            $(this)
              .attr('data-image-id', counter);
          });
      }
      $(setClickAttr)
        .on('click', function () {
          updateGallery($(this));
        });
    }
  });

// build key actions
$(document)
  .keydown(function (e) {
    switch (e.which) {
      case 37: // left
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
          $('#show-previous-image')
            .click();
        }
        break;

      case 39: // right
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
          $('#show-next-image')
            .click();
        }
        break;

      default:
        return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
  });
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

    <div class="col-sm-6">
    	<div>

      		<div class="d-flex align-items-center">
        			<div>
        				<img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 50px;">
        			</div>
        			<div class="pl-3">
        				<h5> <a href="/profile/{{ $post->user->username }}"> @ {{ $post->user->username }} </a> </h5>
        			</div>
     		  </div>


      <div class="d-flex align-items-center pt-3">
            <div> <h6> <b> {{ $post->title }} </b> </h6> </div>
            <div class="pl-5"></div>
            <div class="pl-5"> </div>
      @can ('update', $post)
          <div class="pl-5 pb-2"> <a class="btn btn-primary btn-sm" href="/p/{{ $post->id }}/edit"> Edituj akciju </a></div>
           <div class="pl-5 pb-2">    
              <form action="/p/delete/{{ $post->id }}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-outline-danger btn-sm">Obriši akciju</button>
              </form>
            </div>
      @endcan
      </div>

      <div class="d-flex align-items-center">
        <div>  {{ $post->place }}  </div>
      </div>
           
     		 <hr>


     		 <div class="pt-1">
        		<p align="justify" style="text-indent: 30px;"> {{ $post->description }}</p>
        	</div>

    	</div>
    </div>

    <div class="col-sm-6">
      <div> <img src="/storage/{{ $post->image }} " class="w-100" /> </div>
    <div class="d-flex"> 
    @foreach($post->images as $image)
      <div class="thumb pl-1">
        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
        data-image="{{ asset($image->image_path) }}"
        data-target="#image-gallery">

              <img style="width: 100px;" class="img-thumbnail" src="{{ asset($image->image_path) }}" alt="Another alt text">
        </a>
      </div>
      @endforeach
    </div>
           <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="image-gallery-title"></h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                        </button>

                        <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
              </div>
            </div>


      <div class="pt-2"> @foreach($post->tags as $tag)<button type="button" class="btn btn-pill btn-info btn-sm"> {{ $tag->name }} </button>  @endforeach</div>

    </div>


  </div>

  <div class="row pt-5">
    <div class="col-12 d-flex">
      <div> <button id="show" type="submit" class="btn btn-outline-primary btn-sm">Ko je učestvovao? </button> </div>
      <div class="pl-5"> <a href="/{{$post->id}}/h/create"> Dodaj učešće </a> </div>
      @can ('update', $post)
         <div  class="pl-5 pb-2"> <a href="/p/image-upload/{{ $post->id }}"> Dodaj slika </a></div>
      @endcan
    </div>
  </div>
  <hr>

  <div class="row"  id="tableView" style="display: none;"> 
      <table class="table">
          <thead class="thead-dark">
                <tr>
                  <th scope="col">Br.</th>
                  <th scope="col">Organizacija</th>
                  <th scope="col">Ime i prezime</th>
                  <th scope="col">Broj sati</th>
                  @can ('update', $post)
                   <th scope="col">#</th>
                  @endcan
                </tr>
             <tbody>
               <?php $br=1; ?>
                @foreach($models as $m)
                <tr>
                   <th scope="row"> {{ $br++ }}. </th>
                   <td> <img style="width: 30px;" src="/storage/{{$m['userImage'] ?? '/profile/noimage.jpg'}}"> {{$m['user']}}  </td>
                   <td>  {{ $m['volunteer']->first_and_last_name }}  </td>  
                   <td> {{ $m['sum']}}  </td>
                   <td> 
                    @can ('update', $post)
                        <form action="/h/delete/{{ $m['hours']->id }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-outline-danger btn-sm">Obriši</button>
                        </form> 
                    @endcan   
                    </td>

                  </tr>
                @endforeach
            </tbody>
         </thead>
      </table>
  </div>

</div>


@endsection

