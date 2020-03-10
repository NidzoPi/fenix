@extends('layouts.app')

@section('content')
<div class="container">


<form action="/p" enctype="multipart/form-data" method="post">
    @csrf
    <div class="col-8 offset-2">


              <div class="form-group row pt-2">
                    
                    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Naziv akcije / projekta') }}</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                 </div>

                 <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Opis akcije / projekta') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" rows="10"> </textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                 </div>

                 <div class=" form-group row pt-4">
                    <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Slika') }}
                    </label>
                    <div class="col-md-6">
                        <input type="file" name="image" class="form-control-file" id="image">
                                    @error('image')
                                    @enderror
                    </div>
                 </div>

                 <div class="row pt-4">
                    <button class="btn btn-primary btn-lg btn-block"> Objavi </button>
                 </div>
    </div>
</form>   
</div>
@endsection
