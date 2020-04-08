@extends('layouts.app')

@section('scriptandlinks')
<script>
$(document).ready(function(){

  $("#show").click(function(){
    $("#tableView").toggle(500);
  });

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
        				<h5> <a href="/profile/{{ $post->user->id }}"> @ {{ $post->user->username }} </a> </h5>
        			</div>
     		  </div>


      <div class="d-flex align-items-center pt-3">
            <div> <h6> <b> {{ $post->title }} </b> </h6> </div>
            <div class="pl-5"></div>
            <div class="pl-5"> </div>
      @can ('update', $post)
          <div class="pl-5 pb-2"> <a class="btn btn-primary btn-sm" href="/p/{{ $post->id }}/edit"> Edituj akciju </a></div>
      @endcan
      </div>

           
     		 <hr>


     		 <div class="pt-1">
        		<p> {{ $post->description }}</p>
        	</div>

    	</div>
    </div>

    <div class="col-sm-6">
      <img src="/storage/{{ $post->image }} " class="w-100" />
    </div>


  </div>

  <div class="row">
    <div class="col-12 d-flex">
      <div> <button id="show" type="submit" class="btn btn-outline-primary btn-sm">Ko je učestvovao? </button> </div>
      <div class="pl-5"> <a href="/{{$post->id}}/h/create"> Dodaj volontera </a> </div>
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
                        <form action="/h/delete/{{ $m['hours']->id }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                        </form> 
                    </td>

                  </tr>
                @endforeach
            </tbody>
         </thead>
      </table>


  </div>

</div>

@endsection
