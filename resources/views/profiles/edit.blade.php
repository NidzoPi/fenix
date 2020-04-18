@extends('layouts.app')

@section('content')
<div class="container">

<form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="post">
    @csrf
    @method('PATCH')

    <div class="col-8 offset-2">


              <div class="form-group row pt-2">
                    
                    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Organizacija') }}</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $user->profile->title }}" required autocomplete="title" autofocus>

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                 </div>

                 <div class="form-group row">
                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Adresa') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') ?? $user->profile->address }}" required autocomplete="address" rows="10"> 

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                 </div>

                 <div class="form-group row">
                    <label for="place" class="col-md-4 col-form-label text-md-right">{{ __('Mjesto') }}</label>

                            <div class="col-md-6">
                                <input id="place" type="text" class="form-control @error('place') is-invalid @enderror" name="place" value="{{ old('place') ?? $user->profile->place }}" required autocomplete="place" rows="10"> 

                                @error('place')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                 </div>

                    <div class="form-group row">
                    <label for="fbUrl" class="col-md-4 col-form-label text-md-right">{{ __('Facebook link') }}</label>

                            <div class="col-md-6">
                                <input id="fbUrl" type="text" class="form-control @error('fbUrl') is-invalid @enderror" name="fbUrl" value="{{ old('fbUrl') ??  $user->profile->fbUrl }}"  autocomplete="fbUrl" rows="10" placeholder="Opciono"> 

                                @error('fbUrl')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                 </div>

                    <div class="form-group row">
                    <label for="ytUrl" class="col-md-4 col-form-label text-md-right">{{ __('Youtube link') }}</label>

                            <div class="col-md-6">
                                <input id="ytUrl" type="text" class="form-control @error('ytUrl') is-invalid @enderror" name="ytUrl" value="{{ old('ytUrl') ??  $user->profile->ytUrl }}"  autocomplete="ytUrl" rows="10" placeholder="Opciono"> 

                                @error('ytUrl')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                 </div>

                 <div class="form-group row">
                    <label for="president" class="col-md-4 col-form-label text-md-right">{{ __('Ime i prezime predsjednika') }}</label>

                            <div class="col-md-6">
                                <input id="president" type="text" class="form-control @error('president') is-invalid @enderror" name="president" value="{{ old('president') ??  $user->profile->president }}" required autocomplete="president" rows="10"> 

                                @error('president')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                 </div>

                 <div class="form-group row">
                    <label for="tNumber" class="col-md-4 col-form-label text-md-right">{{ __('Broj telefona') }}</label>

                            <div class="col-md-6">
                                <input id="tNumber" type="text" class="form-control @error('tNumber') is-invalid @enderror" name="tNumber" value="{{ old('tNumber') ??  $user->profile->tNumber }}" required autocomplete="tNumber" rows="10"> 

                                @error('tNumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                 </div>



                 <div class=" form-group row pt-4">
                    <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Slika profila') }}
                    </label>
                    <div class="col-md-6">
                        <input type="file" name="image" class="form-control-file" id="image">
                                    @error('image')
                                    @enderror
                    </div>
                 </div>

                 <div class="row pt-4">
                    <button class="btn btn-primary btn-lg btn-block"> Sačuvaj </button>
                 </div>
        </div>
</form>   
</div>
@endsection
