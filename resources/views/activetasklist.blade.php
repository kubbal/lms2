@extends('layouts.app')

@section('content')
<script>
const navlink = document.getElementById('nav-12');
navlink.classList.add("active");
</script>
@php
$now = date('Y-m-d H:i:s');
$tasks = App\Task::where([
    ['begin', '>=', $now],
    ['end', '<', $now]
])->orderBy('subjectID', 'DESC')->get();
$tasks = App\Task::orderBy('subjectID', 'DESC')->get();
@endphp
<h1 class="cover-heading">Oktatási rendszer</h1>
    <h3 class="cover-heading">Aktív feladatok listája</h3>
    @php/*
    var_dump($tasks);*/
    @endphp


    @foreach ($tasks as $task)
    @php
    $ja = false;
    if(!isset($elozo)) {
        $ja = true;
        echo "<ul>".App\Subject::find($task->subjectID)->name;
    }
    else if($elozo == null || $elozo != $task->subjectID) {
        echo "<ul>".App\Subject::find($task->subjectID)->name;
        $ja = true;
    }
    @endphp
    
    
        <li><a href='{{ url("/tasks/{$task->id}") }}'>{{ $task->name }}</a></li>
    
    @php
    $elozo = $task->subjectID;
    if($ja) {
        echo "</ul>";
        $ja = false;
    }
    @endphp
    @endforeach
@endsection