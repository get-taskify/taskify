@extends('layouts.app')

@section('content')

    <h1>user_role Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <br />
    <a href="{{ URL::route('user_role.index') }}">user_roles</a>
    <br />
    <form method="POST" action="{{ route('user_role.store') }}">
        @csrf
        <span>role:</span>
        <input type="text" name="role" value="" />
        <br/>
        <span>user_id:</span>
        <input type="number" name="user_id" value="" />
        <br/>

        <button type="submit">Save</button>
    </form>

@endsection
