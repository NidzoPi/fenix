@extends('layouts.app')

@section('content')
<div class="container">

  <form action="/v" enctype="multipart/form-data" method="post">
    @csrf
    <div class="col-8 offset-2">


              <div class="form-group row pt-2">
                    
                    <label for="first_and_last_name" class="col-md-4 col-form-label text-md-right">{{ __('Ime i prezime volontera') }}</label>

                        <div class="col-md-6">
                            <input id="first_and_last_name" type="text" class="form-control @error('first_and_last_name') is-invalid @enderror" name="first_and_last_name" value="{{ old('first_and_last_name') }}" required autocomplete="first_and_last_name" autofocus>

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      
                        </div>
                 </div>

                 <div class="form-group row">
                    <label for="date_of_joining" class="col-md-4 col-form-label text-md-right">{{ __('Datum učlanjenja') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_joining" type="date" value="01-12-2012" class="form-control @error('date_of_joining') is-invalid @enderror" name="date_of_joining" value="{{ old('date_of_joining') }}" required autocomplete="date_of_joining" rows="10"> 


                                @error('date_of_joining')
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
                    <button class="btn btn-primary btn-lg btn-block"> Kreiraj </button>
                 </div>
    </div>
</form>   



</div>
@endsection
