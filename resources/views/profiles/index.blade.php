@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-9" style="padding-left: 150px;">

                <div> <h1> @ {{ $user->username}} </h1></div>
                <div class="d-flex">
                    <div class="pr-3"><strong> Broj članova: 27 </strong></div>
                    <div class="pr-3"><strong> Broj akcija: {{ $user->posts->count() }} </strong></div>
                    <div class="pr-3"><strong> Datum učlanjenja: {{ $user->created_at->format('d.m.Y') }}  </strong></div>
                </div>

                <div class="pt-4"> {{ $user->profile->title }} </div>
                <div> {{ $user->profile->description }} </div>
                <div> <a href="https://www.facebook.com/okfenix"> {{ $user->profile->url ?? 'N/A' }} </a> </div>

                @can('update', $user->profile)
                <div class="d-flex">
                    <div class="pt-3"> <a href="/p/create"> Add Post </a> </div>
                    <div class="pt-3 pl-3"> <a href="/profile/{{ $user->id }}/edit"> Edit Profile </a> </div>
                </div>
                @endcan

        </div>
        <div class="col-3">

                <img src="{{ $user->profile->profileImage() }}" class="img-fluid rounded-circle w-100">

        </div>

        <div class="row pt-5">

            @foreach($user->posts as $post)
            <div class="col-4"> 
                <a href="/p/{{ $post->id }}">
                   <img src = "/storage/{{ $post->image }}" class="w-100">
                </a>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
