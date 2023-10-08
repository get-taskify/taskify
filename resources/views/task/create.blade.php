@extends('layouts.app')

@section('content')

    <h1>Task Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <br />
    <a href="{{ URL::route('task.index') }}">Tasks</a>
    <br />
    <form method="POST" action="{{ route('task.store') }}">
        @csrf
        <span>Text:</span>
        <input type="text" name="text" value="" />
        <br/>
        <span>finished:</span>
        <input type="number" name="finished" value="" />
        <br/>
        <span>repair_object_id:</span>
        <input type="number" name="repair_object_id" value="" />
        <br/>
        <span>done_by_user_id:</span>
        <input type="number" name="done_by_user_id" value="" />
        <br/>

        <button type="submit">Save</button>
    </form>

@endsection
