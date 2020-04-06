@extends('layouts.app')

@section('content')
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


                <div class="pt-4"> {{ $user->profile->title }} </div>
                <div> {{ $user->profile->description }} </div>
                <div> <a href="https://www.facebook.com/okfenix"> {{ $user->profile->url ?? 'N/A' }} </a> </div>

                @can('update', $user->profile)
                <div class="d-flex">
                    <div class="pt-3"> <a href="/p/create"> Dodaj akciju </a> </div>
                    <div class="pt-3 pl-4"> <a href="/profile/{{ $user->id }}/edit"> Edituj profil </a> </div>
                    <div class="pt-3 pl-4"> <a href="/v/create"> Dodaj volontera </a> </div>
                     <div class="pt-3 pl-4"> <a href="/v/all"> Prikaži volontere </a> </div>
                </div>
                @endcan

        </div>
        <div class="col-3">

                <img src="{{ $user->profile->profileImage() }}" class="img-fluid rounded-circle w-100">

        </div>

        <div class="row pt-5">

            @foreach($postsHoursModel as $post)
            <div class="col-4 pt-3"> 
                <div class="hovereffect">
                    <a href="/p/{{ $post['pId'] }}">
                       <img class="img-responsive"  src = "/storage/{{ $post['pImage'] }}" class="w-100 img-fluid">
                       <div class="overlay">
                         <h2> {{ $post['pTitle'] }} </h2>
                         <p> {{ $post['sumPostHours'] }} </p>
                         <p> {{ $post['sumVolunteer'] }} </p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
