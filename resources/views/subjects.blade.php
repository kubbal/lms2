@extends('layouts.app')

@section('content')
<h1 class="cover-heading">Oktatási rendszer</h1>
    <h3 class="cover-heading">Tárgy részletei</h3>
    <p class="lead">
        Tárgy neve: {{ $subject->name }}
    </p>
    <p class="lead">
        Tárgy leírása: {{ $subject->description }}
    </p>
    <p class="lead">
        Tárgy kódja: {{ $subject->code }}
    </p>
    <p class="lead">
        Kreditértéke: {{ $subject->credit }}
    </p>
    @if(Auth::user()->isTeacher == 1)
    <p class="lead">
        <a href="/newsubject/edit/{{ $subject->id }}" class = "btn btn-success">Szerkeszt</a>
    </p>
    <p class="lead">
        <form action="{{ url('/softdel') }}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="subID" value="{{ $subject->id }}">
            <input type="submit" value="Töröl" class="btn btn-danger">
        </form>
    </p>
    <p class="lead">
        <form action="{{ url('/newtask') }}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="subid" value="{{ $subject->id }}">
            <input type="submit" value="Új feladat" class="btn btn-primary">
        </form>
    </p>
    @else
    <p class="lead">
        Tanár neve: {{ App\User::find($subject->teacherID)->name }}
    </p>
    <p class="lead">
        Tanár e-mail címe: {{ App\User::find($subject->teacherID)->email }}
    </p>
    @endif
    <p class="lead">
        Létrehozás dátuma: {{ $subject->created_at }}
    </p>
    <p class="lead">
        Utolsó módosítás dátuma: {{ $subject->updated_at }}
    </p>
    <p class="lead">
        Jelentkezett hallgatók száma: {{ count($subject->studentIDs) }}
    </p>
    @foreach ($subject->studentIDs as $i)
    <ul>
        @php
        $s = App\User::findOrFail($i);
        echo "<li> $s->name </li>";
        echo "<li> $s->email </li>";
        @endphp
    </ul>
    @endforeach

    @php
    $tasks = DB::table('tasks')->orderBy('end', 'DESC')->get();
    $counter = 1;
    $now = date('Y-m-d H:i:s');
    @endphp
    <h3 class="cover-heading">Feladatok</h3>
    <p class="lead">
    @php
    $user = Auth::user();
    @endphp
    @if ($user->isTeacher == 1)
    <span style='color: green'>Lejárt</span>, <span style='color: yellow'>Folyamatban</span>, <span style='color: red'>Később lesz</span><br>
    @endif
    <table class="table table-dark">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Név</th>
            <th scope="col">Pontszám</th>
            <th scope="col">Elérhető ettől</th>
            <th scope="col">Elérhető eddig</th>
            @if($user->isTeacher == 0)
            <th scope="col">Beadva</th>
            @endif
            </tr>
        </thead>
        <tbody>
        @foreach ($tasks as $task)
        @if($task->subjectID == $subject->id)
            @if ($user->isTeacher == 1)
                @if ($now < $task->begin)
                    <tr style='background-color: red;'>
                @elseif($now >= $task->begin & $now < $task->end)
                    <tr style='background-color: yellow;'>
                @elseif($now >= $task->end)
                    <tr style='background-color: green;'>
                @endif
            @else
                @if ($now >= $task->begin & $now < $task->end)
                    <tr>
                @endif
            @endif
            
                <th scope="row">{{ $counter }}</th>
                <td><a href="/tasks/{{$task->id}}" style="color:black;">{{ $task->name }}</a></td>
                <td>{{ $task->score }}</td>
                <td>{{ $task->begin }}</td>
                <td>{{ $task->end }}</td>
                @if ($user->isTeacher == 0)
                <td>
                    @php 
                    $solution = App\Solution::where([['userID', '=', $user->id], ['taskID', '=', $task->id]])->first();
                    echo $solution == null ? "Nem" : "Igen";
                    @endphp
                </td>
                @endif
            </tr>
        @endif
        @php
        $counter++;
        @endphp
        @endforeach
        </tbody>
    </table>
    </p>
@endsection