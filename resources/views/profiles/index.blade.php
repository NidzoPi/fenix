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

                <div> <h1> @ {{ $user->username}} </h1></div>
                <div class="d-flex">
                    <div class="pr-3"><strong>  Članova: {{ $user->volunteers->count() }} </strong></div>
                    <div class="pr-3"><strong>  Akcija: {{ $user->posts->count() }} </strong></div>
                    <div class="pr-3"><strong>  Volonterskih sati: {{ $sumHours }} </strong></div>
                </div>

                <div class="d-flex pt-2">
                    <div class="pr-3"><strong> Datum učlanjenja: {{ $user->created_at->format('d.m.Y') }}  </strong></div>
                </div>

        @if($user->profile->president)
            <div class="d-flex pt-4">
                <div class=""> {{ $user->profile->president }}, </div>
                <div class="pl-3"> {{ $user->profile->tNumber }} </div>
            </div>
        @endif

        
        @if($user->profile->address &&  $user->profile->place  )
                <div> {{ $user->profile->address }}, {{ $user->profile->place }} </div>
        @endif

      
                <div class="d-flex pt-4">
                    <div> <a href="{{ $user->profile->fbUrl ?? '#' }}" target="_blank"> <img style="width: 30px;" src="/storage/logo/fb.png">  </a> </div>
                    <div class="pl-2"> <a href="{{ $user->profile->ytUrl ?? '#' }}" target="_blank"> <img style="width: 30px; height: 30px;" src="/storage/logo/yt.png">  </a>  </div>
                </div>
        

        @can('update', $user->profile)
                <div class="d-flex pt-3">
                    <div class="pt-3 pr-2"> <a class="btn btn-outline-primary" href="/p/create"> Dodaj akciju </a> </div>
                    <div class="pt-3 pr-2"> <a class="btn btn-outline-primary" href="/profile/{{ $user->id }}/edit"> Edituj profil </a> </div>
                    <div class="pt-3 pr-2"> <a class="btn btn-outline-primary" href="/v/create"> Dodaj volontera </a> </div>
                     <div class="pt-3"> <a class="btn btn-outline-primary" href="/v/all"> Prikaži volontere </a> </div>
                </div>
        @endcan

        </div>

        <div class="col-3">
                <img src="{{ $user->profile->profileImage() }}" class="img-fluid rounded-circle w-100">
        </div>

        <div class="row pt-5 pl-4" style="width: 100%;">

            @foreach($postsHoursModel as $post)
            <div class="col-sm-4 pt-3"> 
                <div class="hovereffect">
                    <a href="/p/{{ $post['pSlug'] }}">
                       <img class="img-responsive"  src = "/storage/{{ $post['pImage'] }}">
                       <div class="overlay">
                         <h2> {{ $post['pTitle'] }} </h2>
                         <div class="d-flex justify-content-center" style="background-color: white;">
                             <div class="d-flex pt-2">  <img id="overlayImage" src="/storage/logo/icon-time.png"> <h3 style="color: black;"> {{ $post['sumPostHours'] }} </h3> </div>
                             <div class="d-flex pl-5 pt-2"> <img id="overlayImage" src="/storage/volunteers/volunteer.png"> <h3 style="color: black;"> {{ $post['sumVolunteer'] }} </h3>
                         </div>
                        </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
