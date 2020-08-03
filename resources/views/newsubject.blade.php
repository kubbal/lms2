@extends('layouts.app')

@section('content')
<script>
const navlink = document.getElementById('nav-9');
navlink.classList.add("active");
</script>
<h1 class="cover-heading">Oktatási rendszer</h1>
    <h3 class="cover-heading">Új tárgy meghirdetése</h1>

    <form action="{{ url('/newsubject/create') }}" method="post">
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
            <label for="code"  class="col-md-4 col-form-label text-md-right">{{ __('Tantárgyi kód') }}</label>
            <div class="col-md-6">
                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus>
                @error('code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="credit"  class="col-md-4 col-form-label text-md-right">{{ __('Kreditérték') }}</label>
            <div class="col-md-6">
                <input id="credit" type="text" class="form-control @error('credit') is-invalid @enderror" name="credit" value="{{ old('credit') }}" required autocomplete="credit" autofocus>
                @error('credit')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-6">
                <button type="submit" class="btn btn-primary">
                    {{ __('Kész') }}
                </button>
            </div>
        </div>
    </form>
@endsection