@extends('layouts.app')

@section('content')

    <h1>device_default_task Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <br />
    <a href="{{ URL::route('device_default_task.index') }}">device_default_tasks</a>
    <br />
    <form method="POST" action="{{ route('device_default_task.store') }}">
        @csrf
        <span>finished:</span>
        <input type="number" name="finished" value="" />
        <br/>
        <span>repair_object_id:</span>
        <input type="number" name="repair_object_id" value="" />
        <br/>
        <span>default_task_id:</span>
        <input type="number" name="default_task_id" value="" />
        <br/>

        <button type="submit">Save</button>
    </form>

@endsection
