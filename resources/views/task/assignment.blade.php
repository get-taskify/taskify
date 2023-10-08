@extends('layouts.app')
@section('content')
<h1>Tasks for Assignment {{$assignment->name}}</h1>
<form action="{{URL::Route('assignment.changeDone', $assignment)}}" method="post">
    @csrf
    @foreach ($tasks as $task)
        @if ($task->finished)
        <p>
            <input type='hidden' value='uncheck' name='tasks[{{$task->id}}]'>
            <input type="checkbox" name="tasks[{{$task->id}}]" value="1" checked > {{$task->text}}
            <sub>Done by User {{$task->done_by_user->name}} at {{$task->updated_at}}</sub>
        </p>
        @else
        <p>
            <input type="checkbox" name="tasks[{{$task->id}}]" value="check"> {{$task->text}}
        </p>
        @endif
    @endforeach
    <input type="submit" value="Save">
</form>
@endsection
