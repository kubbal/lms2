@extends('layouts.app')

@section('content')
<script>
const navlink = document.getElementById('nav-10');
navlink.classList.add("active");
</script>
<h1 class="cover-heading">Oktatási rendszer</h1>
    <h3 class="cover-heading">Diák főoldal</h1>
    @php
    $userSubjects = Auth::user()->subjectIDs;
    $userID = Auth::user()->id;
    @endphp
    <p class="lead">Az alábbi tárgyakat vetted fel eddig a rendszerünkben:</p>
        @foreach ($userSubjects as $us)
            @php 
                $s = App\Subject::find($us);
            @endphp 
            <p class="lead">
                Tárgy neve: <a href="/subjects/{{$s->id}}" style="color: yellow;">{{ $s->name }}</a><br>
                Leírása: {{ $s->description }}<br>
                Tantárgyi kód: {{ $s->code }}<br>
                Kreditérték: {{ $s->credit }}<br>
                Tanár neve: {{ App\User::find($s->teacherID)->name }}<br>
                <form action="{{ url('/lead') }}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="studentID" value="{{ $userID }}">
                    <input type="hidden" name="subjectID" value="{{ $s->id }}">
                    <input type="submit" value="Lead" class="btn btn-danger">
                </form>
            </p>
        @endforeach
@endsection