@extends('layouts.app')

@section('content')
@if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
@elseif(Session::has('error'))
    <div class="alert alert-danger">
          {{Session::get('error')}}
    </div>
@endif
<div class="container">


<form action="/h" enctype="multipart/form-data" method="post">
    @csrf
    <div class="col-8 offset-2">



              <div class="form-group row pt-2">


                        <div class="col-md-6">
                            <input hidden="" id="post_id" type="text" class="form-control @error('post_id') is-invalid @enderror" name="post_id" value="{{ $post->id }}" required autocomplete="title" autofocus>

                            @error('post_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                 </div>

            <div class="form-group row pt-2">

                <div class="input-group mb-3">
                    <label for="volunteer_id" class="col-md-4 col-form-label text-md-right">{{ __('Izaberi volontera') }}</label>
                      <select class="custom-select" id="volunteer_id" name="volunteer_id">
                        <option selected>Izaberi...</option>
                        @foreach(auth()->user()->volunteers as $v)
                            <option value="{{$v->id}}"> {{ $v->first_and_last_name  }} </option>
                        @endforeach
                      </select>
                      <div class="input-group-append">
                        <label class="input-group-text" for="volunteer_id">Opcije</label>
                      </div>
                </div>
            </div>


              <div class="form-group row pt-2">

                <label for="hours" class="col-md-4 col-form-label text-md-right">{{ __('Broj sati angažovanja volontera') }}</label>

                        <div class="col-md-6">
                            <input id="hours" type="number" class="form-control @error('hours') is-invalid @enderror" name="hours" value="" required autocomplete="title" autofocus>

                            @error('hours')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                 </div>
                 <hr>
                <div class="row pt-4">
                    <button class="btn btn-primary btn-lg btn-block"> Dodaj </button>
                 </div>

    </div>
</form>   
</div>





@endsection
