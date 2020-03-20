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
	     				 @foreach ($hours as $h)   @if($volunteer->id == $h->volunteer_id) <?php $sumH+=$h->hours; ?>  @endif @endforeach {{$sumH}} </div>
                		</div>
              

        </div>
        <div class="col-3">

                <img src="/storage/{{ $volunteer->image }}" class="img-fluid rounded-circle w-100">

        </div>

        <div class="row pt-5">

            @foreach($rv as $v)
            <div class="col-4"> 
                <a href="/p/{{ $v->post_id }}">
                   <img src = "/storage/{{ $v->image }}" class="w-100 img-fluid">
                   <p> {{ $v->title }} </p>
                </a>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection


