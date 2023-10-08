@extends('layouts.app')

@section('title', 'Create Workshop')

@section('content')

    <h1>Workshop Test</h1>
    <a href="{{ URL::route('index') }}">Index</a>
    <br />
    <a href="{{ URL::route('workshop.index') }}">Workshops</a>
    <br />
    <form method="POST" action="{{ route('workshop.store') }}">
        @csrf
        <span>Name:</span>
        <input type="text" name="name" value="" />
        <br/>
        <span>Address:</span>
        <input type="text" name="address" value="" />
        <br/>

        <button type="submit">Save</button>
    </form>

@endsection
