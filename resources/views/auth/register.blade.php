@extends('layouts.app')

@section('content')
<script>
const navlink = document.getElementById('nav-4');
navlink.classList.add("active");
</script>
<h1 class="cover-heading">Regisztrációs űrlap</h1>
<form action="{{ route('register') }}" method="post">
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
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail cím') }}</label>

        <div class="col-md-6">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                 </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Jelszó') }}</label>

        <div class="col-md-6">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Jelszó újra') }}</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
    </div>

    <div class="form-group row">
        <label for="role" class="col-md-4 col-form-label text-md-right">Szerep</label>
        
        <div class="col-md-6">
            <input type="radio" id="isTeacher" name="isTeacher" value="0">
            <label for="s">Diák</label>
            <input type="radio" id="isTeacher" name="isTeacher" value="1">
            <label for="t">Tanár</label>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Regisztrálok') }}
            </button>
        </div>
    </div>
</form>
@endsection
