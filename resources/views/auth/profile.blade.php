@extends('layouts.app')

@section('content')
<script>
const navlink = document.getElementById('nav-5');
navlink.classList.add("active");
</script>
<h1 class="cover-heading">Profil</h1>
<p class="lead">
    Neved: {{ Auth::user()->name }} <br>
    E-mail címed: {{ Auth::user()->email }} <br>
    @if(Auth::user()->isTeacher == 0)
    Szereped: Diák
    @else
    Szereped: Tanár
    @endif
</p>
@endsection
