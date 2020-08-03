@extends('layouts.app')

@section('content')
@php
$subject = App\Subject::find($task->subjectID);
$teacher = App\User::find($subject->teacherID);
$numOfGradedSolutions = 0;
@endphp
<h1 class="cover-heading">Oktatási rendszer</h1>
    <h3 class="cover-heading">Feladat részletei</h1>
    @if (Auth::user()->isTeacher == 1)
    <!-- Tanár -->
    <p class="lead">
        Név: {{ $task->name }}
    </p>
    <p class="lead">
        Leírás: {{ $task->description }}
    </p>
    <p class="lead">
        Pontérték: {{ $task->score }}
    </p>
    <p class="lead">
        Mettől: {{ $task->begin }}
    </p>
    <p class="lead">
        Meddig: {{ $task->end }}
    </p>
    <p class="lead">
        Beadott megoldások száma: {{ count($task->solutionIDs) }}
    </p>
    <p class="lead">
        Értékelt megoldások száma: {{ $numOfGradedSolutions }}
    </p>
    <p class="lead">
        <table class="table table-dark">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Név</th>
                <th scope="col">E-mail cím</th>
                <th scope="col">Beadás dátuma</th>
                <th scope="col">Értékelés</th>
                <th scope="col">Értékelés időpontja</th>
                </tr>
            </thead>
            <tbody>
            @php
            $allSolutions = App\Solution::where('taskID', '=', $task->id)->get();
            $counter = 0;
            foreach($allSolutions as $s) {
                $counter++;
                echo "<tr>";
                if($s->grade == null) {
                    echo "<th scope='row'>".$counter."</th>";
                } else {
                    echo "<th scope='row' style='background-color:green'>".$counter."</th>";
                }
                echo "<td>" . App\User::find($s->userID)->name . "</td>";
                echo "<td>" . App\User::find($s->userID)->email . "</td>";
                echo "<td>" . $s->created_at . "</td>";
                if($s->grade == null) {
                    echo "<td>" . "<a href='/grade/{$s->id}' class='btn btn-secondary'>Értékel</a>" . "</td>";
                    echo "<td>" . "-" . "</td>";
                } else {
                    echo "<td>" . $s->grade . "</td>";
                    echo "<td>" . $s->updated_at . "</td>";
                }
                echo "</tr>";
            }
            @endphp
            </tbody>
        </table>
    </p>
    
    <a href="/tasks/edit/{{$task->id}}" class="btn btn-primary">Feladat módosítása</a>
    @else
    <!-- Diák -->
    <p class="lead">
    Tárgy neve: {{ $subject->name }}
    </p>
    <p class="lead">
    Tanár neve: {{ $teacher->name }}
    </p>
    <details>
        <summary>Feladat leírása</summary>
        <p>{{ $task->description }}</p>
    </details>
    <p class="lead">
    Feladat pontszáma: {{ $task->score }}
    </p>
    <p class="lead">
    Határidő: {{ $task->begin }} - {{ $task->end }}
    </p>
    <p class="lead">
    Beadva: 
    @php 
    $solution = App\Solution::where([['userID', '=', Auth::user()->id], ['taskID', '=', $task->id]])->first(); 
    echo $solution != null ? "<span style='color: green'>Igen</span>" : "<span style='color: red'>Nem</span>"
    @endphp
    </p>
    <form action='{{ url("/tasks/{$task->id}") }}' method="post">
        @csrf
        <textarea name="solution" id="solution" cols="30" rows="10" placeholder="Írd ide a válaszodat"
        class="form-control @error('solution') is-invalid @enderror"></textarea>
        @error('solution')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <br>
        <input type="file" name="file" id="file">
        <input type="submit" value="Beadás">
    </form>
    @endif
@endsection