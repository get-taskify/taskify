@extends('layouts.app')

@section('content')

    <h1>note Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <br />
    <a href="{{ URL::route('note.index') }}">notes</a>
    <br />
    <form method="POST" action="{{ route('note.store') }}">
        @csrf
        <span>user_id:</span>
        <input type="text" name="user_id" value="" />
        <br/>
        <span>text:</span>
        <input type="text" name="text" value="" />
        <br/>

        <button type="submit">Save</button>
    </form>

@endsection
