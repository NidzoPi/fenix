@extends('layouts.app')

@section('content')
<div class="container">

<form action="/p/{{ $post->id }}" enctype="multipart/form-data" method="post">
      @csrf
      @method('PATCH')
    <div class="col-8 offset-2">


              <div class="form-group row pt-2">
                    
                    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Naziv akcije / projekta') }}</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $post->title }}" required autocomplete="title" autofocus>

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
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? $post->description }}" required autocomplete="description" rows="10"> {{ $post->description }} </textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                 </div>

           <div class="form-group row">
                    <label for="startDate" class="col-md-4 col-form-label text-md-right">{{ __('Datum učlanjenja') }}</label>

                            <div class="col-md-6">
                                <input id="startDate" type="date"  class="form-control @error('startDate') is-invalid @enderror" name="startDate" value="{{ old('startDate') ?? $post->startDate }}" required autocomplete="startDate" rows="10"> 


                                @error('startDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror      
                            </div>
                 </div>

                 <div class="form-group row">
                    <label for="endDate" class="col-md-4 col-form-label text-md-right">{{ __('Datum završetka akcije') }}</label>

                            <div class="col-md-6">
                                <input id="endDate" type="date"  class="form-control @error('endDate') is-invalid @enderror" name="endDate" value="{{ old('endDate') ?? $post->endDate }}" required autocomplete="endDate" rows="10"> 


                                @error('endDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                 </div>
                 <div class="form-group row">
                    <label for="tags2" class="col-md-4 col-form-label text-md-right">{{ __('Trenutne kompetencije') }}</label>
                    <div class="tags" style="background-color: black; color: white; font-size: 12px; ">
                        @foreach($tags2 as $tag)
                            <p class="pl-2"> {{ $tag }}, </p>
                        @endforeach
                    </div>
                    <small class="pt-2" style="padding-left: 100px; color: red;"> Sve trenutne kompetencije će biti izbrisane izborom novih. U formi ispod izabrati sve potrebne!</small>
                </div>
                <div class="form-group row">
                    <label for="tags" class="col-md-4 col-form-label text-md-right">{{ __('Izaberi novu kompetenciju') }}</label>

                    <div class="col-md-6">

                        <select class="form-control js-example-basic-multiple"  name="tags[]" multiple="multiple" >

                        @foreach ($tags as $tag)

                            <option value="{{ $tag->id }}"> {{ $tag->name }} </option>

                        @endforeach
                            
                         </select>
                    </div>
                </div>

                  <div class="form-group row pt-2">
                    
                    <label for="place" class="col-md-4 col-form-label text-md-right">{{ __('Mjesto') }}</label>

                        <div class="col-md-6">
                            <input id="place" type="text" class="form-control @error('place') is-invalid @enderror" name="place" value="{{ old('place') ?? $post->place }}" required autocomplete="place" autofocus>

                            @error('place')
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
