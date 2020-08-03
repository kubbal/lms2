@extends('layouts.app')

@section('content')
<script>
const navlink = document.getElementById('nav-8');
navlink.classList.add("active");
</script>
<h1 class="cover-heading">Oktatási rendszer</h1>
    <h3 class="cover-heading">Tanári főoldal</h1>
    @php
    $userSubjects = Auth::user()->subjectIDs;
    $subjects = App\Subject::all();
    @endphp
    <p class="lead">Az alábbi tárgyakat vetted fel eddig rendszerünkbe:</p>
        @foreach ($subjects as $s)
            @if($s->teacherID == Auth::user()->id)
                <p class="lead">
                    Tárgy neve: <a href="/subjects/{{$s->id}}" style="color: yellow;">{{ $s->name }}</a><br>
                    Leírása: {{ $s->description }}<br>
                    Tantárgyi kód: {{ $s->code }}<br>
                    Kreditérték: {{ $s->credit }}<br>
                    @if ($s->published == 0)
                    <form action="{{ url('/publish') }}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="published" value="1">
                        <input type="hidden" name="id" value="{{ $s->id }}">
                        <input type="submit" value="Publikál" class="btn btn-primary">
                    </form>
                    <br>
                    @else
                    <form action="{{ action('SubjectController@publish') }}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="published" value="0">
                        <input type="hidden" name="id" value="{{ $s->id }}">
                        <input type="submit" value="Publikálás visszavonása" class="btn btn-danger">
                    </form>
                    <br>
                </p>
                    @endif
            @endif
        @endforeach
@endsection