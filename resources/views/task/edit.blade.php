@extends('layouts.app')

@section('content')

    <h1>Task Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <form method="POST" action="{{ route('task.update', $task) }}">
        @method('PUT')
        @csrf
        <span>Text:</span>
        <input type="text" name="text" value="{{ $task->text }}" />
        <br/>
        <input type="number" name="finished" value="{{ $task->finished }}" />
        <input type="number" name="repair_object_id" value="{{ $task->repair_object_id }}" />
        <input type="number" name="done_by_user_id" value="{{ $task->done_by_user_id }}" />

        <button type="submit">Save</button>
    </form>

@endsection
