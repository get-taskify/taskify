@extends('layouts.app')

@section('content')

    <h1>user_role Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <form method="POST" action="{{ route('user_role.update', $user_role) }}">
        @method('PUT')
        @csrf
        <span>role:</span>
        <input type="text" name="role" value="{{ $user_role->role }}" />
        <br/>
        <input type="number" name="user_id" value="{{ $user_role->user_id }}" />

        <button type="submit">Save</button>
    </form>

@endsection
