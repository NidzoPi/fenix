@extends('layouts.app')

@section('content')
@if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
@endif
<div class="container">
    <div class="row">
        <div class="col-9">

                <div class="d-flex"> 
                   <div> <h1> @ {{ $volunteer->first_and_last_name}} </h1> </div> 
                   <div class="pt-2 pl-3"> <h5> ({{ $volunteer->rank }}) </h5> </div> 
                </div>
           

                <div class="d-flex pt-2">
                    <div class="pr-3"><strong> Datum učlanjenja u organizaciju: {{ date('d.m.Y', strtotime($volunteer->date_of_joining)) }}  </strong></div>
                </div>

                 <div class="d-flex">
                    <div class="pr-3">Datum rođenja: {{ date('d.m.Y', strtotime($volunteer->date_of_born)) }} </div>
                </div>
          
                <div class="d-flex pt-2">
	            		<div>  Ukupno volonterskih sati: 
	     				  {{$sum}} </div>
                </div>

                 <div class="d-flex pt-2">
                        <div> <small>  JMBG:  {{ $volunteer->jmbg }} </small> </div>
                </div>

                @can ('update', $volunteer)        
                
                <div class="d-flex pt-3"> 
                    <div> <a class="btn btn-outline-primary" href="/v/{{ $volunteer->id }}/edit"> Edituj profil </a> </div>
                    <div class="pl-5">    
                        <form action="/v/delete/{{ $volunteer->id }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-outline-danger">Obriši profil volontera</button>
                        </form>
                    </div>
                </div>

                @endcan
                

        </div>
        <div class="col-3">

                <img src="/storage/{{ $volunteer->image }}" class="img-fluid rounded-circle w-100">

        </div>

        <div class="row pt-5">

        @foreach($models as $m)
            <div class="col-4 pt-3"> 
                <div class="hovereffect">
                    <a href="/p/{{ $m['post']->id}}">
                       <img class="img-responsive" src = "/storage/{{ $m['post']->image }}" class="w-100 img-fluid">
                       <div class="overlay">
                         <h2> {{ $m['post']->title }} </h2>
                         <div style="background-color: black; color: white;"> <h3> {{ $m['hours'] }}h </h3> </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
@endsection


