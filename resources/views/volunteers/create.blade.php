@extends('layouts.app')


@section('content')
@if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
@endif
<div class="container">

  <form action="/v" enctype="multipart/form-data" method="post">
    @csrf



       <div class="col-8 offset-2">
              <div class="form-group row pt-2">
                    <a href = "/profile/{{ auth()->user()->username }}" class="btn btn-secondary btn-sm"> Nazad na profil </a>    
              </div>
        </div>


              <div class="col-8 offset-2">
                    <div class="form-group row pt-2">
                          <label for="first_and_last_name" class="col-md-4 col-form-label text-md-right">{{ __('Ime i prezime volontera') }}</label>

                              <div class="col-md-6">
                                  <input id="first_and_last_name" type="text" class="form-control  @error('first_and_last_name') is-invalid @enderror" name="first_and_last_name" value="{{ old('first_and_last_name') }}" required autocomplete="first_and_last_name" autofocus>

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
                                <input  id="date_of_joining" type="date" class="form-control @error('date_of_joining') is-invalid @enderror" name="date_of_joining" value="{{ old('date_of_joining') }}" required autocomplete="date_of_joining" rows="10"> 


                                @error('date_of_joining')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            
                            </div>
                 </div>

                 <div class="form-group row">
                    <label for="date_of_born" class="col-md-4 col-form-label text-md-right">{{ __('Datum rođenja') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_born" type="date" class="form-control @error('date_of_born') is-invalid @enderror" name="date_of_born" value="{{ old('date_of_born') }}" required autocomplete="date_of_born" rows="10"> 


                                @error('date_of_born')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            
                            </div>
                 </div>

                  <div class="form-group row pt-2">
                    
                    <label for="jmbg" class="col-md-4 col-form-label text-md-right">{{ __('JMBG') }}</label>

                        <div class="col-md-6">
                            <input id="jmbg" type="text" class="form-control @error('jmbg') is-invalid @enderror" name="jmbg" value="{{ old('jmbg') }}" required autocomplete="jmbg" autofocus>

                            @error('jmbg')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      
                        </div>
                 </div>

                 <div class="form-group row pt-2">
                    
                    <label for="rank" class="col-md-4 col-form-label text-md-right">{{ __('Zvanje / Zanimanje') }}</label>

                        <div class="col-md-6">
                            <input id="rank" type="text" class="form-control @error('rank') is-invalid @enderror" name="rank" value="{{ old('rank') }}" required autocomplete="rank" autofocus>

                            @error('rank')
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
@section('scriptandlinks')


 @endsection