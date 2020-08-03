@extends('layouts.app')

@section('content')
@php
$users = DB::table('users')->get();
$teachers = 0;
$students = 0;
foreach ($users as $user)
{
    if($user->isTeacher == 0) {
        $students++;
    } else {
        $teachers++;
    }
}
//2. felvonás
$taskCounter = 0;
$solutionCounter = 0;
$tasks = DB::table('tasks')->get();
$solutions = DB::table('solutions')->get();
foreach($tasks as $task) {
    $taskCounter++;
}
foreach($solutions as $sol) {
    $solutionCounter++;
}
@endphp
<script>
const navlink = document.getElementById('nav-1');
navlink.classList.add("active");
</script>
    <h1 class="cover-heading">Oktatási rendszer</h1>
    <p class="lead">
        Eddig <i>{{ $teachers }}</i> tanár <i>{{ $students }}</i> diák <i>{{ $taskCounter }}</i> feladat és <i>{{ $solutionCounter }}</i> megoldás szerepel a 
        rendszerünkben.
    </p>
    <p class="lead">
        <a href="/login" class="btn btn-lg btn-secondary">Bejelentkezés</a>
        <a href="/register" class="btn btn-lg btn-secondary">Regisztráció</a>
    </p>

    <h3 class="cover-heading">Alkalmazás tulajdonságai</h3>
    <p class="lead">
        Ebben az oktatási rendszerben kétféle felhasználó van: tanár és diák. Tanárként a következő lehetőségünk van:
        <ul>
            <li>új tárgyat létrehozni</li>
            <li>tárgy részleteit megtekinteni</li>
            <li>tárgyat meghirdetni</li>
            <li>tárgy meghirdetését visszavonni</li>
            <li>tárgyon belül új feladatot kiírni</li>
            <li>feladat részleteit megtekinteni</li>
            <li>a feladathoz tartozó megoldásokat megtekinteni</li>
            <li>a feladathoz tartozó megoldásokat értékelni</li>
        </ul>
    </p>
    <p class="lead">
        A diák a következő feladatokat végezheti el:
        <ul>
            <li>meghirdetett tárgyra feljelentkezni</li>
            <li>meghirdetett tárgyról lejelentkezni</li>
            <li>a tárgy részleteit megtekinteni</li>
            <li>a tárgyhoz kapcsolódó feladatokat megtekinteni</li>
            <li>a tárgyhoz kapcsolódó feladathoz megoldást beküldeni</li>
            <li>teljesítetlen feladatokat kilistázni</li>
        </ul>
    </p>
@endsection