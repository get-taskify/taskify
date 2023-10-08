@extends('layouts.app')

@section('content')

    <h1>note Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <form method="POST" action="{{ route('note.update', $note) }}">
        @method('PUT')
        @csrf
        <span>user_id:</span>
        <input type="text" name="user_id" value="{{ $note->user_id }}" />
        <br/>
        <input type="text" name="text" value="{{ $note->text }}" />

        <button type="submit">Save</button>
    </form>

@endsection
