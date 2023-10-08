@extends('layouts.app')

@section('content')

    <h1>Default_task Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <br />
    <a href="{{ URL::route('default_task.index') }}">Default_task</a>
    <br />
    <form method="POST" action="{{ route('default_task.store') }}">
        @csrf
        <span>device_type:</span>
        <input type="number" name="device_type" value="" />
        <br/>
        <span>text:</span>
        <input type="text" name="text" value="" />
        <br />
        <span>done_by_user_id:</span>
        <input type="number" name="done_by_user_id" value="" />
        <br/>

        <button type="submit">Save</button>
    </form>

@endsection
