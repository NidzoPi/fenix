@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-9" style="padding-left: 150px;">

                <div> <h1> @ {{ $user->username}} </h1></div>
                <div class="d-flex">
                    <div class="pr-3"><strong> Broj članova: 27 </strong></div>
                    <div class="pr-3"><strong> Broj akcija: {{ $user->posts->count() }} </strong></div>
                    <div class="pr-3"><strong> Datum učlanjenja: {{ $user->created_at }}  </strong></div>
                </div>

                <div class="pt-4"> {{ $user->profile->title }} </div>
                <div> {{ $user->profile->description }} </div>
                <div> <a href="https://www.facebook.com/okfenix"> {{ $user->profile->url ?? 'N/A' }} </a> </div>

                <div class="pt-3"> <a href="/p/create"> Add Post </a> </div>
        </div>
        <div class="col-3">

                <img src="https://scontent.fbeg4-1.fna.fbcdn.net/v/t1.0-9/71209701_119529512772788_5338810469673074688_n.png?_nc_cat=109&_nc_sid=85a577&_nc_ohc=ktNzTeSfUoEAX9VKpIa&_nc_ht=scontent.fbeg4-1.fna&oh=7c929728b9a86025a90d699c68c13597&oe=5E94F2FB" class="img-fluid rounded-circle" height="300">

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
