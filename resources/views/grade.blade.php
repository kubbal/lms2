@extends('layouts.app')

@section('content')
<h1 class="cover-heading">Oktatási rendszer</h1>
    <h3 class="cover-heading">Megoldás értékelése</h3>
    <p class="lead">
        <details>
            <summary>Feladat szövege</summary>
            <p>{{ App\Task::find($solution->taskID)->description }}</p>
        </details>
        <br>
        <h5 class="cover-heading">Megoldás</h5>
        {{ $solution->solution }} <br>
        <br>
        @if($solution->filename != null)
        <a href="/download/{{$solution->filename}}" class="btn btn-primary">Beadott fájl letöltése</a>
        @endif
        <h5 class="cover-heading">Értékelés</h5>
        <form action='{{ url("/grade/update/{$solution->id}") }}' method="post">
        @csrf
        <input type="number" name="grade" id="grade" min="0" max="{{App\Task::find($solution->taskID)->score}}" placeholder="Jegy/pontszám"
        class="form-control @error('grade') is-invalid @enderror">
        @error('grade')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror <br><br>
        <textarea name="notes" id="notes" cols="30" rows="10" placeholder="Szöveges megjegyzés..."></textarea> <br>
        <input type="submit" value="Értékel">
        </form>
    </p>
@endsection