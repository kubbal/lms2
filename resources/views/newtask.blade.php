@extends('layouts.app')

@section('content')
<h1 class="cover-heading">Oktatási rendszer</h1>
    <h3 class="cover-heading">Új feladat</h1>

    <form action="{{ url('/newtask/create') }}" method="post">
        @csrf
        <div class="form-group row">
            <label for="name"  class="col-md-4 col-form-label text-md-right">{{ __('Név') }}</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="description"  class="col-md-4 col-form-label text-md-right">{{ __('Leírás') }}</label>
            <div class="col-md-6">
                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="score"  class="col-md-4 col-form-label text-md-right">{{ __('Pontérték') }}</label>
            <div class="col-md-6">
                <input id="score" type="text" class="form-control @error('score') is-invalid @enderror" name="score" value="{{ old('score') }}" required autocomplete="score" autofocus>
                @error('score')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="begin"  class="col-md-4 col-form-label text-md-right">{{ __('Mettől') }}</label>
            <div class="col-md-6">
                <input id="begin" type="datetime-local" class="form-control @error('begin') is-invalid @enderror" name="begin" value="{{ old('begin') }}" required autocomplete="begin" autofocus>
                @error('begin')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="end"  class="col-md-4 col-form-label text-md-right">{{ __('Meddig') }}</label>
            <div class="col-md-6">
                <input id="end" type="datetime-local" class="form-control @error('end') is-invalid @enderror" name="end" value="{{ old('end') }}" required autocomplete="end" autofocus>
                @error('end')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <input type="hidden" name="subid" value="{{ $subid }}">

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-6">
                <button type="submit" class="btn btn-primary">
                    {{ __('Kész') }}
                </button>
            </div>
        </div>
    </form>
@endsection