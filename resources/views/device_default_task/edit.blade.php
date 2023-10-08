@extends('layouts.app')

@section('content')

    <h1>device_default_task Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <form method="POST" action="{{ route('device_default_task.update', $device_default_task) }}">
        @method('PUT')
        @csrf
        <input type="number" name="finished" value="{{ $device_default_task->finished }}" />
        <input type="number" name="repair_object_id" value="{{ $device_default_task->repair_object_id }}" />
        <input type="number" name="default_task_id" value="{{ $device_default_task->default_task_id }}" />

        <button type="submit">Save</button>
    </form>

@endsection
