@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-9" style="padding-left: 150px;">

                <div> <h1> @ {{ $volunteer->first_and_last_name}} </h1></div>
           

                <div class="d-flex pt-2">
                    <div class="pr-3"><strong> Datum učlanjenja u organizaciju: {{ $volunteer->created_at->format('d.m.Y') }}  </strong></div>
                </div>


               

          
                <div class="d-flex">
	            		<div> <?php $sumH = 0; ?> Ukupno volonterskih sati: 
	     				  {{$sum}} </div>
                		</div>
              

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
                        </div>
                    </a>
                </div>
            </div>
        @endforeach

        </div>
    </div>
</div>
@endsection


