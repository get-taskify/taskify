@extends('layouts.app')

@section('content')

    <h1>Default_task Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <form method="POST" action="{{ route('default_task.update', $default_task) }}">
        @method('PUT')
        @csrf
        <span>Text:</span>
        <input type="text" name="device_type" value="{{ $default_task->device_type }}" />
        <br/>
        <input type="number" name="text" value="{{ $default_task->text }}" />
        <input type="number" name="done_by_user_id" value="{{ $default_task->done_by_user_id }}" />

        <button type="submit">Save</button>
    </form>

@endsection
