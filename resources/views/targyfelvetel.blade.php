@extends('layouts.app')

@section('content')
<script>
const navlink = document.getElementById('nav-11');
navlink.classList.add("active");
</script>
<h1 class="cover-heading">Oktatási rendszer</h1>
    <h3 class="cover-heading">Tárgy felvételi oldal</h1>
    @php
    $userSubjects = Auth::user()->subjectIDs;
    $userID = Auth::user()->id;

    $toList = array();

    $allSubjects = App\Subject::all();
    $allSubjectIDs = array();
    foreach($allSubjects as $a) {
        //Így azokat a kurzusokat helyezzük előre, ahol még nincsen egyetlen hallgató sem.
        if(empty($a->studentIDs)) {
            array_push($toList, $a->id);
        } else {
            array_push($allSubjectIDs, $a->id);
        }
    }
    
    $mehet = true;
    foreach($allSubjectIDs as $aid) {
        foreach($userSubjects as $us) {
            if($us == $aid) {
                $mehet = false;
            }
        }
        if($mehet) {
            array_push($toList, $aid);
        }
    }

    @endphp
    <p class="lead">Az alábbi tárgyakat nem vetted fel eddig a rendszerünkben:</p>
        @foreach ($toList as $us)
            @php 
                $s = App\Subject::find($us);
            @endphp 
            <p class="lead">
                Tárgy neve: {{ $s->name }}<br>
                Leírása: {{ $s->description }}<br>
                Tantárgyi kód: {{ $s->code }}<br>
                Kreditérték: {{ $s->credit }}<br>
                Tanár neve: {{ App\User::find($s->teacherID)->name }}<br>
                <form action="{{ url('/felvesz') }}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="studentID" value="{{ $userID }}">
                    <input type="hidden" name="subjectID" value="{{ $s->id }}">
                    <input type="submit" value="Felvesz" class="btn btn-primary">
                </form>
            </p>
        @endforeach
@endsection